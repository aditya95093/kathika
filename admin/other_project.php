<?php

include('includes/config.php');

if (isset($_POST['add'])) {
    $heading = $_POST['heading'];
    $description = $_POST['description'];
    $imageFileName = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    $newFilePath = "img/" . $imageFileName;

    if (move_uploaded_file($imageTmpName, $newFilePath)) {
        $sql = "INSERT INTO other_project (heading, image_path, description) VALUES(?,?,?)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$heading, $newFilePath, $description]);
        $message = "New Record created successfully";
        header('location: manage_other_project.php');
        exit();
    } else {
        echo "File Upload failed";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Other Project</title>
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
    <script>
        function showAlert(message) {
            alert(message);
        }
    </script>
</head>

<body>
    <div class="container">
        <h2>Add New Content</h2>
        <form method="post" enctype="multipart/form-data">
            <label>Heading:</label>
            <input type="text" name="heading" required><br><br>
            <label>Image:</label>
            <input type="file" name="image" required><br><br>
            <label>Description:</label><br>
            <textarea name="description" rows="4" cols="50"></textarea><br><br>
            <input type="submit" name="add" value="Add">
        </form>
    </div>
</body>

</html>