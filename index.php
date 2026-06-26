<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Melody - Song Recommendation System</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header class="header">
            <div class="header-brand">
                <span class="brand-icon">♪</span>
                <h1>Mood Melody</h1>
            </div>
            <p class="header-subtitle">Intelligent Song Recommendation Engine</p>
            <div class="header-divider"></div>
        </header>

        <!-- Main Content -->
        <main class="main-content">
            <div class="question-section">
                <h2 class="question-title">Select Your Current Emotional State</h2>
                <p class="question-desc">Choose the emotion that best describes your mood to receive a curated song recommendation.</p>
            </div>

            <!-- Emotion Selection Form -->
            <form action="recommend.php" method="POST" class="emotion-form">
                <div class="emotion-grid">
                    <!-- Emotion Cards - No Emojis -->
                    <button type="submit" name="emotion" value="happy" class="emotion-card emotion-happy">
                        <span class="emotion-name">Happy</span>
                        <span class="emotion-desc">Joyful & Uplifting</span>
                    </button>

                    <button type="submit" name="emotion" value="sad" class="emotion-card emotion-sad">
                        <span class="emotion-name">Sad</span>
                        <span class="emotion-desc">Melancholic & Reflective</span>
                    </button>

                    <button type="submit" name="emotion" value="energetic" class="emotion-card emotion-energetic">
                        <span class="emotion-name">Energetic</span>
                        <span class="emotion-desc">High-Power & Dynamic</span>
                    </button>

                    <button type="submit" name="emotion" value="chill" class="emotion-card emotion-chill">
                        <span class="emotion-name">Chill</span>
                        <span class="emotion-desc">Calm & Relaxed</span>
                    </button>

                    <button type="submit" name="emotion" value="romantic" class="emotion-card emotion-romantic">
                        <span class="emotion-name">Romantic</span>
                        <span class="emotion-desc">Passionate & Affectionate</span>
                    </button>

                    <button type="submit" name="emotion" value="motivated" class="emotion-card emotion-motivated">
                        <span class="emotion-name">Motivated</span>
                        <span class="emotion-desc">Driven & Inspired</span>
                    </button>

                    <button type="submit" name="emotion" value="nostalgic" class="emotion-card emotion-nostalgic">
                        <span class="emotion-name">Nostalgic</span>
                        <span class="emotion-desc">Sentimental & Reminiscent</span>
                    </button>

                    <button type="submit" name="emotion" value="angry" class="emotion-card emotion-angry">
                        <span class="emotion-name">Angry</span>
                        <span class="emotion-desc">Intense & Frustrated</span>
                    </button>

                    <button type="submit" name="emotion" value="anxious" class="emotion-card emotion-anxious">
                        <span class="emotion-name">Anxious</span>
                        <span class="emotion-desc">Worried & Uneasy</span>
                    </button>

                    <button type="submit" name="emotion" value="grateful" class="emotion-card emotion-grateful">

                        <span class="emotion-name">Grateful</span>
                        <span class="emotion-desc">Appreciative & Thankful</span>
                    </button>
                </div>
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