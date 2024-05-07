<?php

include('includes/config.php');
if (isset($_POST['add'])) {
    $heading = $_POST['heading'];

    $sql = "INSERT INTO event_card (heading) VALUES (?)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$heading]);

    $content_id = $dbh->lastInsertId();

    $countfiles = count($_FILES['image']['name']);
    for ($i = 0; $i < $countfiles; $i++) {
        $imageFileName = $_FILES['image']['name'][$i];
        $imageTmpName = $_FILES['image']['tmp_name'][$i];
        $newFilePath = "img/" . $imageFileName;


        if (move_uploaded_file($imageTmpName, $newFilePath)) {
            $sql = "INSERT INTO event_card_images (content_id, image) VALUES (?, ?)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([$content_id, $newFilePath]);
        } else {

            echo "File upload failed for $imageFileName. Please try again.";
        }
    }
    $message = "New record(s) created successfully";
    header("Location: manage_event.php");
    exit();
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Event Card</title>
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
            <label>Image:</label>
            <input type="file" name="image[]" multiple required><br><br>
            <label>Heading:</label>
            <input type="text" name="heading" required><br><br>
            <input type="submit" name="add" value="Add">
        </form>
    </div>
</body>

</html>