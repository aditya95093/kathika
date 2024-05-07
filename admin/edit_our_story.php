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

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $heading = $_POST['heading'];
    $imageUrls = $_POST['image'];
    $description = $_POST['description'];

    $sql = "UPDATE our_story SET heading=?, image=?, description=? WHERE id=?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$heading, $imageUrls, $description, $id]);

    $message = "Record updated successfully";
    header('location:manage_our_story.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM our_story WHERE id=?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        exit("Record not found");
    }

    $heading = $result['heading'];
    $imageUrls = $result['image'];
    $description = $result['description'];
} else {
    exit("Invalid request");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Our Story</title>
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
        
        
        .container button[type="button"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-bottom: 10px;
            
        }

        .container button[type="button"]:hover {
            background-color: #0056b3;
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
         function addImageInput() {
            var input = document.createElement('input');
            input.type = 'text';
            input.name = 'image[]';
            input.required = true;
            var container = document.querySelector('.container');
            container.appendChild(input);
            var br = document.createElement('br');
            container.appendChild(br);
            var removeButton = document.createElement('button');
            removeButton.textContent = 'Remove Image';
            removeButton.type = 'button';
            removeButton.onclick = function () {
                container.removeChild(input);
                container.removeChild(br);
                container.removeChild(removeButton);
            };
            container.appendChild(removeButton);
        }
    </script>
</head>

<body>
    <div class="container">
        <h2>Our Story</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label>Image:</label>
            <input type="text" name="image" value="<?php echo $imageUrls; ?>" required><br><br>
            <button type="button" onclick="addImageInput()">Add More Images</button><br><br>
            <label>Heading:</label>
            <input type="text" name="heading" value="<?php echo $heading; ?>" required><br><br>
            <label>Description:</label><br>
            <textarea name="description" rows="4" cols="50"><?php echo $description; ?></textarea><br><br>
            <input type="submit" name="edit" value="Save Changes">
            <a href="manage_kathika_museum_haveli.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>