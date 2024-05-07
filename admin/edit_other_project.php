<?php

include('includes/config.php');


if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM other_project WHERE id=?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    exit("No record ID specified.");
}


if(isset($_POST['update'])){
    $id = $_POST['id'];
    $heading = $_POST['heading'];
    $description = $_POST['description'];

    
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
        $imageFileName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $newFilePath = "img/"  . $imageFileName;

        
        if(move_uploaded_file($imageTmpName, $newFilePath)){
            
            $sql = "UPDATE other_project SET heading=?, image=?, description=? WHERE id=?";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([$heading, $newFilePath, $description, $id]);
        } else {
            exit("File upload failed");
        }
    } else {
        
        $sql = "UPDATE other_project SET heading=?, description=? WHERE id=?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$heading, $description, $id]);
    }

    
    $rowCount = $stmt->rowCount();
    if($rowCount > 0){
        $message = "Record updated successfully";
    } else {
        $message = "Failed to update record";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Other Project</title>
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
        <h2>Edit Content</h2>
        <?php if(isset($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $record['id']; ?>">
            <label>Heading:</label>
            <input type="text" name="heading" value="<?php echo $record['heading']; ?>" required><br><br>
            <label>Image:</label>
            <input type="file" name="image"><br><br>
            <label>Description:</label><br>
            <textarea name="description" rows="4" cols="50" required><?php echo $record['description']; ?></textarea><br><br>
            <input type="submit" name="update" value="Update">
            <a href="manage_other_project.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
