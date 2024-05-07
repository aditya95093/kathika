<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'Kathika');

try {
    $dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}

if($dbh){
    $sql = "SELECT * FROM heart";
    $stmt = $dbh->query($sql);
    if($stmt){
        $response = array();
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            $response[] = $row;
        }
        header("Content-Type: application/json");
        echo json_encode($response, JSON_PRETTY_PRINT);
    
    }else{
        echo "Database Query Failed";
    }
}else{
    echo "Database Connection failed";
}
?>