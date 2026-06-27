<?php
session_start();

// Include the shared database
require_once 'song_database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['emotion'])) {
    $emotion = $_POST['emotion'];
} else {
    header("Location: index.php");
    exit();
}

// Get recommendations from the shared database
function getRecommendations($emotion) {
    $allSongs = getAllSongs();
    return $allSongs[$emotion] ?? null;
}

$recommendationData = getRecommendations($emotion);

if (!$recommendationData) {
    header("Location: index.php");
    exit();
}

// Extract data
$mood = $recommendationData['mood'];
$energy = $recommendationData['energy'];
$description = $recommendationData['description'];
$songs = $recommendationData['songs'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recommendations · Mood Melody</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container result-container">
        <!-- Header -->
        <header class="header">
            <div class="header-brand">
                <span class="brand-icon">♪</span>
                <h1>Mood Melody</h1>
            </div>
            <p class="header-subtitle">Your Personalized Song Recommendations</p>
            <div class="header-divider"></div>
        </header>

        <!-- Results Content -->
        <main class="main-content">
            <!-- Mood Overview -->
            <div class="mood-overview">
                <div class="mood-header">
                    <h2 class="mood-title">You're feeling <span class="highlight"><?php echo strtolower($mood); ?></span></h2>
                    <div class="mood-meta">
                        <span class="meta-tag">🎵 <?php echo count($songs); ?> Songs Found</span>
                        <span class="meta-tag">⚡ <?php echo $energy; ?> Energy</span>
                    </div>
                </div>
                <p class="mood-description"><?php echo htmlspecialchars($description); ?></p>
            </div>

            <!-- Song List with Images and Add to Playlist -->
            <div class="song-list">
                <?php foreach ($songs as $index => $song): ?>
                <div class="song-item">
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

            <!-- Action Buttons -->
            <div class="action-section">
                <a href="index.php" class="btn btn-secondary">
                    <span class="btn-icon">←</span> Select Another Mood
                </a>
            </div>

            <!-- Footer -->
            <div class="footer-info">
                <p class="footer-text">Discover more recommendations by exploring different moods.</p>
                <p class="footer-copyright">© 2026 Mood Melody · LDCW6123 Group Project</p>
            </div>
        </main>
    </div>
</body>
</html>

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
                        // Optional: Update playlist count in navigation
                        updatePlaylistCount();
                    } else {
                        alert('⚠️ ' + response.message);
                    }
                } catch(e) {
                    aconsole.error('Error parsing response:', e);
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
</script>