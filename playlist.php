<?php
session_start();
$current_page = 'playlist';

// Initialize playlist if it doesn't exist
if (!isset($_SESSION['playlist'])) {
    $_SESSION['playlist'] = [];
}

$playlist = $_SESSION['playlist'];

// ============================================
// CALCULATE DOMINANT MOOD
// ============================================
function getDominantMood($playlist) {
    if (empty($playlist)) {
        return null;
    }
    
    // Load song database
    require_once 'song_database.php';
    $allSongs = getAllSongs();
    
    // Count moods in playlist
    $moodCounts = [];
    foreach ($playlist as $song) {
        foreach ($allSongs as $mood => $data) {
            foreach ($data['songs'] as $dbSong) {
                if ($dbSong['title'] === $song['title'] && $dbSong['artist'] === $song['artist']) {
                    $moodCounts[$mood] = ($moodCounts[$mood] ?? 0) + 1;
                    break 2;
                }
            }
        }
    }
    
    // Find the dominant mood
    if (empty($moodCounts)) {
        return null;
    }
    
    arsort($moodCounts);
    $dominantMood = key($moodCounts);
    $count = current($moodCounts);
    $total = count($playlist);
    $percentage = round(($count / $total) * 100);
    
    return [
        'mood' => $dominantMood,
        'count' => $count,
        'total' => $total,
        'percentage' => $percentage,
        'label' => ucfirst($dominantMood)
    ];
}

$dominantMoodData = getDominantMood($playlist);

// ============================================
// MOOD COLOR MAPPING
// ============================================
function getMoodColor($mood) {
    $colors = [
        'happy' => ['bg' => '#fbbf24', 'border' => '#f59e0b', 'text' => '#92400e', 'glow' => 'rgba(251, 191, 36, 0.3)'],
        'sad' => ['bg' => '#60a5fa', 'border' => '#3b82f6', 'text' => '#1e3a8a', 'glow' => 'rgba(96, 165, 250, 0.3)'],
        'energetic' => ['bg' => '#f87171', 'border' => '#ef4444', 'text' => '#7f1d1d', 'glow' => 'rgba(248, 113, 113, 0.3)'],
        'chill' => ['bg' => '#34d399', 'border' => '#10b981', 'text' => '#065f46', 'glow' => 'rgba(52, 211, 153, 0.3)'],
        'romantic' => ['bg' => '#f472b6', 'border' => '#ec4899', 'text' => '#831843', 'glow' => 'rgba(244, 114, 182, 0.3)'],
        'motivated' => ['bg' => '#a78bfa', 'border' => '#8b5cf6', 'text' => '#4c1d95', 'glow' => 'rgba(167, 139, 250, 0.3)'],
        'nostalgic' => ['bg' => '#fb923c', 'border' => '#f97316', 'text' => '#7c2d12', 'glow' => 'rgba(251, 146, 60, 0.3)'],
        'angry' => ['bg' => '#ef4444', 'border' => '#dc2626', 'text' => '#7f1d1d', 'glow' => 'rgba(239, 68, 68, 0.3)'],
        'anxious' => ['bg' => '#818cf8', 'border' => '#6366f1', 'text' => '#312e81', 'glow' => 'rgba(129, 140, 248, 0.3)'],
        'grateful' => ['bg' => '#6ee7b7', 'border' => '#34d399', 'text' => '#065f46', 'glow' => 'rgba(110, 231, 183, 0.3)']
    ];
    
    return $colors[$mood] ?? ['bg' => '#888', 'border' => '#666', 'text' => '#fff', 'glow' => 'rgba(136, 136, 136, 0.3)'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Playlist · Mood Melody</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="dark_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Mood stat item styling */
        .stat-item.mood-stat {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .stat-item.mood-stat .mood-emoji {
            font-size: 2rem;
            display: block;
            margin-bottom: 2px;
        }
        
        .stat-item.mood-stat .mood-label {
            font-size: 1.1rem;
            font-weight: 700;
            display: block;
        }
        
        .stat-item.mood-stat .mood-sub {
            font-size: 0.75rem;
            font-weight: 500;
            opacity: 0.8;
            display: block;
            margin-top: 2px;
        }
        
        .stat-item.mood-stat .mood-percentage {
            position: absolute;
            bottom: 6px;
            right: 12px;
            font-size: 0.7rem;
            font-weight: 600;
            opacity: 0.5;
        }
        
        .stat-item.mood-stat .mood-glow {
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            opacity: 0.1;
            pointer-events: none;
        }
        
        /* Dark mode adjustments */
        body.dark-mode .stat-item.mood-stat .mood-label {
            color: #ffffff;
        }
        
        body.dark-mode .stat-item.mood-stat .mood-sub {
            color: #e8e8f0;
        }
    </style>
</head>
<body>
    <!-- Dark Mode Toggle -->
    <button class="dark-mode-toggle" id="darkModeToggle" aria-label="Toggle dark mode">
        🌙
    </button> 
    
    <div class="container playlist-container">      
        <!-- Header -->
        <header class="header">
            <div class="header-brand">
                <h1>Mood Melody</h1>
                <span class="brand-icon">©</span>
            </div>
            <p class="header-subtitle">Keep Every Song You Love in One Place</p>
            <div class="header-divider"></div>

            <nav class="main-nav">
                <a href="index.php" class="nav-link <?php echo ($current_page == 'home') ? 'active' : ''; ?>">Home</a>
                <a href="search.php" class="nav-link <?php echo ($current_page == 'search') ? 'active' : ''; ?>">Search</a>
                <a href="playlist.php" class="nav-link <?php echo ($current_page == 'playlist') ? 'active' : ''; ?>">
                    Playlist <?php echo isset($_SESSION['playlist']) ? '(' . count($_SESSION['playlist']) . ')' : ''; ?>
                </a>
                <a href="achievements.php" class="nav-link <?php echo ($current_page == 'achievements') ? 'active' : ''; ?>">Achievements</a>
            </nav>
        </header>

        <!-- Playlist Stats -->
        <div class="playlist-stats">
            <div class="stat-item">
                <span class="stat-number"><?php echo count($playlist); ?></span>
                <span class="stat-label">Song(s) in Playlist</span>
            </div>
            
            <?php if ($dominantMoodData && count($playlist) > 0): ?>
                <?php 
                $mood = $dominantMoodData['mood'];
                $color = getMoodColor($mood);
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
                $emoji = $moodEmojis[$mood] ?? '🎵';
                ?>
                <div class="stat-item mood-stat" style="border-color: <?php echo $color['border']; ?>; background: <?php echo $color['bg']; ?>20;">
                    <div class="mood-glow" style="background: <?php echo $color['bg']; ?>;"></div>
                    <span class="mood-emoji"><?php echo $emoji; ?></span>
                    <span class="mood-label" style="color: <?php echo $color['text']; ?>;">
                        <?php echo ucfirst($mood); ?>
                    </span>
                    <span class="mood-sub" style="color: <?php echo $color['text']; ?>;">
                        is your dominant energy
                    </span>
                    <span class="mood-percentage" style="color: <?php echo $color['text']; ?>;">
                        <?php echo $dominantMoodData['percentage']; ?>% of playlist
                    </span>
                </div>
            <?php else: ?>
                <div class="stat-item">
                    <span class="stat-number">😶</span>
                    <span class="stat-label">Add songs to discover<br>your dominant mood</span>
                </div>
            <?php endif; ?>
        </div>

        <!-- Playlist Content -->
        <?php if (count($playlist) > 0): ?>
        
        <!-- Search Section -->
        <div class="search-section search-spacing" style="width: 100%;">
            <div class="search-wrapper search-wrapper-full">
                <input type="text" 
                    id="searchInput" 
                    class="search-input search-input-full" 
                    placeholder="🔍︎ Search songs in your playlist..." 
                    onkeyup="filterPlaylist()">
            </div>
        </div>

        <!-- Playlist Actions -->
        <div class="playlist-actions-wrapper">
            <div class="playlist-actions-left">
                <a href="index.php" class="btn btn-secondary">🠄 Add More Songs</a>
            </div>
            <div class="playlist-actions-right">
                <button onclick="shufflePlaylist()" class="btn btn-warning">⇄ Shuffle</button>
                <button onclick="clearPlaylist()" class="btn btn-danger">🗑️ Clear Playlist</button>
            </div>
        </div>

        <!-- Song List -->
        <div class="search-results-list" id="playlistContainer">
            <?php foreach ($playlist as $index => $song): ?>
            <div class="song-item search-item" data-index="<?php echo $index; ?>" data-title="<?php echo strtolower(htmlspecialchars($song['title'])); ?>" data-artist="<?php echo strtolower(htmlspecialchars($song['artist'])); ?>">
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
                    <?php if (isset($song['year']) || isset($song['tempo'])): ?>
                        <div class="song-meta-small">
                            <?php if (isset($song['year'])): ?>
                            <span><?php echo $song['year']; ?></span>
                            <?php endif; ?>
                            <?php if (isset($song['tempo'])): ?>
                            <?php if (isset($song['year'])): ?>
                            <span class="dot">·</span>
                            <?php endif; ?>
                            <span><?php echo $song['tempo']; ?></span>
                            <?php endif; ?>
                            <span class="dot">·</span>
                            <span class="mood-tag-small">
                                <?php 
                                // Find the mood for this song
                                require_once 'song_database.php';
                                $allSongs = getAllSongs();
                                $songMood = '';
                                foreach ($allSongs as $mood => $data) {
                                    foreach ($data['songs'] as $dbSong) {
                                        if ($dbSong['title'] === $song['title'] && $dbSong['artist'] === $song['artist']) {
                                            $songMood = $mood;
                                            break 2;
                                        }
                                    }
                                }
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
                                $emoji = $moodEmojis[$songMood] ?? '🎵';
                                echo $emoji . ' ' . ucfirst($songMood); 
                                ?>
                            </span>
                        </div>
                        <?php endif; ?>
                </div>
                <div class="action-buttons-group">
                    <a href="<?php echo $song['spotify']; ?>" target="_blank" class="btn btn-small btn-spotify">
                        ▶ Play
                    </a>
                    <button onclick="removeSong(<?php echo $index; ?>)" class="btn btn-small btn-remove">
                        🗑️
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- No Search Results Message -->
        <div id="noResults" class="no-results" style="display: none;">
            <div class="icon">🗁</div>
            <h4>No songs found</h4>
            <p>Try searching with different keywords</p>
        </div>

        <?php else: ?>
        <!-- Empty Playlist -->
        <div class="empty-playlist" style="text-align: center; padding: 60px 20px;">
            <div style="font-size: 5rem; margin-bottom: 20px;">🗁</div>
            <h3 style="color: #6b7280; margin-bottom: 10px;">Your playlist is empty</h3>
            <p style="color: #6b7280; margin-bottom: 10px; max-width: 400px; margin-left: auto; margin-right: auto;">
                Start building your playlist by searching for songs or getting recommendations.
            </p>
            <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; margin-top: 20px;">
                <a href="index.php" class="btn btn-primary">⭐ Get Recommendations</a>
                <a href="search.php" class="btn btn-secondary">🔍︎ Search Songs</a>
            </div>
        </div>
        <?php endif; ?>

        <!-- Footer -->
        <div class="footer-info">
            <p class="footer-text">Build your perfect playlist with Mood Melody.</p>
            <p class="footer-copyright">© 2026 Mood Melody · LDCW6123 Group Project</p>
        </div>
    </div>

    <script>
        //Show message
        function showToast(message, type = 'info') {
            let toast = document.getElementById('toast');
            if (!toast) {
                toast = document.createElement('div');
                toast.id = 'toast';
                toast.style.cssText = `
                    position: fixed;
                    bottom: 30px;
                    left: 50%;
                    transform: translateX(-50%);
                    background: #333;
                    color: #fff;
                    padding: 16px 24px;
                    border-radius: 8px;
                    z-index: 1000;
                    opacity: 0;
                    transition: opacity 0.5s;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
                    font-size: 1rem;
                    max-width: 90%;
                `;
                document.body.appendChild(toast);
            }

            const colors = {
                success: '#1DB954',
                error: '#dc3545',
                warning: '#f0ad4e',
                info: '#17a2b8'
            };
            toast.style.background = colors[type] || '#333';
            toast.textContent = message;
            toast.style.opacity = '1';

            setTimeout(() => {
                toast.style.opacity = '0';
            }, 4000);
        }

        //Search Function with No Results
        function filterPlaylist() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const items = document.querySelectorAll('.search-item');
            let visibleCount = 0;

            items.forEach(item => {
                const title = item.getAttribute('data-title') || '';
                const artist = item.getAttribute('data-artist') || '';

                if (title.includes(filter) || artist.includes(filter)) {
                    item.style.display = 'flex';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            // Show/hide no results message
            const noResults = document.getElementById('noResults');
            if (noResults) {
                if (items.length > 0 && visibleCount === 0 && filter.length > 0) {
                    noResults.style.display = 'block';
                } else {
                    noResults.style.display = 'none';
                }
            }
        }

        // Enter key support
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    filterPlaylist();
                }
            });
        }

        //Remove Song Function
        function removeSong(index) {
            if (confirm('Remove this song from your playlist?')) {
                fetch('playlist_data.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'action=remove&index=' + index
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast('✅ ' + data.message, 'success');
                        setTimeout(() => location.reload(), 500);
                    } else {
                        showToast('❌ ' + data.message, 'error');
                    }
                })
                .catch(() => showToast('Network error', 'error'));
            }
        }

        //Clear All Song Function
        function clearPlaylist() {
            if (confirm('Are you sure you want to clear your entire playlist?')) {
                fetch('playlist_data.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'action=clear'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast('✅ ' + data.message, 'success');
                        setTimeout(() => location.reload(), 500);
                    } else {
                        showToast('❌ ' + data.message, 'error');
                    }
                })
                .catch(() => showToast('Network error', 'error'));
            }
        }

        //Shuffle function
        function shufflePlaylist() {
            const songs = <?php echo json_encode($playlist); ?>;
            if (songs.length < 2) {
                showToast('Need at least 2 songs to shuffle', 'warning');
                return;
            }

            fetch('playlist_data.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'action=shuffle'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('🔄 ' + data.message, 'success');
                    setTimeout(() => location.reload(), 300);
                } else {
                    showToast('❌ ' + data.message, 'error');
                }
            })
            .catch(() => showToast('Network error', 'error'));
        }

        // Console info
        console.log('🎵 Mood Melody Playlist');
        console.log('📊 ' + <?php echo count($playlist); ?> + ' songs in playlist');

        // Dark mode toggle
        (function() {
            const toggle = document.getElementById('darkModeToggle');
            const body = document.body;
            
            if (!toggle) {
                console.error('Dark mode toggle button not found!');
                return;
            }

            // Check saved preference
            const darkMode = localStorage.getItem('darkMode');
            if (darkMode === 'enabled') {
                body.classList.add('dark-mode');
                toggle.textContent = '☀️';
            }

            // Toggle function
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                body.classList.toggle('dark-mode');

                if (body.classList.contains('dark-mode')) {
                    localStorage.setItem('darkMode', 'enabled');
                    toggle.textContent = '☀️';
                } else {
                    localStorage.setItem('darkMode', 'disabled');
                    toggle.textContent = '🌙';
                }
            });

            console.log('🌓 Dark mode toggle initialized');
        })();
    </script>
</body>
</html>