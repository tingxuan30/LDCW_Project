<?php
session_start();
$current_page = 'playlist';

// Initialize playlist if it doesn't exist
if (!isset($_SESSION['playlist'])) {
    $_SESSION['playlist'] = [];
}

// Handle remove from playlist
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'remove') {
    $index = intval($_POST['index']);
    if (isset($_SESSION['playlist'][$index])) {
        array_splice($_SESSION['playlist'], $index, 1);
    }
    // Redirect to prevent form resubmission
    header("Location: playlist.php");
    exit();
}

$playlist = $_SESSION['playlist'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Playlist · Mood Melody</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container playlist-container">
        <!-- Header -->
        <header class="header">
            <div class="header-brand">
                <span class="brand-icon">♪</span>
                <h1>Mood Melody</h1>
            </div>
            <p class="header-subtitle">Your Personal Playlist</p>
            <div class="header-divider"></div>

            <nav class="main-nav">
                <a href="index.php" class="nav-link <?php echo ($current_page == 'home') ? 'active' : ''; ?>">Home</a>
                <a href="search.php" class="nav-link <?php echo ($current_page == 'search') ? 'active' : ''; ?>">Search</a>
                <a href="playlist.php" class="nav-link <?php echo ($current_page == 'playlist') ? 'active' : ''; ?>">
                    Playlist <?php echo isset($_SESSION['playlist']) ? '(' . count($_SESSION['playlist']) . ')' : ''; ?>
                </a>
            </nav>
        </header>

        <!-- Playlist Stats -->
        <div class="playlist-stats">
            <div class="stat-item">
                <span class="stat-number"><?php echo count($playlist); ?></span>
                <span class="stat-label">Songs in Playlist</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">🎵</span>
                <span class="stat-label">Curated Just for You</span>
            </div>
        </div>

        <!-- Playlist Content -->
        <?php if (count($playlist) > 0): ?>
        <div class="playlist-actions">
            <button onclick="clearPlaylist()" class="btn btn-danger">🗑️ Clear Playlist</button>
            <a href="index.php" class="btn btn-secondary">← Add More Songs</a>
        </div>

        <div class="song-list playlist-songs">
            <?php foreach ($playlist as $index => $song): ?>
            <div class="song-item playlist-item">
                <div class="song-number"><?php echo $index + 1; ?></div>
                <div class="song-info">
                    <h3 class="song-title-small"><?php echo htmlspecialchars($song['title']); ?></h3>
                    <p class="song-artist-small"><?php echo htmlspecialchars($song['artist']); ?></p>
                </div>
                <div class="action-buttons-group">
                    <a href="<?php echo $song['spotify']; ?>" target="_blank" class="btn btn-small btn-spotify">
                        ▶ Play
                    </a>
                    <form method="POST" action="playlist.php" style="display:inline;">
                        <input type="hidden" name="action" value="remove">
                        <input type="hidden" name="index" value="<?php echo $index; ?>">
                        <button type="submit" class="btn btn-small btn-remove" onclick="return confirm('Remove this song from your playlist?')">
                            ✕ Remove
                        </button>
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Play All Button -->
        <div class="play-all-section">
            <a href="#" onclick="playAll()" class="btn btn-primary btn-play-all">
                ▶ Play All Songs
            </a>
            <p class="play-all-note">Opens all songs in Spotify (opens in new tabs)</p>
        </div>

        <?php else: ?>
        <!-- Empty Playlist -->
        <div class="empty-playlist">
            <div class="empty-icon">🎵</div>
            <h3>Your playlist is empty</h3>
            <p>Start building your playlist by searching for songs or getting recommendations based on your mood.</p>
            <div class="empty-actions">
                <a href="index.php" class="btn btn-primary">Get Recommendations</a>
                <a href="search.php" class="btn btn-secondary">Search Songs</a>
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
        function clearPlaylist() {
            if (confirm('Are you sure you want to clear your entire playlist?')) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'playlist_data.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (this.status === 200) {
                        location.reload();
                    }
                };
                xhr.send('action=clear');
            }
        }

        function playAll() {
            const songs = <?php echo json_encode($playlist); ?>;
            songs.forEach(song => {
                window.open(song.spotify, '_blank');
            });
            alert('🎵 Opening all ' + songs.length + ' songs in Spotify!');
        }
    </script>
</body>
</html>