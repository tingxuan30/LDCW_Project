<?php
session_start();

// Initialize playlist if it doesn't exist
if (!isset($_SESSION['playlist'])) {
    $_SESSION['playlist'] = [];
}

// Set JSON header
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];
    
    switch ($action) {
        case 'add':
            $title = trim($_POST['title'] ?? '');
            $artist = trim($_POST['artist'] ?? '');
            $spotify = trim($_POST['spotify'] ?? '');
            $image = trim($_POST['image'] ?? 'image/default-album.jpg');
            $year = trim($_POST['year'] ?? '');
            $tempo = trim($_POST['tempo'] ?? '');
            
            // Validate input
            if (empty($title) || empty($artist)) {
                echo json_encode(['success' => false, 'message' => 'Missing song information']);
                exit;
            }
            
            // Check if song already exists in playlist (check by title and artist)
            $exists = false;
            foreach ($_SESSION['playlist'] as $song) {
                if ($song['title'] === $title && $song['artist'] === $artist) {
                    $exists = true;
                    break;
                }
            }
            
            if ($exists) {
                echo json_encode(['success' => false, 'message' => 'Song already in playlist']);
                exit;
            }
            
            // Build song data array with all available fields
            $songData = [
                'title' => $title,
                'artist' => $artist,
                'spotify' => $spotify,
                'image' => $image
            ];
            
            // Add optional fields if they exist and are not empty
            if (!empty($year)) {
                $songData['year'] = $year;
            }
            if (!empty($tempo)) {
                $songData['tempo'] = $tempo;
            }
            
            $_SESSION['playlist'][] = $songData;
            echo json_encode(['success' => true, 'message' => 'Song added to playlist']);
            break;
            
        case 'clear':
            $_SESSION['playlist'] = [];
            echo json_encode(['success' => true, 'message' => 'Playlist cleared']);
            break;
            
        case 'get':
            // Optional: Return playlist data (useful for debugging or AJAX)
            echo json_encode(['success' => true, 'playlist' => $_SESSION['playlist']]);
            break;
            
        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
            break;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>