<?php
include ('includes/config.php');

if ($dbh) {
    $sql = "SELECT * FROM neem_haveli";
    $stmt = $dbh->prepare($sql);
    if ($stmt) {
        if ($stmt->execute()) {
            $response = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $response = $row;
            }
            header("Content-type: application/json");
            echo json_encode($response, JSON_PRETTY_PRINT);
        } else {
            echo "Failed to execute the query";
        }
    } else {
        echo "Database Query Preparation Failed";
    }
} else {
    echo "Database Connection Failed";
}

?>