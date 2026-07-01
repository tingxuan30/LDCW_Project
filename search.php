<?php
session_start();
$current_page = 'search'; 

// Initialize search results
$searchResults = [];
$searchQuery = '';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['q']) && !empty($_GET['q'])) {
    $searchQuery = trim($_GET['q']);
    
    // ============================================
    // SEARCH FUNCTION - Searches across all moods
    // ============================================
    function searchSongs($query) {
        // Load all songs from the recommendation database
        require_once 'song_database.php';
        
        $allSongs = getAllSongs();
        $results = [];
        
        $query = strtolower($query);
        
        foreach ($allSongs as $mood => $data) {
            foreach ($data['songs'] as $song) {
                // Search in title, artist, and year
                if (strpos(strtolower($song['title']), $query) !== false ||
                    strpos(strtolower($song['artist']), $query) !== false ||
                    strpos($song['year'], $query) !== false) {
                    
                    $song['mood'] = $mood;
                    $song['mood_label'] = $data['mood'];
                    $results[] = $song;
                }
            }
        }
        
        return $results;
    }
    
    $searchResults = searchSongs($searchQuery);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Songs · Mood Melody</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="dark_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container search-container">
        <!-- Dark Mode Toggle -->
        <button class="dark-mode-toggle" id="darkModeToggle" aria-label="Toggle dark mode">
            🌙
        </button>    
        
        <!-- Header -->
        <header class="header">
            <div class="header-brand">
                <h1>Mood Melody</h1>
                <span class="brand-icon">©</span>
            </div>
            <p class="header-subtitle">Search for Your Favorite Songs</p>
            
            <div class="header-divider"></div>

            <nav class="main-nav">
                <a href="index.php" class="nav-link <?php echo ($current_page == 'home') ? 'active' : ''; ?>">Home</a>
                <a href="search.php" class="nav-link <?php echo ($current_page == 'search') ? 'active' : ''; ?>">Search</a>
                <a href="playlist.php" class="nav-link <?php echo ($current_page == 'playlist') ? 'active' : ''; ?>">
                    Playlist <?php echo isset($_SESSION['playlist']) ? '(' . count($_SESSION['playlist']) . ')' : ''; ?>
                </a>
            </nav>
        </header>

        <!-- Search Bar -->
        <div class="search-section">
            <form action="search.php" method="GET" class="search-form">
                <div class="search-wrapper">
                    <input type="text" 
                           name="q" 
                           class="search-input" 
                           placeholder="Search by song title, artist, or year..." 
                           value="<?php echo htmlspecialchars($searchQuery); ?>"
                           autofocus>
                    <button type="submit" class="btn-search">
                        <span class="search-icon">🔍</span> Search
                    </button>
                </div>
            </form>
            
            <!-- Quick search suggestions -->
            <div class="search-suggestions">
                <span class="suggestion-label">Popular searches:</span>
                <a href="search.php?q=Taylor Swift" class="suggestion-tag">Taylor Swift</a>
                <a href="search.php?q=Harry Styles" class="suggestion-tag">Harry Styles</a>
                <a href="search.php?q=Dua Lipa" class="suggestion-tag">Dua Lipa</a>
                <a href="search.php?q=2023" class="suggestion-tag">2023</a>
                <a href="search.php?q=Love" class="suggestion-tag">Love Songs</a>
            </div>
        </div>

        <!-- Search Results -->
        <?php if (!empty($searchQuery)): ?>
            <div class="results-section">
                <div class="results-header">
                    <h2 class="results-title">
                        <?php if (count($searchResults) > 0): ?>
                            Found <?php echo count($searchResults); ?> song(s) matching "<strong><?php echo htmlspecialchars($searchQuery); ?></strong>"
                        <?php else: ?>
                            No songs found for "<strong><?php echo htmlspecialchars($searchQuery); ?></strong>"
                        <?php endif; ?>
                    </h2>
                    <a href="index.php" class="back-link">← Back to Home</a>
                </div>

                <?php if (count($searchResults) > 0): ?>
                <div class="search-results-list">
                    <?php foreach ($searchResults as $index => $song): ?>
                    <div class="song-item search-item">
                        <div class="song-number"><?php echo $index + 1; ?></div>
                    
                        <div class="song-image-container">
                            <?php 
                            $imagePath = isset($song['image']) ? $song['image'] : 'image/default-album.jpg';
                            ?>
                            <img src="<?php echo htmlspecialchars($imagePath); ?>" 
                                alt="<?php echo htmlspecialchars($song['title']); ?> album art" 
                                class="song-album-image"
                                onerror="this.src='image/default-album.jpg'">
                        </div>
                        
                        <div class="song-info">
                            <h3 class="song-title-small"><?php echo htmlspecialchars($song['title']); ?></h3>
                            <p class="song-artist-small"><?php echo htmlspecialchars($song['artist']); ?></p>
                            <div class="song-meta-small">
                                <span><?php echo $song['year']; ?></span>
                                <span class="dot">·</span>
                                <span><?php echo $song['tempo']; ?></span>
                                <span class="dot">·</span>
                                <span class="mood-tag-small">
                                    <?php 
                                    // Get emoji for this mood
                                    $moodEmojis = [
                                        'happy' => '😊',
                                        'sad' => '😢',
                                        'energetic' => '⚡',
                                        'chill' => '😌',
                                        'romantic' => '❤️',
                                        'motivated' => '💪',
                                        'nostalgic' => '🕰️',
                                        'angry' => '😤',
                                        'anxious' => '😰',
                                        'grateful' => '🙏'
                                    ];
                                    $emoji = $moodEmojis[$song['mood']] ?? '🎵';
                                    echo $emoji . ' ' . ucfirst($song['mood']); 
                                    ?>
                                </span>
                            </div>
                        </div>
                        <div class="action-buttons-group">
                            <a href="<?php echo $song['spotify']; ?>" target="_blank" class="btn btn-small btn-spotify">
                                ▶ Play
                            </a>
                            <button onclick="addToPlaylist(
                                    '<?php echo htmlspecialchars($song['title']); ?>', 
                                    '<?php echo htmlspecialchars($song['artist']); ?>', 
                                    '<?php echo $song['spotify']; ?>', 
                                    '<?php echo isset($song['image']) ? $song['image'] : 'image/default-album.jpg'; ?>',
                                    '<?php echo $song['year'] ?? ''; ?>',
                                    '<?php echo $song['tempo'] ?? ''; ?>'
                                )" 
                                class="btn btn-small btn-playlist">
                                Add to Playlist
                            </button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

        <!-- Footer -->
        <div class="footer-info">
            <p class="footer-text">Search across all moods to find your perfect song.</p>
            <p class="footer-copyright">© 2026 Mood Melody · LDCW6123 Group Project</p>
        </div>
    </div>

    <script>
        function addToPlaylist(title, artist, spotify, image, year, tempo) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'playlist_data.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status === 200) {
                    try {
                        const response = JSON.parse(this.responseText);
                        if (response.success) {
                            alert('✅ "' + title + '" added to your playlist!');
                            updatePlaylistCount();
                        } else {
                            alert('⚠️ ' + response.message);
                        }
                    } catch(e) {
                        console.error('Error parsing response:', e);
                    }
                }
            };
            xhr.send('action=add&title=' + encodeURIComponent(title) + 
                    '&artist=' + encodeURIComponent(artist) + 
                    '&spotify=' + encodeURIComponent(spotify) +
                    '&image=' + encodeURIComponent(image || 'image/default-album.jpg') +
                    '&year=' + encodeURIComponent(year || '') +
                    '&tempo=' + encodeURIComponent(tempo || ''));
        }

        // Dark Mode Toggle
        const toggle = document.getElementById('darkModeToggle');
        const body = document.body;
        
        // Check saved preference
        if (localStorage.getItem('darkMode') === 'enabled') {
            body.classList.add('dark-mode');
            toggle.textContent = '☀️';
        }
        
        toggle.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            
            if (body.classList.contains('dark-mode')) {
                localStorage.setItem('darkMode', 'enabled');
                toggle.textContent = '☀️';
            } else {
                localStorage.setItem('darkMode', 'disabled');
                toggle.textContent = '🌙';
            }
        });
    </script>
</body>
</html>