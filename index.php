<?php
session_start();
$current_page = 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Melody - Song Recommendation System</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="dark_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* ============================================
           SURPRISE BUTTON STYLES
        ============================================ */
        .emotion-card.emotion-uncertain {
            grid-column: 1 / -1;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 50%, #4facfe 100%);
            border-color: transparent;
            min-height: 70px;
            padding: 16px;
            margin-top: 8px;
            transition: all 0.3s ease;
            margin-bottom: 10px;
        }
        
        .emotion-card.emotion-uncertain:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 8px 32px rgba(245, 87, 108, 0.4);
            border-color: transparent;
        }
        
        .emotion-card.emotion-uncertain .emotion-name {
            color: #ffffff;
            font-size: 1.2rem;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }
        
        .emotion-card.emotion-uncertain .emotion-desc {
            color: rgba(255, 255, 255, 0.85);
        }
        
        body.dark-mode .emotion-card.emotion-uncertain {
            background: linear-gradient(135deg, #6a1b9a 0%, #c62828 50%, #0d47a1 100%);
        }
        
        body.dark-mode .emotion-card.emotion-uncertain .emotion-name {
            color: #ffffff;
        }
        
        body.dark-mode .emotion-card.emotion-uncertain .emotion-desc {
            color: rgba(255, 255, 255, 0.8);
        }

        .modal-song-image {
            width: 120px;
            height: 120px;
            border-radius: 12px;
            overflow: hidden;
            margin: 0 auto 12px auto;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        }

        .modal-album-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* Dark mode adjustment */
        body.dark-mode .modal-song-image {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.4);
        }

        @media (max-width: 640px) {
            .modal-song-image {
                width: 90px;
                height: 90px;
            }
        }
        
        /* ============================================
           MODAL STYLES
        ============================================ */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s ease;
        }
        
        .modal-overlay.active {
            display: flex;
        }
        
        .modal-content {
            background: #ffffff;
            border-radius: 24px;
            padding: 40px;
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.4s ease;
            position: relative;
        }
        
        body.dark-mode .modal-content {
            background: #1a1a3e;
            color: #e8e8f0;
        }
        
        .modal-close {
            position: absolute;
            top: 16px;
            right: 20px;
            background: none;
            border: none;
            font-size: 1.8rem;
            cursor: pointer;
            color: #6b7280;
            transition: transform 0.2s ease;
            z-index: 10;
        }
        
        body.dark-mode .modal-close {
            color: #a8a8c0;
        }
        
        .modal-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 8px;
            color: #1a1a2e;
        }
        
        body.dark-mode .modal-title {
            color: #e8e8f0;
        }
        
        .modal-subtitle {
            color: #6b7280;
            margin-bottom: 20px;
            font-size: 0.95rem;
        }
        
        body.dark-mode .modal-subtitle {
            color: #a8a8c0;
        }
        
        .modal-song {
            background: #f8f9fc;
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            border: 2px solid #e5e7eb;
            margin-bottom: 20px;
        }
        
        body.dark-mode .modal-song {
            background: #12122a;
            border-color: #2a2a5a;
        }
        
        .modal-song .song-emoji {
            font-size: 3rem;
            display: block;
            margin-bottom: 8px;
        }
        
        .modal-song .song-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 4px;
        }
        
        body.dark-mode .modal-song .song-title {
            color: #e8e8f0;
        }
        
        .modal-song .song-artist {
            font-size: 1rem;
            color: #4a6cf7;
            font-weight: 500;
        }
        
        .modal-song .song-meta {
            font-size: 0.85rem;
            color: #8b8fa8;
            margin-top: 8px;
        }
        
        body.dark-mode .modal-song .song-meta {
            color: #6a6a8a;
        }
        
        .modal-song .song-mood-tag {
            display: inline-block;
            background: rgba(74, 108, 247, 0.1);
            padding: 4px 14px;
            border-radius: 50px;
            font-size: 0.8rem;
            color: #4a6cf7;
            margin-top: 8px;
        }
        
        .modal-buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }
        
        .modal-buttons .btn {
            flex: 1;
            justify-content: center;
            min-width: 120px;
            margin-bottom: 15px;
        }
        
        /* Give It A Try button - Spotify green */
        .modal-buttons .btn-primary {
            background: #1DB954;
            color: #ffffff;
            border-color: #1DB954;
        }
        
        .modal-buttons .btn-primary:hover {
            background: #1ed760;
            border-color: #1ed760;
        }
        
        .modal-buttons .btn-secondary {
            background: #8b5cf6;
            color: #ffffff;
            border-color: #8b5cf6;
        }
        
        .modal-buttons .btn-secondary:hover {
            background: #7c3aed;
            border-color: #7c3aed;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideUp {
            from { transform: translateY(30px) scale(0.95); opacity: 0; }
            to { transform: translateY(0) scale(1); opacity: 1; }
        }
        
        @media (max-width: 640px) {
            .emotion-card.emotion-uncertain {
                grid-column: 1 / -1;
                min-height: 60px;
            }
            
            .emotion-card.emotion-uncertain .emotion-name {
                font-size: 1rem;
            }
            
            .modal-content {
                padding: 28px 20px;
                width: 95%;
            }
            
            .modal-title {
                font-size: 1.4rem;
            }
            
            .modal-buttons .btn {
                min-width: 100%;
            }
            
            .modal-song .song-title {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Dark Mode Toggle -->
        <button class="dark-mode-toggle" id="darkModeToggle" aria-label="Toggle dark mode">
            🌙
        </button>

        <!-- Surprise Modal -->
        <div class="modal-overlay" id="surpriseModal">
            <div class="modal-content">
                <button class="modal-close" onclick="closeSurprise()">✕</button>
                <div class="modal-title">🎲 Surprise!</div>
                <div class="modal-subtitle">You might want to try this out!</div>
                <div id="modalSongContent">
                </div>
                <div class="modal-buttons">
                    <a href="#" id="modalPlayBtn" class="btn btn-primary" target="_blank">▶ Give It A Try</a>
                    <a href="#" id="modalPlaylistBtn" class="btn btn-secondary">✚ Add to Playlist</a>
                </div>
            </div>
        </div>

        <!-- Header -->
        <header class="header">
            <div class="header-brand">
                <h1>Mood Melody</h1>
                <span class="brand-icon">©</span>
            </div>
            <p class="header-subtitle">Intelligent Song Recommendation Engine</p>
            <div class="header-divider"></div>

            <!-- Navigation -->
            <nav class="main-nav">
                <a href="index.php" class="nav-link <?php echo ($current_page == 'home') ? 'active' : ''; ?>">Home</a>
                <a href="search.php" class="nav-link <?php echo ($current_page == 'search') ? 'active' : ''; ?>">Search</a>
                <a href="playlist.php" class="nav-link <?php echo ($current_page == 'playlist') ? 'active' : ''; ?>">
                    Playlist <?php echo isset($_SESSION['playlist']) ? '(' . count($_SESSION['playlist']) . ')' : ''; ?>
                </a>
            </nav>
        </header>

        <!-- Main Content -->
        <main class="main-content">
            <div class="question-section">
                <h2 class="question-title">How are we feeling today?</h2>
                <p class="question-desc">Tell us your mood and we'll find out which songs speak you.</p>
            </div>

            <!-- Emotion Selection Form -->
            <form action="recommend.php" method="POST" class="emotion-form">
                <div class="emotion-grid">
                    <!-- Emotion Cards -->
                    <button type="submit" name="emotion" value="happy" class="emotion-card emotion-happy">
                        <span class="emotion-name">😊 Happy</span>
                        <span class="emotion-desc">Joyful & Uplifting</span>
                    </button>

                    <button type="submit" name="emotion" value="sad" class="emotion-card emotion-sad">
                        <span class="emotion-name">😢 Sad</span>
                        <span class="emotion-desc">Melancholic & Reflective</span>
                    </button>

                    <button type="submit" name="emotion" value="energetic" class="emotion-card emotion-energetic">
                        <span class="emotion-name">⚡ Energetic</span>
                        <span class="emotion-desc">High-Power & Dynamic</span>
                    </button>

                    <button type="submit" name="emotion" value="chill" class="emotion-card emotion-chill">
                        <span class="emotion-name">😌 Chill</span>
                        <span class="emotion-desc">Calm & Relaxed</span>
                    </button>

                    <button type="submit" name="emotion" value="romantic" class="emotion-card emotion-romantic">
                        <span class="emotion-name">❤️ Romantic</span>
                        <span class="emotion-desc">Passionate & Affectionate</span>
                    </button>

                    <button type="submit" name="emotion" value="motivated" class="emotion-card emotion-motivated">
                        <span class="emotion-name">💪 Motivated</span>
                        <span class="emotion-desc">Driven & Inspired</span>
                    </button>

                    <button type="submit" name="emotion" value="nostalgic" class="emotion-card emotion-nostalgic">
                        <span class="emotion-name">🕰️ Nostalgic</span>
                        <span class="emotion-desc">Sentimental & Reminiscent</span>
                    </button>

                    <button type="submit" name="emotion" value="angry" class="emotion-card emotion-angry">
                        <span class="emotion-name">😤 Angry</span>
                        <span class="emotion-desc">Intense & Frustrated</span>
                    </button>

                    <button type="submit" name="emotion" value="anxious" class="emotion-card emotion-anxious">
                        <span class="emotion-name">😰 Anxious</span>
                        <span class="emotion-desc">Worried & Uneasy</span>
                    </button>

                    <button type="submit" name="emotion" value="grateful" class="emotion-card emotion-grateful">
                        <span class="emotion-name">🙏 Grateful</span>
                        <span class="emotion-desc">Appreciative & Thankful</span>
                    </button>
                </div>
                    <button type="button" onclick="showSurprise()" class="emotion-card emotion-uncertain">
                        <span class="emotion-name">🎲 I'm not sure for today... Surprise me!</span>
                        <span class="emotion-desc">Get a random song recommendation</span>
                    </button>
            </form>

            <!-- Footer Information -->
            <div class="footer-info">
                <p class="footer-text">Select an emotion to receive a personalized song recommendation.</p>
                <p class="footer-copyright">© 2026 Mood Melody · LDCW6123 Group Project</p>
            </div>
        </main>
    </div>
</body>
</html>

<script>
    // Dark Mode Toggle
    const toggle = document.getElementById('darkModeToggle');
    const body = document.body;
    
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

    // ============================================
    // SURPRISE ME! FUNCTIONALITY
    // ============================================
    
    const allSongsData = <?php 
        require_once 'song_database.php';
        $allSongs = getAllSongs();
        $flatSongs = [];
        foreach ($allSongs as $mood => $data) {
            foreach ($data['songs'] as $song) {
                $song['mood_key'] = $mood;
                $flatSongs[] = $song;
            }
        }
        echo json_encode($flatSongs);
    ?>;
    
    const moodEmojis = {
        'happy': '😊',
        'sad': '😢',
        'energetic': '⚡',
        'chill': '😌',
        'romantic': '❤️',
        'motivated': '💪',
        'nostalgic': '🕰️',
        'angry': '😤',
        'anxious': '😰',
        'grateful': '🙏'
    };

    function showSurprise() {
        if (allSongsData.length === 0) {
            showToast('No songs available!', 'error');
            return;
        }
        
        const randomIndex = Math.floor(Math.random() * allSongsData.length);
        const song = allSongsData[randomIndex];
        const emoji = moodEmojis[song.mood_key] || '🎵';
        const imagePath = song.image || 'image/default-album.jpg';
        
        const modalContent = document.getElementById('modalSongContent');
        modalContent.innerHTML = `
            <div class="modal-song">
                <div class="modal-song-image">
                    <img src="${imagePath}" 
                        alt="${song.title} album art" 
                        class="modal-album-image"
                        onerror="this.src='image/default-album.jpg'">
                </div>
                <div class="song-title">${song.title}</div>
                <div class="song-artist">${song.artist}</div>
                <div class="song-meta">${song.year} · ${song.tempo}</div>
                <div class="song-mood-tag">${emoji} ${song.mood_key.charAt(0).toUpperCase() + song.mood_key.slice(1)}</div>
            </div>
        `;
        
        // Set the "Give It A Try" button (Spotify link)
        const playBtn = document.getElementById('modalPlayBtn');
        playBtn.href = song.spotify || '#';
        playBtn.target = '_blank';
        
        // Set the "Add to Playlist" button
        const playlistBtn = document.getElementById('modalPlaylistBtn');
        playlistBtn.onclick = function(e) {
            e.preventDefault();
            addToPlaylistFromModal(song);
        };
        
        document.getElementById('surpriseModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeSurprise() {
        document.getElementById('surpriseModal').classList.remove('active');
        document.body.style.overflow = '';
    }

    function addToPlaylistFromModal(song) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'playlist_data.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (this.status === 200) {
                try {
                    const response = JSON.parse(this.responseText);
                    if (response.success) {
                        showToast('✅ "' + song.title + '" added to your playlist!', 'success');
                        updatePlaylistCount();
                        setTimeout(closeSurprise, 800);
                    } else {
                        showToast('⚠️ ' + response.message, 'warning');
                    }
                } catch(e) {
                    console.error('Error parsing response:', e);
                }
            }
        };
        xhr.send('action=add&title=' + encodeURIComponent(song.title) + 
                '&artist=' + encodeURIComponent(song.artist) + 
                '&spotify=' + encodeURIComponent(song.spotify) +
                '&image=' + encodeURIComponent(song.image || 'image/default-album.jpg') +
                '&year=' + encodeURIComponent(song.year || '') +
                '&tempo=' + encodeURIComponent(song.tempo || ''));
    }

    // ============================================
    // TOAST NOTIFICATIONS
    // ============================================
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
                z-index: 1001;
                opacity: 0;
                transition: opacity 0.5s ease;
                box-shadow: 0 4px 12px rgba(0,0,0,0.3);
                font-size: 1rem;
                max-width: 90%;
                font-family: 'Inter', sans-serif;
            `;
            document.body.appendChild(toast);
        }

        const colors = {
            success: '#1DB954',
            error: '#dc3545',
            warning: '#f0ad4e',
            info: '#4a6cf7'
        };
        toast.style.background = colors[type] || '#333';
        toast.textContent = message;
        toast.style.opacity = '1';

        setTimeout(() => {
            toast.style.opacity = '0';
        }, 3000);
    }

    // ============================================
    // UPDATE PLAYLIST COUNT
    // ============================================
    function updatePlaylistCount() {
        const playlistLink = document.querySelector('.nav-link[href*="playlist.php"]');
        if (playlistLink) {
            fetch('playlist_data.php?action=get_count')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const count = data.count;
                        if (count > 0) {
                            playlistLink.textContent = 'Playlist (' + count + ')';
                        } else {
                            playlistLink.textContent = 'Playlist';
                        }
                    }
                })
                .catch(() => console.log('Could not update playlist count'));
        }
    }

    // ============================================
    // CLOSE MODAL ON OVERLAY CLICK
    // ============================================
    document.getElementById('surpriseModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeSurprise();
        }
    });
</script>