<?php
// ============================================
// SONG DATABASE - Shared across all pages
// ============================================

function getAllSongs() {
    return [
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
                    'spotify' => 'https://open.spotify.com/track/0yLdNVWF3Srea0uzk55zFn',
                    'image' => 'image/flowers.png'
                ],
                [
                    'title' => 'Dance The Night',
                    'artist' => 'Dua Lipa',
                    'year' => '2023',
                    'tempo' => '110 BPM',
                    'spotify' => 'https://open.spotify.com/track/1C0Qy3BcZsd0zYqapB8NmD',
                    'image' => 'image/x.jpg'
                ],
                [
                    'title' => 'Watermelon Sugar',
                    'artist' => 'Harry Styles',
                    'year' => '2020',
                    'tempo' => '95 BPM',
                    'spotify' => 'https://open.spotify.com/track/6UelLqGlWMcVH1E5c4H7lY',
                    'image' => 'image/watermelon-sugar.png'
                ],
                [
                    'title' => 'About Damn Time',
                    'artist' => 'Lizzo',
                    'year' => '2022',
                    'tempo' => '122 BPM',
                    'spotify' => 'https://open.spotify.com/track/1PckUlxKqWQs3RlWXVBLw3',
                    'image' => 'image/about-damn-time.png'
                ],
                [
                    'title' => 'Levitating',
                    'artist' => 'Dua Lipa',
                    'year' => '2020',
                    'tempo' => '103 BPM',
                    'spotify' => 'https://open.spotify.com/track/39LLxExYz6ewLAcYrzQQyP',
                    'image' => 'image/flevitating.png'
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
                    'spotify' => 'https://open.spotify.com/track/5wV9k5KZdlmB8kZQHuWxGZ',
                    'image' => 'image/x.jpg'
                ],
                [
                    'title' => 'All Too Well (10 Minute Version)',
                    'artist' => 'Taylor Swift',
                    'year' => '2021',
                    'tempo' => '92 BPM',
                    'spotify' => 'https://open.spotify.com/track/5enxwA8aAbwZbf5qCHORXi',
                    'image' => 'image/x.jpg'
                ],
                [
                    'title' => 'Someone You Loved',
                    'artist' => 'Lewis Capaldi',
                    'year' => '2019',
                    'tempo' => '130 BPM',
                    'spotify' => 'https://open.spotify.com/track/7qEHsqek33rTcFNT9PFqLf',
                    'image' => 'image/someone-you-loved.png'
                ],
                [
                    'title' => 'Easy On Me',
                    'artist' => 'Adele',
                    'year' => '2021',
                    'tempo' => '142 BPM',
                    'spotify' => 'https://open.spotify.com/track/0gplL1WMoJ6iYaPgMCL0gX',
                    'image' => 'image/easy-on-me.png'
                ],
                [
                    'title' => 'Heather',
                    'artist' => 'Conan Gray',
                    'year' => '2020',
                    'tempo' => '124 BPM',
                    'spotify' => 'https://open.spotify.com/track/4xqrdfXkTW4T0RauPLv3WA',
                    'image' => 'image/heather.png'
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
                    'spotify' => 'https://open.spotify.com/track/0VjIjW4GlUZAMYd2vXMi3b',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'STAY',
                    'artist' => 'The Kid LAROI & Justin Bieber',
                    'year' => '2021',
                    'tempo' => '170 BPM',
                    'spotify' => 'https://open.spotify.com/track/5HCyWlXZPP0y6Gqq8TgA20',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'Bad Guy',
                    'artist' => 'Billie Eilish',
                    'year' => '2019',
                    'tempo' => '135 BPM',
                    'spotify' => 'https://open.spotify.com/track/2Fxmhks0bxGSBdJ92vM42m',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'Montero (Call Me By Your Name)',
                    'artist' => 'Lil Nas X',
                    'year' => '2021',
                    'tempo' => '178 BPM',
                    'spotify' => 'https://open.spotify.com/track/1qEiqn7qyskhPcwwrZffc0',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'Industry Baby',
                    'artist' => 'Lil Nas X & Jack Harlow',
                    'year' => '2021',
                    'tempo' => '150 BPM',
                    'spotify' => 'https://open.spotify.com/track/7Ld5mXbFPvd1dOgOWAUMov',
                    'image' => 'image/flevitating.jpg'
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
                    'spotify' => 'https://open.spotify.com/track/3X8OcjPnpY8eXgiKZxfYph',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'Heat Waves',
                    'artist' => 'Glass Animals',
                    'year' => '2020',
                    'tempo' => '81 BPM',
                    'spotify' => 'https://open.spotify.com/track/6lz9rPJ7TWhR2MudXkCz2y',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'Apocalypse',
                    'artist' => 'Cigarettes After Sex',
                    'year' => '2019',
                    'tempo' => '102 BPM',
                    'spotify' => 'https://open.spotify.com/track/3AVrVz5rK8WrWTOqEYsgsD',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'Space Song',
                    'artist' => 'Beach House',
                    'year' => '2019',
                    'tempo' => '80 BPM',
                    'spotify' => 'https://open.spotify.com/track/7H0zh83Y2SxgH8rjscFdx0',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'Daylight',
                    'artist' => 'Taylor Swift',
                    'year' => '2019',
                    'tempo' => '88 BPM',
                    'spotify' => 'https://open.spotify.com/track/2TzS6EupL5i3TM5OtkUMSE',
                    'image' => 'image/flevitating.jpg'
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
                    'spotify' => 'https://open.spotify.com/track/1dGr1c8CrMLDpV6mPbImSI',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'Fall In Love',
                    'artist' => 'BENEE ft. Gus Dapperton',
                    'year' => '2021',
                    'tempo' => '107 BPM',
                    'spotify' => 'https://open.spotify.com/track/4lRrHVTzJALZt0rZjvLDJG',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'Golden',
                    'artist' => 'Harry Styles',
                    'year' => '2020',
                    'tempo' => '95 BPM',
                    'spotify' => 'https://open.spotify.com/track/45S5WTQEGOB1VHr1Q4FuPl',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'Enchanted',
                    'artist' => 'Taylor Swift',
                    'year' => '2023',
                    'tempo' => '144 BPM',
                    'spotify' => 'https://open.spotify.com/track/10eBRyImhfqVvkiVEGf0N0',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'Happier Than Ever',
                    'artist' => 'Billie Eilish',
                    'year' => '2021',
                    'tempo' => '120 BPM',
                    'spotify' => 'https://open.spotify.com/track/4RVwu0g32PAqgUiJoXsdF8',
                    'image' => 'image/flevitating.jpg'
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
                    'spotify' => 'https://open.spotify.com/track/0pqnGHJpmpxLKifKRmU6WP',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'Whatever It Takes',
                    'artist' => 'Imagine Dragons',
                    'year' => '2017',
                    'tempo' => '135 BPM',
                    'spotify' => 'https://open.spotify.com/track/6Qn5zhYkTa37e91HC1D7lb',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'Unstoppable',
                    'artist' => 'Sia',
                    'year' => '2016',
                    'tempo' => '133 BPM',
                    'spotify' => 'https://open.spotify.com/track/1yvMUkIOTeUNtNWlWRgANS',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'The Greatest',
                    'artist' => 'Sia ft. Kendrick Lamar',
                    'year' => '2016',
                    'tempo' => '140 BPM',
                    'spotify' => 'https://open.spotify.com/track/7HmbwW39tPlqPDHcN8n2gR',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'Courage To Change',
                    'artist' => 'Sia',
                    'year' => '2020',
                    'tempo' => '125 BPM',
                    'spotify' => 'https://open.spotify.com/track/5KMRgOGCokWmzO3sObi9gW',
                    'image' => 'image/flevitating.jpg'
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
                    'spotify' => 'https://open.spotify.com/track/4Dvkj6JhhA12EX05fT7y2e',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'Shallow',
                    'artist' => 'Lady Gaga & Bradley Cooper',
                    'year' => '2018',
                    'tempo' => '96 BPM',
                    'spotify' => 'https://open.spotify.com/track/2VxeLyX666F8uXCJ0dZF8B',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'The Night We Met',
                    'artist' => 'Lord Huron',
                    'year' => '2015',
                    'tempo' => '145 BPM',
                    'spotify' => 'https://open.spotify.com/track/0QZ5yyl6B6utIWkxeBDxQN',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'Sweather Weather',
                    'artist' => 'The Neighbourhood',
                    'year' => '2013',
                    'tempo' => '124 BPM',
                    'spotify' => 'https://open.spotify.com/track/2QjOHCTQ1Jl3zawyYOpxh6',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'Teenage Dream',
                    'artist' => 'Katy Perry',
                    'year' => '2021',
                    'tempo' => '120 BPM',
                    'spotify' => 'https://open.spotify.com/track/5XH9Q2UGfKHkwkSHLJ6HBA',
                    'image' => 'image/flevitating.jpg'
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
                    'spotify' => 'https://open.spotify.com/track/7Fm5dKpDCTntnNQcYq6pqM',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'My Ex\'s Best Friend',
                    'artist' => 'Machine Gun Kelly ft. blackbear',
                    'year' => '2020',
                    'tempo' => '160 BPM',
                    'spotify' => 'https://open.spotify.com/track/70rSUYxSZbVxlK9R2Hl8xO',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'Karma',
                    'artist' => 'Taylor Swift',
                    'year' => '2022',
                    'tempo' => '90 BPM',
                    'spotify' => 'https://open.spotify.com/track/7KokYm8cMIXCsGVmUvKtqf',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'Vigilante Shit',
                    'artist' => 'Taylor Swift',
                    'year' => '2022',
                    'tempo' => '80 BPM',
                    'spotify' => 'https://open.spotify.com/track/1xw6ZbGdiVY10u1dR1YSNB',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'Happier Than Ever (Edit)',
                    'artist' => 'Billie Eilish',
                    'year' => '2021',
                    'tempo' => '120 BPM',
                    'spotify' => 'https://open.spotify.com/track/7HkLpS3ukD9Yw2FqtZitR4',
                    'image' => 'image/flevitating.jpg'
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
                    'spotify' => 'https://open.spotify.com/track/4l0Mvzj72xxOpRrp6h8nHi',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'Hold On',
                    'artist' => 'Adele',
                    'year' => '2021',
                    'tempo' => '70 BPM',
                    'spotify' => 'https://open.spotify.com/track/6sSKnP5p4QWqKpUDQNAwLK',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'My Tears Ricochet',
                    'artist' => 'Taylor Swift',
                    'year' => '2020',
                    'tempo' => '85 BPM',
                    'spotify' => 'https://open.spotify.com/track/1MgT5flMsO6STqhzVnQFmZ',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'Everybody Wants To Rule The World',
                    'artist' => 'Lorde',
                    'year' => '2021',
                    'tempo' => '110 BPM',
                    'spotify' => 'https://open.spotify.com/track/4D2ESLtxA8dwH4w2EtfgbV',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'No Time To Die',
                    'artist' => 'Billie Eilish',
                    'year' => '2020',
                    'tempo' => '120 BPM',
                    'spotify' => 'https://open.spotify.com/track/73SpzrcaHk0RQPFP73vqVR',
                    'image' => 'image/flevitating.jpg'
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
                    'spotify' => 'https://open.spotify.com/track/4Jxs7D0gAq0b3LvRIJ7bVf',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'Dear God',
                    'artist' => 'Dax',
                    'year' => '2021',
                    'tempo' => '85 BPM',
                    'spotify' => 'https://open.spotify.com/track/3m3x3dHllt6W3D9KjEeSpJ',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'Thank God I Do',
                    'artist' => 'Lauren Daigle',
                    'year' => '2023',
                    'tempo' => '85 BPM',
                    'spotify' => 'https://open.spotify.com/track/60boA3e7vPUCf2NqaWjq0i',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'Rise Up',
                    'artist' => 'Andra Day',
                    'year' => '2015',
                    'tempo' => '72 BPM',
                    'spotify' => 'https://open.spotify.com/track/0tV8pOpiNsKqUys0ilUcXz',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'Fight Song',
                    'artist' => 'Rachel Platten',
                    'year' => '2015',
                    'tempo' => '135 BPM',
                    'spotify' => 'https://open.spotify.com/track/37f4ITSlgPX81ad2EvmVQr',
                    'image' => 'image/flevitating.jpg'
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
                    'spotify' => 'https://open.spotify.com/track/1rqqCSm0Qe4I9rUvWnCAom',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'Better Days',
                    'artist' => 'NEIKED ft. Mae Muller & Polo G',
                    'year' => '2021',
                    'tempo' => '90 BPM',
                    'spotify' => 'https://open.spotify.com/track/5bDx1QhXp9a5V6uCFCdqJ0',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'I\'m Good (Blue)',
                    'artist' => 'David Guetta & Bebe Rexha',
                    'year' => '2022',
                    'tempo' => '128 BPM',
                    'spotify' => 'https://open.spotify.com/track/4cD58psRXl8K3Ug0vRSjYh',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'Let Me Down Slowly',
                    'artist' => 'Alec Benjamin',
                    'year' => '2018',
                    'tempo' => '80 BPM',
                    'spotify' => 'https://open.spotify.com/track/2qxmye6gkb9YcD7cLg3QjR',
                    'image' => 'image/flevitating.jpg'
                ],
                [
                    'title' => 'Break My Heart',
                    'artist' => 'Dua Lipa',
                    'year' => '2020',
                    'tempo' => '110 BPM',
                    'spotify' => 'https://open.spotify.com/track/017PF4Q3l4DBUiWoXk4OWT',
                    'image' => 'image/flevitating.jpg'
                ]
            ]
        ]
    ];
}
?>