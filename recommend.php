<?php
session_start();

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['emotion'])) {
    $emotion = $_POST['emotion'];
} else {
    header("Location: index.php");
    exit();
}

// Song recommendation database
function getRecommendation($emotion) {
    $recommendations = [
        'happy' => [
            'song' => 'Happy',
            'artist' => 'Pharrell Williams',
            'year' => '2013',
            'description' => 'An upbeat, feel-good anthem that celebrates joy and positivity. This Grammy-winning hit features an infectious rhythm and uplifting lyrics that naturally elevate mood and inspire dancing.',
            'mood' => 'Joyful',
            'energy' => 'High',
            'tempo' => '160 BPM',
            'key' => 'F Minor',
            'spotify' => 'https://open.spotify.com/track/60nZcImufyMA1MKQY3dcCH'
        ],
        'sad' => [
            'song' => 'Someone Like You',
            'artist' => 'Adele',
            'year' => '2011',
            'description' => 'A soulful, emotional ballad about heartbreak and moving forward. Adele\'s powerful vocals and the minimalist piano accompaniment create a deeply moving experience that resonates with those processing loss.',
            'mood' => 'Melancholic',
            'energy' => 'Low',
            'tempo' => '68 BPM',
            'key' => 'A Major',
            'spotify' => 'https://open.spotify.com/track/1kr1K0Jtu5EfrP7mnFwLSS'
        ],
        'energetic' => [
            'song' => 'Eye of the Tiger',
            'artist' => 'Survivor',
            'year' => '1982',
            'description' => 'The ultimate pump-up anthem featuring driving guitar riffs and powerful vocals. This iconic rock track has motivated athletes and individuals worldwide, making it the perfect choice for high-energy moments.',
            'mood' => 'Powerful',
            'energy' => 'Very High',
            'tempo' => '109 BPM',
            'key' => 'C Minor',
            'spotify' => 'https://open.spotify.com/track/2KH16WveTQWT6KOG9Rg6e2'
        ],
        'chill' => [
            'song' => 'Weightless',
            'artist' => 'Marconi Union',
            'year' => '2011',
            'description' => 'Scientifically proven to reduce anxiety by 65%, this ambient instrumental features carefully arranged harmonies and rhythms designed to induce a state of deep relaxation and mental clarity.',
            'mood' => 'Serene',
            'energy' => 'Very Low',
            'tempo' => '60 BPM',
            'key' => 'F Major',
            'spotify' => 'https://open.spotify.com/track/3lMqkzA9hN9jH3vKPlq2vR'
        ],
        'romantic' => [
            'song' => 'Perfect',
            'artist' => 'Ed Sheeran',
            'year' => '2017',
            'description' => 'A beautiful, heartfelt acoustic love song that captures the magic of finding your soulmate. The gentle guitar melody and sincere lyrics create an intimate atmosphere perfect for romantic moments.',
            'mood' => 'Romantic',
            'energy' => 'Medium',
            'tempo' => '95 BPM',
            'key' => 'Ab Major',
            'spotify' => 'https://open.spotify.com/track/0tgVpDi06FyKpA1z0VMD4v'
        ],
        'motivated' => [
            'song' => 'Lose Yourself',
            'artist' => 'Eminem',
            'year' => '2002',
            'description' => 'An Oscar-winning motivational anthem with intense lyrical delivery and powerful production. This track inspires listeners to seize opportunities and push beyond their limits with unwavering determination.',
            'mood' => 'Determined',
            'energy' => 'High',
            'tempo' => '86 BPM',
            'key' => 'D Minor',
            'spotify' => 'https://open.spotify.com/track/5Z01UMMf7V1o0MzF86s6WJ'
        ],
        'nostalgic' => [
            'song' => 'Bohemian Rhapsody',
            'artist' => 'Queen',
            'year' => '1975',
            'description' => 'A timeless rock opera masterpiece that transcends generations. This iconic composition blends multiple musical styles and showcases extraordinary vocal harmonies, creating a nostalgic journey through music history.',
            'mood' => 'Reflective',
            'energy' => 'Variable',
            'tempo' => '72 BPM',
            'key' => 'Bb Major',
            'spotify' => 'https://open.spotify.com/track/1z7HZ3F2lZt8xUdh9gKtDZ'
        ],
        'angry' => [
            'song' => 'Break Stuff',
            'artist' => 'Limp Bizkit',
            'year' => '1999',
            'description' => 'A cathartic nu-metal anthem that channels frustration into powerful, aggressive energy. The heavy guitar riffs and intense vocals provide a healthy outlet for processing and releasing anger.',
            'mood' => 'Aggressive',
            'energy' => 'Very High',
            'tempo' => '103 BPM',
            'key' => 'D Major',
            'spotify' => 'https://open.spotify.com/track/5cZqsjVs6MevCnAkasbEOX'
        ],
        'anxious' => [
            'song' => 'Breathe',
            'artist' => 'Telepopmusik',
            'year' => '2002',
            'description' => 'A soothing electronic track designed to calm anxious thoughts. The gentle beats, atmospheric textures, and repetitive melodic patterns guide listeners toward a state of peace and mental clarity.',
            'mood' => 'Calm',
            'energy' => 'Low',
            'tempo' => '96 BPM',
            'key' => 'G Minor',
            'spotify' => 'https://open.spotify.com/track/6oJz3P80hzQL64M1bbNTR3'
        ],
        'grateful' => [
            'song' => 'Thank You',
            'artist' => 'Dido',
            'year' => '2000',
            'description' => 'A gentle, heartfelt song about appreciation and gratitude. The delicate production and sincere vocals create a warm atmosphere perfect for reflecting on life\'s blessings and meaningful connections.',
            'mood' => 'Appreciative',
            'energy' => 'Medium-Low',
            'tempo' => '82 BPM',
            'key' => 'Eb Major',
            'spotify' => 'https://open.spotify.com/track/3fzCJEA9FGcoJ0bN5T2F6p'
        ]
    ];

    return $recommendations[$emotion] ?? null;
}

$recommendation = getRecommendation($emotion);

if (!$recommendation) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recommendation · Mood Melody</title>
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
            <p class="header-subtitle">Your Personalized Song Recommendation</p>
            <div class="header-divider"></div>
        </header>

        <!-- Results Content -->
        <main class="main-content">
            <div class="result-card">
                <!-- Result Header -->
                <div class="result-header">
                    <div class="mood-badge">
                        <span class="badge-label">Mood</span>
                        <span class="badge-value"><?php echo htmlspecialchars($recommendation['mood']); ?></span>
                    </div>
                    <div class="energy-badge">
                        <span class="badge-label">Energy Level</span>
                        <span class="badge-value"><?php echo htmlspecialchars($recommendation['energy']); ?></span>
                    </div>
                </div>

                <!-- Song Information -->
                <div class="song-display">
                    <div class="song-icon">♫</div>
                    <h2 class="song-title"><?php echo htmlspecialchars($recommendation['song']); ?></h2>
                    <p class="song-artist"><?php echo htmlspecialchars($recommendation['artist']); ?></p>
                    <div class="song-metadata">
                        <span class="metadata-item">Released <?php echo $recommendation['year']; ?></span>
                        <span class="metadata-separator">·</span>
                        <span class="metadata-item"><?php echo $recommendation['tempo']; ?></span>
                        <span class="metadata-separator">·</span>
                        <span class="metadata-item">Key: <?php echo $recommendation['key']; ?></span>
                    </div>
                </div>

                <!-- Description -->
                <div class="description-section">
                    <h3 class="description-title">About This Recommendation</h3>
                    <p class="description-text"><?php echo htmlspecialchars($recommendation['description']); ?></p>
                </div>

                <!-- Action Buttons -->
                <div class="action-section">
                    <a href="<?php echo $recommendation['spotify']; ?>" target="_blank" class="btn btn-primary">
                        <span class="btn-icon">▶</span> Listen on Spotify
                    </a>
                    <a href="index.php" class="btn btn-secondary">
                        <span class="btn-icon">←</span> Select Another Mood
                    </a>
                </div>
            </div>

            <!-- Quick Reference Stats -->
            <div class="stats-grid">
                <div class="stat-card">
                    <span class="stat-label">Selected Emotion</span>
                    <span class="stat-value" style="text-transform: capitalize;"><?php echo ucfirst($emotion); ?></span>
                </div>
                <div class="stat-card">
                    <span class="stat-label">Release Year</span>
                    <span class="stat-value"><?php echo $recommendation['year']; ?></span>
                </div>
                <div class="stat-card">
                    <span class="stat-label">Tempo</span>
                    <span class="stat-value"><?php echo $recommendation['tempo']; ?></span>
                </div>
                <div class="stat-card">
                    <span class="stat-label">Energy Level</span>
                    <span class="stat-value"><?php echo $recommendation['energy']; ?></span>
                </div>
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