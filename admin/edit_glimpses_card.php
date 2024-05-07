<?php

include('includes/config.php');

$message = ''; 

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $heading = $_POST['heading'];
   

    if ($_FILES['image']['size'] > 0) {
        $imageFileName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $newFilePath = "uploads/" . $imageFileName;

       
        if (move_uploaded_file($imageTmpName, $newFilePath)) {
           
            $sql = "UPDATE glimpses SET image=?, heading=? WHERE id=?";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([$newFilePath, $heading,  $id]);
        } else {
            
            $message = "File upload failed.";
        }
    } else {
        
        $sql = "UPDATE glimpses SET heading=?  WHERE id=?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$heading,  $id]);
    }

    
    header("Location: manage_glimpses_card.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $sql = "SELECT * FROM glimpses_card WHERE id=?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Record</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }

        input[type="text"],
        textarea,
        select,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        textarea {
            height: 100px;
        }

        select {
            height: 40px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        @media (max-width: 768px) {

            input[type="text"],
            textarea,
            select {
                font-size: 14px;
            }

            input[type="submit"] {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Edit Record</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($record['id']); ?>">
            <label>Image:</label>
            <input type="file" name="image"><br><br>
            <label>Heading:</label>
            <input type="text" name="heading" value="<?php echo htmlspecialchars($record['heading']); ?>"
                required><br><br>
            <input type="submit" name="update" value="Update">
            <a href="manage_glimpses_card.php" class="btn btn-secondary">Cancel</a>
        </form>
        <p>
            <?php echo $message; ?>
        </p>
        </form>
    </div>
</body>

</html>