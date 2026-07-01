<?php
session_start();
$current_page = 'achievements';

// Initialize playlist if it doesn't exist
if (!isset($_SESSION['playlist'])) {
    $_SESSION['playlist'] = [];
}

$playlist = $_SESSION['playlist'];

// Count total of moods user has
function getMoodDiversity($playlist) {
    if (empty($playlist)) {
        return ['count' => 0, 'total' => 10, 'percentage' => 0];
    }
    
    $moods = [];
    require_once 'song_database.php';
    $allSongs = getAllSongs();
    
    $allMoodKeys = array_keys($allSongs);
    $totalMoods = count($allMoodKeys);
    
    foreach ($playlist as $song) {
        foreach ($allSongs as $mood => $data) {
            foreach ($data['songs'] as $dbSong) {
                if ($dbSong['title'] === $song['title'] && $dbSong['artist'] === $song['artist']) {
                    $moods[$mood] = true;
                    break 2;
                }
            }
        }
    }
    
    $moodCount = count($moods);
    $percentage = $totalMoods > 0 ? round(($moodCount / $totalMoods) * 100) : 0;
    
    return [
        'count' => $moodCount,
        'total' => $totalMoods,
        'percentage' => $percentage
    ];
}

// Count songs per mood in playlist
function getMoodDistribution($playlist) {
    $moodCounts = [];
    if (empty($playlist)) return $moodCounts;
    
    require_once 'song_database.php';
    $allSongs = getAllSongs();
    
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
    return $moodCounts;
}

// Define mood achievements
function getAchievements($playlist) {
    $moodDistribution = getMoodDistribution($playlist);
    $totalMoods = count($moodDistribution);
    
    return [
        // ============================================
        // MOOD ACHIEVEMENTS - Different moods collected
        // ============================================
        [
            'id' => 'mood_explorer',
            'icon' => '🌈', 
            'name' => 'Mood Explorer', 
            'description' => 'Collect songs from 3+ moods',
            'unlocked' => $totalMoods >= 3,
            'progress' => min(100, ($totalMoods / 3) * 100),
            'current' => $totalMoods,
            'required' => 3
        ],
        [
            'id' => 'mood_master',
            'icon' => '🎨', 
            'name' => 'Mood Master', 
            'description' => 'Collect songs from 6+ moods',
            'unlocked' => $totalMoods >= 6,
            'progress' => min(100, ($totalMoods / 6) * 100),
            'current' => $totalMoods,
            'required' => 6
        ],
        [
            'id' => 'mood_legend',
            'icon' => '🌟', 
            'name' => 'Mood Legend', 
            'description' => 'Collect songs from all 10 moods',
            'unlocked' => $totalMoods >= 10,
            'progress' => min(100, ($totalMoods / 10) * 100),
            'current' => $totalMoods,
            'required' => 10
        ],
    ];
}

$achievements = getAchievements($playlist);
$totalAchievements = count($achievements);
$unlockedCount = count(array_filter($achievements, function($a) { return $a['unlocked']; }));
$progressPercentage = $totalAchievements > 0 ? round(($unlockedCount / $totalAchievements) * 100) : 0;
$totalSongs = count($playlist);

$moodDiversityData = getMoodDiversity($playlist);
$moodDiversityDisplay = $moodDiversityData['count'] . '/' . $moodDiversityData['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Achievements · Mood Melody</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="dark_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Achievements Header */
        .achievements-header {
            text-align: center;
            padding: 20px 0 30px 0;
        }

        .achievements-header h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 4px;
        }

        .achievements-header .subtitle {
            color: #6b7280;
            font-size: 1rem;
        }

        /* Progress Overview */
        .achievement-overview {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 32px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .overview-card {
            background: #f8f9fc;
            border-radius: 14px;
            padding: 20px;
            text-align: center;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .overview-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        .overview-card .number {
            font-size: 2.2rem;
            font-weight: 700;
            color: #4a6cf7;
            display: block;
        }

        .overview-card .label {
            font-size: 0.85rem;
            color: #6b7280;
            display: block;
            margin-top: 2px;
        }

        .overview-card .icon {
            font-size: 1.5rem;
            display: block;
            margin-bottom: 4px;
        }

        /* Overall Progress Bar */
        .overall-progress {
            background: #f8f9fc;
            border-radius: 14px;
            padding: 20px 24px;
            margin-bottom: 32px;
            border: 1px solid #e5e7eb;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .overall-progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 8px;
        }

        .overall-progress-header .title {
            font-weight: 600;
            color: #1a1a2e;
            font-size: 1rem;
        }

        .overall-progress-header .count {
            font-size: 0.9rem;
            color: #6b7280;
        }

        .overall-progress-header .count strong {
            color: #4a6cf7;
        }

        .progress-track {
            width: 100%;
            height: 10px;
            background: #e5e7eb;
            border-radius: 5px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #4a6cf7, #7c3aed);
            border-radius: 5px;
            transition: width 1s ease;
        }

        /* Mood Achievements Grid */
        .mood-achievements-section {
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .mood-achievements-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #1a1a2e;
            margin-bottom: 16px;
            text-align: center;
        }

        .achievement-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 16px;
        }

        /* Achievement Card */
        .achievement-card {
            background: #ffffff;
            border-radius: 14px;
            padding: 20px 16px;
            text-align: center;
            border: 2px solid #e5e7eb;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .achievement-card.unlocked {
            border-color: #f59e0b;
            background: linear-gradient(135deg, #fffbeb 0%, #ffffff 100%);
        }

        .achievement-card.locked {
            opacity: 0.6;
            filter: grayscale(0.5);
        }

        .achievement-card.unlocked:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(245, 158, 11, 0.2);
        }

        .achievement-card.locked:hover {
            transform: translateY(-2px);
        }

        .achievement-card .ach-icon {
            font-size: 2.5rem;
            display: block;
            margin-bottom: 6px;
        }

        .achievement-card .ach-name {
            font-weight: 700;
            font-size: 0.95rem;
            color: #1a1a2e;
            display: block;
        }

        .achievement-card .ach-desc {
            font-size: 0.75rem;
            color: #6b7280;
            display: block;
            margin: 4px 0 8px 0;
            line-height: 1.3;
        }

        /* Progress display - ?/3 or ?/6 */
        .ach-progress-text {
            font-size: 0.85rem;
            font-weight: 600;
            color: #4a6cf7;
            display: block;
            margin-bottom: 6px;
        }

        .ach-progress-text .current {
            color: #4a6cf7;
        }

        .ach-progress-text .required {
            color: #9ca3af;
        }

        .achievement-card.unlocked .ach-progress-text .current {
            color: #f59e0b;
        }

        .achievement-card.unlocked .ach-progress-text .required {
            color: #fbbf24;
        }

        .achievement-card .ach-progress {
            width: 100%;
            height: 4px;
            background: #e5e7eb;
            border-radius: 2px;
            overflow: hidden;
        }

        .achievement-card .ach-progress-fill {
            height: 100%;
            border-radius: 2px;
            transition: width 1s ease;
        }

        .achievement-card.unlocked .ach-progress-fill {
            background: linear-gradient(90deg, #f59e0b, #fbbf24);
        }

        .achievement-card.locked .ach-progress-fill {
            background: #9ca3af;
        }

        .achievement-card .ach-status {
            font-size: 0.6rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 6px;
            display: block;
        }

        .achievement-card.unlocked .ach-status {
            color: #f59e0b;
        }

        .achievement-card.locked .ach-status {
            color: #9ca3af;
        }

        /* Unlock animation */
        .achievement-card.unlocked {
            animation: unlockPulse 2s ease;
        }

        @keyframes unlockPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.03); box-shadow: 0 0 30px rgba(245, 158, 11, 0.3); }
        }

        /* Empty state */
        .empty-achievements {
            text-align: center;
            padding: 40px 20px;
            color: #6b7280;
        }

        .empty-achievements .big-icon {
            font-size: 4rem;
            display: block;
            margin-bottom: 16px;
        }

        .empty-achievements h3 {
            color: #1a1a2e;
            margin-bottom: 8px;
        }

        /* ============================================
           DARK MODE OVERRIDES
           ============================================ */
        body.dark-mode .achievements-header h2 {
            color: #e8e8f0;
        }

        body.dark-mode .achievements-header .subtitle {
            color: #a8a8c0;
        }

        body.dark-mode .overview-card {
            background: #12122a;
            border-color: #2a2a5a;
        }

        body.dark-mode .overview-card .number {
            color: #818cf8;
        }

        body.dark-mode .overview-card .label {
            color: #a8a8c0;
        }

        body.dark-mode .overview-card .icon {
            color: #e8e8f0;
        }

        body.dark-mode .overall-progress {
            background: #12122a;
            border-color: #2a2a5a;
        }

        body.dark-mode .overall-progress-header .title {
            color: #e8e8f0;
        }

        body.dark-mode .overall-progress-header .count {
            color: #a8a8c0;
        }

        body.dark-mode .overall-progress-header .count strong {
            color: #818cf8;
        }

        body.dark-mode .progress-track {
            background: #2a2a5a;
        }

        body.dark-mode .mood-achievements-title {
            color: #e8e8f0;
        }

        body.dark-mode .achievement-card {
            background: #12122a;
            border-color: #2a2a5a;
        }

        body.dark-mode .achievement-card.unlocked {
            background: linear-gradient(135deg, #1a1a3e 0%, #12122a 100%);
            border-color: #f59e0b;
        }

        body.dark-mode .achievement-card .ach-name {
            color: #e8e8f0;
        }

        body.dark-mode .achievement-card .ach-desc {
            color: #a8a8c0;
        }

        body.dark-mode .ach-progress-text {
            color: #818cf8;
        }

        body.dark-mode .ach-progress-text .current {
            color: #818cf8;
        }

        body.dark-mode .ach-progress-text .required {
            color: #6a6a8a;
        }

        body.dark-mode .achievement-card.unlocked .ach-progress-text .current {
            color: #f59e0b;
        }

        body.dark-mode .achievement-card.unlocked .ach-progress-text .required {
            color: #fbbf24;
        }

        body.dark-mode .achievement-card .ach-progress {
            background: #2a2a5a;
        }

        body.dark-mode .achievement-card .ach-status {
            color: #a8a8c0;
        }

        body.dark-mode .achievement-card.unlocked .ach-status {
            color: #f59e0b;
        }

        body.dark-mode .achievement-card.locked .ach-status {
            color: #6a6a8a;
        }

        body.dark-mode .empty-achievements {
            color: #a8a8c0;
        }

        body.dark-mode .empty-achievements h3 {
            color: #e8e8f0;
        }

        body.dark-mode .empty-achievements p {
            color: #a8a8c0;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .achievement-overview {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .achievement-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .overview-card .number {
                font-size: 1.6rem;
            }
        }
    </style>
</head>
<body>
    <div class="container achievements-container">
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
            <p class="header-subtitle">Your Mood Achievements</p>
            <div class="header-divider"></div>

            <nav class="main-nav">
                <a href="index.php" class="nav-link">Home</a>
                <a href="search.php" class="nav-link">Search</a>
                <a href="playlist.php" class="nav-link">
                    Playlist <?php echo isset($_SESSION['playlist']) ? '(' . count($_SESSION['playlist']) . ')' : ''; ?>
                </a>
                <a href="achievements.php" class="nav-link <?php echo ($current_page == 'achievements') ? 'active' : ''; ?>">Achievements</a>
            </nav>
        </header>

        <!-- Achievements Header -->
        <div class="achievements-header">
            <h2>🏆 Mood Achievements</h2>
            <p class="subtitle">Collect songs from different moods to unlock badges</p>
        </div>

        <!-- Overview Stats -->
        <div class="achievement-overview">
            <div class="overview-card">
                <span class="icon">🎵</span>
                <span class="number"><?php echo $totalSongs; ?></span>
                <span class="label">Songs in Playlist</span>
            </div>
            <div class="overview-card">
                <span class="icon">🎨</span>
                <span class="number"><?php echo $moodDiversityDisplay; ?></span>
                <span class="label">Moods Collected</span>
            </div>
            <div class="overview-card">
                <span class="icon">🏆</span>
                <span class="number"><?php echo $unlockedCount; ?>/<?php echo $totalAchievements; ?></span>
                <span class="label">Achievements Unlocked</span>
            </div>
        </div>

        <!-- Overall Progress -->
        <div class="overall-progress">
            <div class="overall-progress-header">
                <span class="title">🎯 Overall Progress</span>
                <span class="count"><strong><?php echo $progressPercentage; ?>%</strong> complete</span>
            </div>
            <div class="progress-track">
                <div class="progress-fill" style="width: <?php echo $progressPercentage; ?>%;"></div>
            </div>
        </div>

        <?php if ($totalSongs > 0): ?>
            <!-- Mood Achievements -->
            <div class="mood-achievements-section">
                <div class="mood-achievements-title">🎨 Mood Achievements</div>
                <div class="achievement-grid">
                    <?php foreach ($achievements as $achievement): ?>
                    <div class="achievement-card <?php echo $achievement['unlocked'] ? 'unlocked' : 'locked'; ?>">
                        <span class="ach-icon"><?php echo $achievement['icon']; ?></span>
                        <span class="ach-name"><?php echo $achievement['name']; ?></span>
                        <span class="ach-desc"><?php echo $achievement['description']; ?></span>
                        
                        <!-- Progress Display -->
                        <span class="ach-progress-text">
                            <span class="current"><?php echo $achievement['current']; ?></span>
                            <span class="required">/ <?php echo $achievement['required']; ?></span>
                        </span>
                        
                        <div class="ach-progress">
                            <div class="ach-progress-fill" style="width: <?php echo min(100, $achievement['progress']); ?>%;"></div>
                        </div>
                        <span class="ach-status">
                            <?php echo $achievement['unlocked'] ? '✅ Unlocked' : '🔒 Locked'; ?>
                        </span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <!-- Empty State -->
            <div class="empty-achievements">
                <span class="big-icon">🏆</span>
                <h3>No Achievements Yet</h3>
                <p>Start building your playlist to unlock mood achievements!</p>
                <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; margin-top: 20px;">
                    <a href="index.php" class="btn btn-primary">⭐ Get Recommendations</a>
                    <a href="search.php" class="btn btn-secondary">🔍︎ Search Songs</a>
                </div>
            </div>
        <?php endif; ?>

        <!-- Footer -->
        <div class="footer-info">
            <p class="footer-text">Collect songs from different moods to unlock achievements!</p>
            <p class="footer-copyright">© 2026 Mood Melody · LDCW6123 Group Project</p>
        </div>
    </div>

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

        // Loading progress bars
        document.addEventListener('DOMContentLoaded', function() {
            const progressBars = document.querySelectorAll('.ach-progress-fill');
            progressBars.forEach((bar, index) => {
                const width = bar.style.width;
                bar.style.width = '0%';
                setTimeout(() => {
                    bar.style.width = width;
                }, 100 + (index * 50));
            });
        });

        console.log('🏆 Mood Achievements page loaded');
        console.log('📊 ' + <?php echo $unlockedCount; ?> + ' achievements unlocked out of ' + <?php echo $totalAchievements; ?>);
        console.log('🎨 Mood Diversity: ' + '<?php echo $moodDiversityDisplay; ?>');
    </script>
</body>
</html>