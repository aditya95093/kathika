<?php
include('includes/config.php');

if ($dbh) {
    $categories = ['Home', 'About', 'Culture & Heritage', 'Experiences & Activities', 'Kathika Events & Collaborations', 'Our Team', 'Kathika Trust']; 
    $response = array();

    foreach ($categories as $category) {
        
        $sql_check = "SELECT COUNT(*) AS count FROM hero_content WHERE category = ?";
        $stmt_check = $dbh->prepare($sql_check); 
        $stmt_check->execute([$category]); 
        $row_check = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($row_check['count'] > 0) {
            
            $sql = "SELECT hc.*, hci.image 
            FROM hero_content hc
            LEFT JOIN hero_content_images hci ON hc.id = hci.content_id
            WHERE hc.category = ?";
            $stmt = $dbh->prepare($sql); 

            if ($stmt) {
                $stmt->execute([$category]); 

                
                if (!isset($response[$category])) {
                    $response[$category] = array();
                }

                
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $response[$category][] = $row; 
                }
            } else {
                echo "Database Query Failed";
            }
        }
    }

    header("Content-Type: application/json");
    echo json_encode($response, JSON_PRETTY_PRINT);
} else {
    echo "Database Connection Failed";
}
?>
