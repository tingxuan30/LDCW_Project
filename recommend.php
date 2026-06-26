<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['emotion'])) {
    $emotion = $_POST['emotion'];
} else {
    header("Location: index.php");
    exit();
}

// ============================================
// MODERN MULTI-SONG RECOMMENDATION DATABASE
// All songs are popular and current (2018-2026)
// ============================================
function getRecommendations($emotion) {
    $recommendations = [
        'happy' => [
            'mood' => 'Joyful',
            'energy' => 'High',
            'description' => 'Upbeat and energetic tracks to amplify your positive vibes.',
            'songs' => [
                [
                    'title' => 'Flowers',
                    'artist' => 'Miley Cyrus',
                    'year' => '2023',
                    'tempo' => '118 BPM',
                    'spotify' => 'https://open.spotify.com/track/0yLdNVWF3Srea0uzk55zFn'
                ],
                [
                    'title' => 'Dance The Night',
                    'artist' => 'Dua Lipa',
                    'year' => '2023',
                    'tempo' => '110 BPM',
                    'spotify' => 'https://open.spotify.com/track/1C0Qy3BcZsd0zYqapB8NmD'
                ],
                [
                    'title' => 'Watermelon Sugar',
                    'artist' => 'Harry Styles',
                    'year' => '2020',
                    'tempo' => '95 BPM',
                    'spotify' => 'https://open.spotify.com/track/6UelLqGlWMcVH1E5c4H7lY'
                ],
                [
                    'title' => 'About Damn Time',
                    'artist' => 'Lizzo',
                    'year' => '2022',
                    'tempo' => '122 BPM',
                    'spotify' => 'https://open.spotify.com/track/1PckUlxKqWQs3RlWXVBLw3'
                ],
                [
                    'title' => 'Levitating',
                    'artist' => 'Dua Lipa',
                    'year' => '2020',
                    'tempo' => '103 BPM',
                    'spotify' => 'https://open.spotify.com/track/39LLxExYz6ewLAcYrzQQyP'
                ]
            ]
        ],
        'sad' => [
            'mood' => 'Melancholic',
            'energy' => 'Low',
            'description' => 'Emotional ballads to help you process and reflect on your feelings.',
            'songs' => [
                [
                    'title' => 'Drivers License',
                    'artist' => 'Olivia Rodrigo',
                    'year' => '2021',
                    'tempo' => '72 BPM',
                    'spotify' => 'https://open.spotify.com/track/5wV9k5KZdlmB8kZQHuWxGZ'
                ],
                [
                    'title' => 'All Too Well (10 Minute Version)',
                    'artist' => 'Taylor Swift',
                    'year' => '2021',
                    'tempo' => '92 BPM',
                    'spotify' => 'https://open.spotify.com/track/5enxwA8aAbwZbf5qCHORXi'
                ],
                [
                    'title' => 'Someone You Loved',
                    'artist' => 'Lewis Capaldi',
                    'year' => '2019',
                    'tempo' => '130 BPM',
                    'spotify' => 'https://open.spotify.com/track/7qEHsqek33rTcFNT9PFqLf'
                ],
                [
                    'title' => 'Easy On Me',
                    'artist' => 'Adele',
                    'year' => '2021',
                    'tempo' => '142 BPM',
                    'spotify' => 'https://open.spotify.com/track/0gplL1WMoJ6iYaPgMCL0gX'
                ],
                [
                    'title' => 'Heather',
                    'artist' => 'Conan Gray',
                    'year' => '2020',
                    'tempo' => '124 BPM',
                    'spotify' => 'https://open.spotify.com/track/4xqrdfXkTW4T0RauPLv3WA'
                ]
            ]
        ],
        'energetic' => [
            'mood' => 'Powerful',
            'energy' => 'Very High',
            'description' => 'High-energy anthems to fuel your drive and motivation.',
            'songs' => [
                [
                    'title' => 'Blinding Lights',
                    'artist' => 'The Weeknd',
                    'year' => '2020',
                    'tempo' => '171 BPM',
                    'spotify' => 'https://open.spotify.com/track/0VjIjW4GlUZAMYd2vXMi3b'
                ],
                [
                    'title' => 'STAY',
                    'artist' => 'The Kid LAROI & Justin Bieber',
                    'year' => '2021',
                    'tempo' => '170 BPM',
                    'spotify' => 'https://open.spotify.com/track/5HCyWlXZPP0y6Gqq8TgA20'
                ],
                [
                    'title' => 'Bad Guy',
                    'artist' => 'Billie Eilish',
                    'year' => '2019',
                    'tempo' => '135 BPM',
                    'spotify' => 'https://open.spotify.com/track/2Fxmhks0bxGSBdJ92vM42m'
                ],
                [
                    'title' => 'Montero (Call Me By Your Name)',
                    'artist' => 'Lil Nas X',
                    'year' => '2021',
                    'tempo' => '178 BPM',
                    'spotify' => 'https://open.spotify.com/track/1qEiqn7qyskhPcwwrZffc0'
                ],
                [
                    'title' => 'Industry Baby',
                    'artist' => 'Lil Nas X & Jack Harlow',
                    'year' => '2021',
                    'tempo' => '150 BPM',
                    'spotify' => 'https://open.spotify.com/track/7Ld5mXbFPvd1dOgOWAUMov'
                ]
            ]
        ],
        'chill' => [
            'mood' => 'Serene',
            'energy' => 'Very Low',
            'description' => 'Calming tracks for relaxation and peaceful moments.',
            'songs' => [
                [
                    'title' => 'Stargazing',
                    'artist' => 'The Neighbourhood',
                    'year' => '2020',
                    'tempo' => '85 BPM',
                    'spotify' => 'https://open.spotify.com/track/3X8OcjPnpY8eXgiKZxfYph'
                ],
                [
                    'title' => 'Heat Waves',
                    'artist' => 'Glass Animals',
                    'year' => '2020',
                    'tempo' => '81 BPM',
                    'spotify' => 'https://open.spotify.com/track/6lz9rPJ7TWhR2MudXkCz2y'
                ],
                [
                    'title' => 'Apocalypse',
                    'artist' => 'Cigarettes After Sex',
                    'year' => '2019',
                    'tempo' => '102 BPM',
                    'spotify' => 'https://open.spotify.com/track/3AVrVz5rK8WrWTOqEYsgsD'
                ],
                [
                    'title' => 'Space Song',
                    'artist' => 'Beach House',
                    'year' => '2019',
                    'tempo' => '80 BPM',
                    'spotify' => 'https://open.spotify.com/track/7H0zh83Y2SxgH8rjscFdx0'
                ],
                [
                    'title' => 'Daylight',
                    'artist' => 'Taylor Swift',
                    'year' => '2019',
                    'tempo' => '88 BPM',
                    'spotify' => 'https://open.spotify.com/track/2TzS6EupL5i3TM5OtkUMSE'
                ]
            ]
        ],
        'romantic' => [
            'mood' => 'Romantic',
            'energy' => 'Medium',
            'description' => 'Beautiful love songs to set the perfect romantic atmosphere.',
            'songs' => [
                [
                    'title' => 'Lover',
                    'artist' => 'Taylor Swift',
                    'year' => '2019',
                    'tempo' => '96 BPM',
                    'spotify' => 'https://open.spotify.com/track/1dGr1c8CrMLDpV6mPbImSI'
                ],
                [
                    'title' => 'Fall In Love',
                    'artist' => 'BENEE ft. Gus Dapperton',
                    'year' => '2021',
                    'tempo' => '107 BPM',
                    'spotify' => 'https://open.spotify.com/track/4lRrHVTzJALZt0rZjvLDJG'
                ],
                [
                    'title' => 'Golden',
                    'artist' => 'Harry Styles',
                    'year' => '2020',
                    'tempo' => '95 BPM',
                    'spotify' => 'https://open.spotify.com/track/45S5WTQEGOB1VHr1Q4FuPl'
                ],
                [
                    'title' => 'Enchanted',
                    'artist' => 'Taylor Swift',
                    'year' => '2023',
                    'tempo' => '144 BPM',
                    'spotify' => 'https://open.spotify.com/track/10eBRyImhfqVvkiVEGf0N0'
                ],
                [
                    'title' => 'Happier Than Ever',
                    'artist' => 'Billie Eilish',
                    'year' => '2021',
                    'tempo' => '120 BPM',
                    'spotify' => 'https://open.spotify.com/track/4RVwu0g32PAqgUiJoXsdF8'
                ]
            ]
        ],
        'motivated' => [
            'mood' => 'Determined',
            'energy' => 'High',
            'description' => 'Inspirational tracks to push you toward your goals.',
            'songs' => [
                [
                    'title' => 'Believer',
                    'artist' => 'Imagine Dragons',
                    'year' => '2017',
                    'tempo' => '126 BPM',
                    'spotify' => 'https://open.spotify.com/track/0pqnGHJpmpxLKifKRmU6WP'
                ],
                [
                    'title' => 'Whatever It Takes',
                    'artist' => 'Imagine Dragons',
                    'year' => '2017',
                    'tempo' => '135 BPM',
                    'spotify' => 'https://open.spotify.com/track/6Qn5zhYkTa37e91HC1D7lb'
                ],
                [
                    'title' => 'Unstoppable',
                    'artist' => 'Sia',
                    'year' => '2016',
                    'tempo' => '133 BPM',
                    'spotify' => 'https://open.spotify.com/track/1yvMUkIOTeUNtNWlWRgANS'
                ],
                [
                    'title' => 'The Greatest',
                    'artist' => 'Sia ft. Kendrick Lamar',
                    'year' => '2016',
                    'tempo' => '140 BPM',
                    'spotify' => 'https://open.spotify.com/track/7HmbwW39tPlqPDHcN8n2gR'
                ],
                [
                    'title' => 'Courage To Change',
                    'artist' => 'Sia',
                    'year' => '2020',
                    'tempo' => '125 BPM',
                    'spotify' => 'https://open.spotify.com/track/5KMRgOGCokWmzO3sObi9gW'
                ]
            ]
        ],
        'nostalgic' => [
            'mood' => 'Reflective',
            'energy' => 'Variable',
            'description' => 'Modern songs with a nostalgic feel that bring back memories.',
            'songs' => [
                [
                    'title' => 'As It Was',
                    'artist' => 'Harry Styles',
                    'year' => '2022',
                    'tempo' => '87 BPM',
                    'spotify' => 'https://open.spotify.com/track/4Dvkj6JhhA12EX05fT7y2e'
                ],
                [
                    'title' => 'Shallow',
                    'artist' => 'Lady Gaga & Bradley Cooper',
                    'year' => '2018',
                    'tempo' => '96 BPM',
                    'spotify' => 'https://open.spotify.com/track/2VxeLyX666F8uXCJ0dZF8B'
                ],
                [
                    'title' => 'The Night We Met',
                    'artist' => 'Lord Huron',
                    'year' => '2015',
                    'tempo' => '145 BPM',
                    'spotify' => 'https://open.spotify.com/track/0QZ5yyl6B6utIWkxeBDxQN'
                ],
                [
                    'title' => 'Sweather Weather',
                    'artist' => 'The Neighbourhood',
                    'year' => '2013',
                    'tempo' => '124 BPM',
                    'spotify' => 'https://open.spotify.com/track/2QjOHCTQ1Jl3zawyYOpxh6'
                ],
                [
                    'title' => 'Teenage Dream',
                    'artist' => 'Katy Perry',
                    'year' => '2021',
                    'tempo' => '120 BPM',
                    'spotify' => 'https://open.spotify.com/track/5XH9Q2UGfKHkwkSHLJ6HBA'
                ]
            ]
        ],
        'angry' => [
            'mood' => 'Aggressive',
            'energy' => 'Very High',
            'description' => 'Intense tracks to help release frustration and tension.',
            'songs' => [
                [
                    'title' => 'Emo Girl',
                    'artist' => 'Machine Gun Kelly ft. WILLOW',
                    'year' => '2022',
                    'tempo' => '165 BPM',
                    'spotify' => 'https://open.spotify.com/track/7Fm5dKpDCTntnNQcYq6pqM'
                ],
                [
                    'title' => 'My Ex\'s Best Friend',
                    'artist' => 'Machine Gun Kelly ft. blackbear',
                    'year' => '2020',
                    'tempo' => '160 BPM',
                    'spotify' => 'https://open.spotify.com/track/70rSUYxSZbVxlK9R2Hl8xO'
                ],
                [
                    'title' => 'Karma',
                    'artist' => 'Taylor Swift',
                    'year' => '2022',
                    'tempo' => '90 BPM',
                    'spotify' => 'https://open.spotify.com/track/7KokYm8cMIXCsGVmUvKtqf'
                ],
                [
                    'title' => 'Vigilante Shit',
                    'artist' => 'Taylor Swift',
                    'year' => '2022',
                    'tempo' => '80 BPM',
                    'spotify' => 'https://open.spotify.com/track/1xw6ZbGdiVY10u1dR1YSNB'
                ],
                [
                    'title' => 'Happier Than Ever (Edit)',
                    'artist' => 'Billie Eilish',
                    'year' => '2021',
                    'tempo' => '120 BPM',
                    'spotify' => 'https://open.spotify.com/track/7HkLpS3ukD9Yw2FqtZitR4'
                ]
            ]
        ],
        'anxious' => [
            'mood' => 'Calm',
            'energy' => 'Low',
            'description' => 'Soothing tracks to ease anxiety and promote mental clarity.',
            'songs' => [
                [
                    'title' => 'Lose You To Love Me',
                    'artist' => 'Selena Gomez',
                    'year' => '2019',
                    'tempo' => '80 BPM',
                    'spotify' => 'https://open.spotify.com/track/4l0Mvzj72xxOpRrp6h8nHi'
                ],
                [
                    'title' => 'Hold On',
                    'artist' => 'Adele',
                    'year' => '2021',
                    'tempo' => '70 BPM',
                    'spotify' => 'https://open.spotify.com/track/6sSKnP5p4QWqKpUDQNAwLK'
                ],
                [
                    'title' => 'My Tears Ricochet',
                    'artist' => 'Taylor Swift',
                    'year' => '2020',
                    'tempo' => '85 BPM',
                    'spotify' => 'https://open.spotify.com/track/1MgT5flMsO6STqhzVnQFmZ'
                ],
                [
                    'title' => 'Everybody Wants To Rule The World',
                    'artist' => 'Lorde',
                    'year' => '2021',
                    'tempo' => '110 BPM',
                    'spotify' => 'https://open.spotify.com/track/4D2ESLtxA8dwH4w2EtfgbV'
                ],
                [
                    'title' => 'No Time To Die',
                    'artist' => 'Billie Eilish',
                    'year' => '2020',
                    'tempo' => '120 BPM',
                    'spotify' => 'https://open.spotify.com/track/73SpzrcaHk0RQPFP73vqVR'
                ]
            ]
        ],
        'grateful' => [
            'mood' => 'Appreciative',
            'energy' => 'Medium-Low',
            'description' => 'Heartfelt songs that celebrate gratitude and appreciation.',
            'songs' => [
                [
                    'title' => 'Grateful',
                    'artist' => 'NEFFEX',
                    'year' => '2020',
                    'tempo' => '128 BPM',
                    'spotify' => 'https://open.spotify.com/track/4Jxs7D0gAq0b3LvRIJ7bVf'
                ],
                [
                    'title' => 'Dear God',
                    'artist' => 'Dax',
                    'year' => '2021',
                    'tempo' => '85 BPM',
                    'spotify' => 'https://open.spotify.com/track/3m3x3dHllt6W3D9KjEeSpJ'
                ],
                [
                    'title' => 'Thank God I Do',
                    'artist' => 'Lauren Daigle',
                    'year' => '2023',
                    'tempo' => '85 BPM',
                    'spotify' => 'https://open.spotify.com/track/60boA3e7vPUCf2NqaWjq0i'
                ],
                [
                    'title' => 'Rise Up',
                    'artist' => 'Andra Day',
                    'year' => '2015',
                    'tempo' => '72 BPM',
                    'spotify' => 'https://open.spotify.com/track/0tV8pOpiNsKqUys0ilUcXz'
                ],
                [
                    'title' => 'Fight Song',
                    'artist' => 'Rachel Platten',
                    'year' => '2015',
                    'tempo' => '135 BPM',
                    'spotify' => 'https://open.spotify.com/track/37f4ITSlgPX81ad2EvmVQr'
                ]
            ]
        ],
        'hopeful' => [
            'mood' => 'Optimistic',
            'energy' => 'Medium',
            'description' => 'Inspiring tracks that fill you with hope and positivity.',
            'songs' => [
                [
                    'title' => 'High Hopes',
                    'artist' => 'Panic! At The Disco',
                    'year' => '2018',
                    'tempo' => '82 BPM',
                    'spotify' => 'https://open.spotify.com/track/1rqqCSm0Qe4I9rUvWnCAom'
                ],
                [
                    'title' => 'Better Days',
                    'artist' => 'NEIKED ft. Mae Muller & Polo G',
                    'year' => '2021',
                    'tempo' => '90 BPM',
                    'spotify' => 'https://open.spotify.com/track/5bDx1QhXp9a5V6uCFCdqJ0'
                ],
                [
                    'title' => 'I\'m Good (Blue)',
                    'artist' => 'David Guetta & Bebe Rexha',
                    'year' => '2022',
                    'tempo' => '128 BPM',
                    'spotify' => 'https://open.spotify.com/track/4cD58psRXl8K3Ug0vRSjYh'
                ],
                [
                    'title' => 'Let Me Down Slowly',
                    'artist' => 'Alec Benjamin',
                    'year' => '2018',
                    'tempo' => '80 BPM',
                    'spotify' => 'https://open.spotify.com/track/2qxmye6gkb9YcD7cLg3QjR'
                ],
                [
                    'title' => 'Break My Heart',
                    'artist' => 'Dua Lipa',
                    'year' => '2020',
                    'tempo' => '110 BPM',
                    'spotify' => 'https://open.spotify.com/track/017PF4Q3l4DBUiWoXk4OWT'
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