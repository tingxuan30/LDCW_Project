<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['emotion'])) {
    $emotion = $_POST['emotion'];
} else {
    header("Location: index.php");
    exit();
}

// ============================================
// MULTI-SONG RECOMMENDATION DATABASE
// Each emotion returns an array of songs
// ============================================
function getRecommendations($emotion) {
    $recommendations = [
        'happy' => [
            'mood' => 'Joyful',
            'energy' => 'High',
            'description' => 'Upbeat and energetic songs to amplify your positive vibes.',
            'songs' => [
                [
                    'title' => 'Happy',
                    'artist' => 'Pharrell Williams',
                    'year' => '2013',
                    'tempo' => '160 BPM',
                    'spotify' => 'https://open.spotify.com/track/60nZcImufyMA1MKQY3dcCH'
                ],
                [
                    'title' => 'Can\'t Stop the Feeling!',
                    'artist' => 'Justin Timberlake',
                    'year' => '2016',
                    'tempo' => '113 BPM',
                    'spotify' => 'https://open.spotify.com/track/1WkMMavIMc4JZ8cfMmxHkI'
                ],
                [
                    'title' => 'Walking on Sunshine',
                    'artist' => 'Katrina & The Waves',
                    'year' => '1985',
                    'tempo' => '112 BPM',
                    'spotify' => 'https://open.spotify.com/track/05wIrZSwuaVWhcv5FfqeH0'
                ],
                [
                    'title' => 'Good Vibrations',
                    'artist' => 'The Beach Boys',
                    'year' => '1966',
                    'tempo' => '138 BPM',
                    'spotify' => 'https://open.spotify.com/track/3oHJ3vTX4VZjdPVlX1e5OP'
                ]
            ]
        ],
        'sad' => [
            'mood' => 'Melancholic',
            'energy' => 'Low',
            'description' => 'Soulful ballads to help you process and reflect on your emotions.',
            'songs' => [
                [
                    'title' => 'Someone Like You',
                    'artist' => 'Adele',
                    'year' => '2011',
                    'tempo' => '68 BPM',
                    'spotify' => 'https://open.spotify.com/track/1kr1K0Jtu5EfrP7mnFwLSS'
                ],
                [
                    'title' => 'Fix You',
                    'artist' => 'Coldplay',
                    'year' => '2005',
                    'tempo' => '68 BPM',
                    'spotify' => 'https://open.spotify.com/track/7LVHVU3tWfcxj5aiPFEW4Q'
                ],
                [
                    'title' => 'The Scientist',
                    'artist' => 'Coldplay',
                    'year' => '2002',
                    'tempo' => '73 BPM',
                    'spotify' => 'https://open.spotify.com/track/75JFxkI2RXiU7L9VXzMk3r'
                ],
                [
                    'title' => 'Nothing Compares 2 U',
                    'artist' => 'Sinead O\'Connor',
                    'year' => '1990',
                    'tempo' => '68 BPM',
                    'spotify' => 'https://open.spotify.com/track/5GHY1DFWKz3Prg2V0Iodqo'
                ]
            ]
        ],
        'energetic' => [
            'mood' => 'Powerful',
            'energy' => 'Very High',
            'description' => 'High-octane anthems to fuel your drive and motivation.',
            'songs' => [
                [
                    'title' => 'Eye of the Tiger',
                    'artist' => 'Survivor',
                    'year' => '1982',
                    'tempo' => '109 BPM',
                    'spotify' => 'https://open.spotify.com/track/2KH16WveTQWT6KOG9Rg6e2'
                ],
                [
                    'title' => 'Thunderstruck',
                    'artist' => 'AC/DC',
                    'year' => '1990',
                    'tempo' => '134 BPM',
                    'spotify' => 'https://open.spotify.com/track/57bgtoPSgt236HzfBOd8kj'
                ],
                [
                    'title' => 'Believer',
                    'artist' => 'Imagine Dragons',
                    'year' => '2017',
                    'tempo' => '126 BPM',
                    'spotify' => 'https://open.spotify.com/track/0pqnGHJpmpxLKifKRmU6WP'
                ],
                [
                    'title' => 'Stronger',
                    'artist' => 'Kanye West',
                    'year' => '2007',
                    'tempo' => '104 BPM',
                    'spotify' => 'https://open.spotify.com/track/0j2T0R9dR9OnJ5sI0HlC9G'
                ]
            ]
        ],
        'chill' => [
            'mood' => 'Serene',
            'energy' => 'Very Low',
            'description' => 'Calming instrumentals and ambient tracks for relaxation.',
            'songs' => [
                [
                    'title' => 'Weightless',
                    'artist' => 'Marconi Union',
                    'year' => '2011',
                    'tempo' => '60 BPM',
                    'spotify' => 'https://open.spotify.com/track/3lMqkzA9hN9jH3vKPlq2vR'
                ],
                [
                    'title' => 'Clair de Lune',
                    'artist' => 'Claude Debussy',
                    'year' => '1905',
                    'tempo' => '70 BPM',
                    'spotify' => 'https://open.spotify.com/track/7cU4vZBRz8cO5CzxLjsT37'
                ],
                [
                    'title' => 'Breathe',
                    'artist' => 'Telepopmusik',
                    'year' => '2002',
                    'tempo' => '96 BPM',
                    'spotify' => 'https://open.spotify.com/track/6oJz3P80hzQL64M1bbNTR3'
                ],
                [
                    'title' => 'Sunset Lover',
                    'artist' => 'Petit Biscuit',
                    'year' => '2017',
                    'tempo' => '98 BPM',
                    'spotify' => 'https://open.spotify.com/track/0hN7WxILMPWx2nP62CKv4j'
                ]
            ]
        ],
        'romantic' => [
            'mood' => 'Romantic',
            'energy' => 'Medium',
            'description' => 'Heartfelt love songs to set the perfect romantic atmosphere.',
            'songs' => [
                [
                    'title' => 'Perfect',
                    'artist' => 'Ed Sheeran',
                    'year' => '2017',
                    'tempo' => '95 BPM',
                    'spotify' => 'https://open.spotify.com/track/0tgVpDi06FyKpA1z0VMD4v'
                ],
                [
                    'title' => 'Thinking Out Loud',
                    'artist' => 'Ed Sheeran',
                    'year' => '2014',
                    'tempo' => '79 BPM',
                    'spotify' => 'https://open.spotify.com/track/34gCuhDGsG4bRPIf9bb02f'
                ],
                [
                    'title' => 'All of Me',
                    'artist' => 'John Legend',
                    'year' => '2013',
                    'tempo' => '120 BPM',
                    'spotify' => 'https://open.spotify.com/track/3U4isOIWM3VvDubwSI3y7a'
                ],
                [
                    'title' => 'At Last',
                    'artist' => 'Etta James',
                    'year' => '1960',
                    'tempo' => '87 BPM',
                    'spotify' => 'https://open.spotify.com/track/4Hv2c62j7M1Qy4QmQkLgD4'
                ]
            ]
        ],
        'motivated' => [
            'mood' => 'Determined',
            'energy' => 'High',
            'description' => 'Inspirational anthems to push you toward your goals.',
            'songs' => [
                [
                    'title' => 'Lose Yourself',
                    'artist' => 'Eminem',
                    'year' => '2002',
                    'tempo' => '86 BPM',
                    'spotify' => 'https://open.spotify.com/track/5Z01UMMf7V1o0MzF86s6WJ'
                ],
                [
                    'title' => 'Hall of Fame',
                    'artist' => 'The Script ft. will.i.am',
                    'year' => '2012',
                    'tempo' => '164 BPM',
                    'spotify' => 'https://open.spotify.com/track/1X1DWw2pNZ3lR3tRnwXYQp'
                ],
                [
                    'title' => 'Eye of the Tiger',
                    'artist' => 'Survivor',
                    'year' => '1982',
                    'tempo' => '109 BPM',
                    'spotify' => 'https://open.spotify.com/track/2KH16WveTQWT6KOG9Rg6e2'
                ],
                [
                    'title' => 'Unstoppable',
                    'artist' => 'Sia',
                    'year' => '2016',
                    'tempo' => '133 BPM',
                    'spotify' => 'https://open.spotify.com/track/6R8dVbR1cIiW0Ld8QlE1U0'
                ]
            ]
        ],
        'nostalgic' => [
            'mood' => 'Reflective',
            'energy' => 'Variable',
            'description' => 'Timeless classics that bring back cherished memories.',
            'songs' => [
                [
                    'title' => 'Bohemian Rhapsody',
                    'artist' => 'Queen',
                    'year' => '1975',
                    'tempo' => '72 BPM',
                    'spotify' => 'https://open.spotify.com/track/1z7HZ3F2lZt8xUdh9gKtDZ'
                ],
                [
                    'title' => 'Yesterday',
                    'artist' => 'The Beatles',
                    'year' => '1965',
                    'tempo' => '94 BPM',
                    'spotify' => 'https://open.spotify.com/track/1e1G9HxczQzCjCc5Yh8gOb'
                ],
                [
                    'title' => 'Dancing Queen',
                    'artist' => 'ABBA',
                    'year' => '1976',
                    'tempo' => '101 BPM',
                    'spotify' => 'https://open.spotify.com/track/0GjEhVFGZW8afUYGChu3Rr'
                ],
                [
                    'title' => 'Hotel California',
                    'artist' => 'Eagles',
                    'year' => '1977',
                    'tempo' => '144 BPM',
                    'spotify' => 'https://open.spotify.com/track/40riOy7x9W7GXjyGp4pjAv'
                ]
            ]
        ],
        'angry' => [
            'mood' => 'Aggressive',
            'energy' => 'Very High',
            'description' => 'Intense tracks to help release frustration and tension.',
            'songs' => [
                [
                    'title' => 'Break Stuff',
                    'artist' => 'Limp Bizkit',
                    'year' => '1999',
                    'tempo' => '103 BPM',
                    'spotify' => 'https://open.spotify.com/track/5cZqsjVs6MevCnAkasbEOX'
                ],
                [
                    'title' => 'Killing in the Name',
                    'artist' => 'Rage Against the Machine',
                    'year' => '1992',
                    'tempo' => '110 BPM',
                    'spotify' => 'https://open.spotify.com/track/59WN2psjkt1tyaxjspN8fp'
                ],
                [
                    'title' => 'Bodies',
                    'artist' => 'Drowning Pool',
                    'year' => '2001',
                    'tempo' => '110 BPM',
                    'spotify' => 'https://open.spotify.com/track/7wTxDlhE0zSgRCbVMD2x3S'
                ],
                [
                    'title' => 'Numb',
                    'artist' => 'Linkin Park',
                    'year' => '2003',
                    'tempo' => '95 BPM',
                    'spotify' => 'https://open.spotify.com/track/2nLtzopw4rPReszdYBJU6h'
                ]
            ]
        ],
        'anxious' => [
            'mood' => 'Calm',
            'energy' => 'Low',
            'description' => 'Soothing tracks to ease anxiety and promote mental clarity.',
            'songs' => [
                [
                    'title' => 'Breathe',
                    'artist' => 'Telepopmusik',
                    'year' => '2002',
                    'tempo' => '96 BPM',
                    'spotify' => 'https://open.spotify.com/track/6oJz3P80hzQL64M1bbNTR3'
                ],
                [
                    'title' => 'Weightless',
                    'artist' => 'Marconi Union',
                    'year' => '2011',
                    'tempo' => '60 BPM',
                    'spotify' => 'https://open.spotify.com/track/3lMqkzA9hN9jH3vKPlq2vR'
                ],
                [
                    'title' => 'River Flows in You',
                    'artist' => 'Yiruma',
                    'year' => '2001',
                    'tempo' => '66 BPM',
                    'spotify' => 'https://open.spotify.com/track/3xr7COXpgI7BVDb2xsv87F'
                ],
                [
                    'title' => 'Gymnopédie No. 1',
                    'artist' => 'Erik Satie',
                    'year' => '1888',
                    'tempo' => '68 BPM',
                    'spotify' => 'https://open.spotify.com/track/5rPw2r7Hn7Lb3eXsWblwLq'
                ]
            ]
        ],
        'grateful' => [
            'mood' => 'Appreciative',
            'energy' => 'Medium-Low',
            'description' => 'Heartfelt songs that celebrate gratitude and appreciation.',
            'songs' => [
                [
                    'title' => 'Thank You',
                    'artist' => 'Dido',
                    'year' => '2000',
                    'tempo' => '82 BPM',
                    'spotify' => 'https://open.spotify.com/track/3fzCJEA9FGcoJ0bN5T2F6p'
                ],
                [
                    'title' => 'What a Wonderful World',
                    'artist' => 'Louis Armstrong',
                    'year' => '1967',
                    'tempo' => '78 BPM',
                    'spotify' => 'https://open.spotify.com/track/29U7stRjqHU6rMiS8BfaI9'
                ],
                [
                    'title' => 'Count On Me',
                    'artist' => 'Bruno Mars',
                    'year' => '2010',
                    'tempo' => '128 BPM',
                    'spotify' => 'https://open.spotify.com/track/7l1qvxWjxcKpB9PCvhBu2a'
                ],
                [
                    'title' => 'Lean on Me',
                    'artist' => 'Bill Withers',
                    'year' => '1972',
                    'tempo' => '122 BPM',
                    'spotify' => 'https://open.spotify.com/track/3M8Fz2qRRfjM8VhR1o87kB'
                ]
            ]
        ]
    ];

    return $recommendations[$emotion] ?? null;
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

            <!-- Song List -->
            <div class="song-list">
                <?php foreach ($songs as $index => $song): ?>
                <div class="song-item">
                    <div class="song-number"><?php echo $index + 1; ?></div>
                    <div class="song-info">
                        <h3 class="song-title-small"><?php echo htmlspecialchars($song['title']); ?></h3>
                        <p class="song-artist-small"><?php echo htmlspecialchars($song['artist']); ?></p>
                        <div class="song-meta-small">
                            <span><?php echo $song['year']; ?></span>
                            <span class="dot">·</span>
                            <span><?php echo $song['tempo']; ?></span>
                        </div>
                    </div>
                    <a href="<?php echo $song['spotify']; ?>" target="_blank" class="btn btn-small btn-spotify">
                        ▶ Play
                    </a>
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