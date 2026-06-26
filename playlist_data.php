<?php
session_start();

// Initialize playlist if it doesn't exist
if (!isset($_SESSION['playlist'])) {
    $_SESSION['playlist'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];
    
    switch ($action) {
        case 'add':
            $title = $_POST['title'] ?? '';
            $artist = $_POST['artist'] ?? '';
            $spotify = $_POST['spotify'] ?? '';
            
            if (!empty($title) && !empty($artist)) {
                // Check if song already exists in playlist
                $exists = false;
                foreach ($_SESSION['playlist'] as $song) {
                    if ($song['title'] === $title && $song['artist'] === $artist) {
                        $exists = true;
                        break;
                    }
                }
                
                if (!$exists) {
                    $_SESSION['playlist'][] = [
                        'title' => $title,
                        'artist' => $artist,
                        'spotify' => $spotify
                    ];
                    echo json_encode(['success' => true, 'message' => 'Song added to playlist']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Song already in playlist']);
                }
            }
            break;
            
        case 'clear':
            $_SESSION['playlist'] = [];
            echo json_encode(['success' => true, 'message' => 'Playlist cleared']);
            break;
            
        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
            break;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>