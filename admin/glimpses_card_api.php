<?php

header('Content-Type: application/json');

include ('includes/config.php');

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        
        $sql = "SELECT * FROM glimpses_card";
        $stmt = $dbh->query($sql);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data as &$record) {
            $content_id = $record['id'];
            $sql_images = "SELECT image FROM images_glimpses_card WHERE content_id = ?";
            $stmt_images = $dbh->prepare($sql_images);
            $stmt_images->execute([$content_id]);
            $images = $stmt_images->fetchAll(PDO::FETCH_COLUMN);
            $record['images'] = $images;
        }

    
        $response['success'] = true;
        $response['data'] = $data;
    } catch (PDOException $e) {
        
        $response['success'] = false;
        $response['message'] = "Database error: " . $e->getMessage();
    }
} else {
    $response['success'] = false;
    $response['message'] = "Method not allowed";
}

echo json_encode($response);
?>