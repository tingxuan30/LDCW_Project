<?php
// ============================================
// SONG DATABASE - Shared across all pages
// ============================================

// Mood emoji mapping for easy reference
function getMoodEmojis() {
    return [
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
}

// Get emoji for a specific mood
function getMoodEmoji($mood) {
    $emojis = getMoodEmojis();
    return $emojis[$mood] ?? '🎵';
}

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
                    'title' => 'Espresso',
                    'artist' => 'Sabrina Carpenter',
                    'year' => '2024',
                    'tempo' => '105 BPM',
                    'spotify' => 'https://open.spotify.com/track/2qSkIjg1o9h3YT9RAgYN75',
                    'image' => 'image/espresso.png'
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
                    'image' => 'image/levitating.png'
                ]
            ]
        ],
        'sad' => [
            'mood' => 'Melancholic',
            'energy' => 'Low',
            'description' => 'Emotional ballads to help you process and reflect on your feelings.',
            'songs' => [
                [
                    'title' => 'Lose Control',
                    'artist' => 'Teddy Swims',
                    'year' => '2023',
                    'tempo' => '84 BPM',
                    'spotify' => 'https://open.spotify.com/track/17phhZDn6oGtzMe56NuWvj',
                    'image' => 'image/lose-control.png'
                ],
                [
                    'title' => 'Die For You',
                    'artist' => 'The Weeknd',
                    'year' => '2022',
                    'tempo' => '134 BPM',
                    'spotify' => 'https://open.spotify.com/track/2LBqCSwhJGcFQeTHMVGwy3',
                    'image' => 'image/die-for-you.png'
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
                    'image' => 'image/blinding-light.png'
                ],
                [
                    'title' => 'STAY',
                    'artist' => 'The Kid LAROI & Justin Bieber',
                    'year' => '2021',
                    'tempo' => '170 BPM',
                    'spotify' => 'https://open.spotify.com/track/5HCyWlXZPP0y6Gqq8TgA20',
                    'image' => 'image/stay.png'
                ],
                [
                    'title' => 'Bad Guy',
                    'artist' => 'Billie Eilish',
                    'year' => '2019',
                    'tempo' => '135 BPM',
                    'spotify' => 'https://open.spotify.com/track/2Fxmhks0bxGSBdJ92vM42m',
                    'image' => 'image/bad-guy.png'
                ],
                [
                    'title' => 'Rich Flex',
                    'artist' => 'Drake & 21 Savage',
                    'year' => '2022',
                    'tempo' => '135 BPM',
                    'spotify' => 'https://open.spotify.com/track/1bDbXMyjaUIooNwFE9wn0N',
                    'image' => 'image/rich-flex.png'
                ],
                [
                    'title' => 'Uptown Funk',
                    'artist' => 'Mark Ronson ft. Bruno Mars',
                    'year' => '2014',
                    'tempo' => '115 BPM',
                    'spotify' => 'https://open.spotify.com/track/32OlwWuMpZ6b0aN2RZOeMS',
                    'image' => 'image/uptown-funk.png'
                ]
            ]
        ],
        'chill' => [
            'mood' => 'Serene',
            'energy' => 'Very Low',
            'description' => 'Calming tracks for relaxation and peaceful moments.',
            'songs' => [
                [
                    'title' => 'Ocean Eyes',
                    'artist' => 'Billie Eilish',
                    'year' => '2016',
                    'tempo' => '80 BPM',
                    'spotify' => 'https://open.spotify.com/track/7hDVYcQq6MxkdJGweuCtl9',
                    'image' => 'image/ocean-eyes.png'
                ],
                [
                    'title' => 'Tip Top',
                    'artist' => 'HYBS',
                    'year' => '2023',
                    'tempo' => '122 BPM',
                    'spotify' => 'https://open.spotify.com/track/0MJ5wKsPEeihONNfugHGy7?si=92470cb7183444df',
                    'image' => 'image/tip-top.png'
                ],
                [
                    'title' => 'Better Together',
                    'artist' => 'Jack Johnson',
                    'year' => '2005',
                    'tempo' => '72 BPM',
                    'spotify' => 'https://open.spotify.com/track/2iXdwVdzA0KrI2Q0iZNJbX',
                    'image' => 'image/better-together.png'
                ],
                [
                    'title' => 'Soft Spot',
                    'artist' => 'Keshi',
                    'year' => '2024',
                    'tempo' => '60 BPM',
                    'spotify' => 'https://open.spotify.com/track/2aL4lMGhWdPpyPL6COPou7?si=0729247b5f6045e1',
                    'image' => 'image/soft-spot.png'
                ],
                [
                    'title' => 'Paris in the Rain',
                    'artist' => 'LAUV',
                    'year' => '2018',
                    'tempo' => '81 BPM',
                    'spotify' => 'https://open.spotify.com/track/2WdAV1VqmllcEznKlVOFxG?si=22584d2c14784fa7',
                    'image' => 'image/paris-in-the-rain.png'
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
                    'image' => 'image/lover.png'
                ],
                [
                    'title' => 'Love Story',
                    'artist' => 'Taylor Swift',
                    'year' => '2008',
                    'tempo' => '107 BPM',
                    'spotify' => 'https://open.spotify.com/track/1D4PL9B8gOg78jiHg3FvBb?si=2e530758f8674887',
                    'image' => 'image/love-story.png'
                ],
                [
                    'title' => 'Golden',
                    'artist' => 'Harry Styles',
                    'year' => '2020',
                    'tempo' => '95 BPM',
                    'spotify' => 'https://open.spotify.com/track/45S5WTQEGOB1VHr1Q4FuPl',
                    'image' => 'image/golden.png'
                ],
                [
                    'title' => 'Enchanted',
                    'artist' => 'Taylor Swift',
                    'year' => '2023',
                    'tempo' => '144 BPM',
                    'spotify' => 'https://open.spotify.com/track/10eBRyImhfqVvkiVEGf0N0',
                    'image' => 'image/enchanted.png'
                ],
                [
                    'title' => 'Happier Than Ever',
                    'artist' => 'Billie Eilish',
                    'year' => '2021',
                    'tempo' => '120 BPM',
                    'spotify' => 'https://open.spotify.com/track/4RVwu0g32PAqgUiJoXsdF8',
                    'image' => 'image/happier-than-ever.png'
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
                    'image' => 'image/believer.png'
                ],
                [
                    'title' => 'Whatever It Takes',
                    'artist' => 'Imagine Dragons',
                    'year' => '2017',
                    'tempo' => '135 BPM',
                    'spotify' => 'https://open.spotify.com/track/6Qn5zhYkTa37e91HC1D7lb',
                    'image' => 'image/whatever-it-takes.png'
                ],
                [
                    'title' => 'Unstoppable',
                    'artist' => 'Sia',
                    'year' => '2016',
                    'tempo' => '133 BPM',
                    'spotify' => 'https://open.spotify.com/track/1yvMUkIOTeUNtNWlWRgANS',
                    'image' => 'image/unstoppable.png'
                ],
                [
                    'title' => 'Rise Up',
                    'artist' => 'Andra Day',
                    'year' => '2015',
                    'tempo' => '72 BPM',
                    'spotify' => 'https://open.spotify.com/track/0tV8pOpiNsKqUys0ilUcXz',
                    'image' => 'image/rise-up.png'
                ],
                [
                    'title' => 'Fight Song',
                    'artist' => 'Rachel Platten',
                    'year' => '2015',
                    'tempo' => '135 BPM',
                    'spotify' => 'https://open.spotify.com/track/37f4ITSlgPX81ad2EvmVQr',
                    'image' => 'image/fight-song.png'
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
                    'image' => 'image/as-it-was.png'
                ],
                [
                    'title' => 'Shallow',
                    'artist' => 'Lady Gaga & Bradley Cooper',
                    'year' => '2018',
                    'tempo' => '96 BPM',
                    'spotify' => 'https://open.spotify.com/track/2VxeLyX666F8uXCJ0dZF8B',
                    'image' => 'image/shallow.png'
                ],
                [
                    'title' => 'The Night We Met',
                    'artist' => 'Lord Huron',
                    'year' => '2015',
                    'tempo' => '145 BPM',
                    'spotify' => 'https://open.spotify.com/track/0QZ5yyl6B6utIWkxeBDxQN',
                    'image' => 'image/the-night-we-met.png'
                ],
                [
                    'title' => 'Sweater Weather',
                    'artist' => 'The Neighbourhood',
                    'year' => '2013',
                    'tempo' => '124 BPM',
                    'spotify' => 'https://open.spotify.com/track/2QjOHCTQ1Jl3zawyYOpxh6',
                    'image' => 'image/sweater-weather.png'
                ],
                [
                    'title' => 'Counting Star',
                    'artist' => 'OneRepublic',
                    'year' => '2013',
                    'tempo' => '124 BPM',
                    'spotify' => 'https://open.spotify.com/track/2tpWsVSb9UEmDRxAl1zhX1',
                    'image' => 'image/counting-star.png'
                ]
            ]
        ],
        'angry' => [
            'mood' => 'Aggressive',
            'energy' => 'Very High',
            'description' => 'Intense tracks to help release frustration and tension.',
            'songs' => [
                [
                    'title' => 'Karma',
                    'artist' => 'Taylor Swift',
                    'year' => '2022',
                    'tempo' => '90 BPM',
                    'spotify' => 'https://open.spotify.com/track/7KokYm8cMIXCsGVmUvKtqf',
                    'image' => 'image/karma.png'
                ],
                [
                    'title' => 'Not Like Us',
                    'artist' => 'Kendrick Lamar',
                    'year' => '2024',
                    'tempo' => '100 BPM',
                    'spotify' => 'https://open.spotify.com/track/6AI3ezQ4o3HUoP6Dhudph3',
                    'image' => 'image/not-like-us.png'
                ],
                [
                    'title' => 'One Step Closer',
                    'artist' => 'Linkin Park',
                    'year' => '2000',
                    'tempo' => '95 BPM',
                    'spotify' => 'https://open.spotify.com/track/3K4HG9evC7dg3N0R9cYqk4',
                    'image' => 'image/one-step-closer.png'
                ],
                [
                    'title' => 'Killing In The Name',
                    'artist' => 'Rage Against The Machine',
                    'year' => '1992',
                    'tempo' => '110 BPM',
                    'spotify' => 'https://open.spotify.com/track/59WN2psjkt1tyaxjspN8fp',
                    'image' => 'image/killing-in-the-name.png'
                ],
                [
                    'title' => 'Lose Yourself',
                    'artist' => 'Eminem',
                    'year' => '2002',
                    'tempo' => '86 BPM',
                    'spotify' => 'https://open.spotify.com/track/5Z01UMMf7V1o0MzF86s6WJ',
                    'image' => 'image/lose-yourself.png'
                ]
            ]
        ],
        'anxious' => [
            'mood' => 'Calm',
            'energy' => 'Low',
            'description' => 'Soothing tracks to ease anxiety and promote mental clarity.',
            'songs' => [
                [
                    'title' => 'ANXIETY',
                    'artist' => 'Sleepy Hallow ft. Doechii',
                    'year' => '2025',
                    'tempo' => '140 BPM',
                    'spotify' => 'https://open.spotify.com/track/1musbempyJAw5gfSKZHXP9?si=136651ca60fc49b9',
                    'image' => 'image/anxiety.png'
                ],
                [
                    'title' => 'Lose You To Love Me',
                    'artist' => 'Selena Gomez',
                    'year' => '2019',
                    'tempo' => '80 BPM',
                    'spotify' => 'https://open.spotify.com/track/4l0Mvzj72xxOpRrp6h8nHi',
                    'image' => 'image/lose-you-to-love-me.png'
                ],
                [
                    'title' => 'Hold On',
                    'artist' => 'Adele',
                    'year' => '2021',
                    'tempo' => '82 BPM',
                    'spotify' => 'https://open.spotify.com/track/6bGMSP3H9YqkmaLnaJTIoF?si=ec04c8eb6dad431f',
                    'image' => 'image/hold-on.png'
                ],
                [
                    'title' => 'Everybody Wants To Rule The World',
                    'artist' => 'Lorde',
                    'year' => '2013',
                    'tempo' => '82 BPM',
                    'spotify' => 'https://open.spotify.com/track/3S1tTwSKIZgf4QGltFyCxM?si=343813b51eab4427',
                    'image' => 'image/everybody-wants-to-rule-the-world.png'
                ],
                [
                    'title' => 'No Time To Die',
                    'artist' => 'Billie Eilish',
                    'year' => '2020',
                    'tempo' => '120 BPM',
                    'spotify' => 'https://open.spotify.com/track/73SpzrcaHk0RQPFP73vqVR',
                    'image' => 'image/no-time-to-die.png'
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
                    'artist' => 'Mahalia',
                    'year' => '2019',
                    'tempo' => '128 BPM',
                    'spotify' => 'https://open.spotify.com/track/7mvma3mO5hSyhVbJDXxtFz?si=709c84f7edc34883',
                    'image' => 'image/grateful.png'
                ],
                [
                    'title' => 'Thankful',
                    'artist' => 'Kelly Clarkson',
                    'year' => '2003',
                    'tempo' => '85 BPM',
                    'spotify' => 'https://open.spotify.com/track/51Fy2Y20yZjaL3ffarnW2M?si=ef2810b8cfa44f5b',
                    'image' => 'image/thankful.png'
                ],
                [
                    'title' => 'Thank U',
                    'artist' => 'Alanis Morissette',
                    'year' => '1998',
                    'tempo' => '85 BPM',
                    'spotify' => 'https://open.spotify.com/track/3CVDronuSnhguSUguPoseM?si=e80a59d56dfe4c5b',
                    'image' => 'image/thank-u.png'
                ],
                [
                    'title' => 'Blessings',
                    'artist' => 'Chance the Rapper',
                    'year' => '2016',
                    'tempo' => '72 BPM',
                    'spotify' => 'https://open.spotify.com/track/5IdQEHgtmj9th3OkfQKhf8?si=b1dc4e35be424819',
                    'image' => 'image/blessings.png'
                ],
                [
                    'title' => 'Thank You For Everthing',
                    'artist' => 'Diego Gonzalez',
                    'year' => '2023',
                    'tempo' => '85 BPM',
                    'spotify' => 'https://open.spotify.com/track/5hVdovNC8QAuuJqUnT400l',
                    'image' => 'image/thank-you-for-everything.png'
                ]
            ]
        ],
    ];
}
?>