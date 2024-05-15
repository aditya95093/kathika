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

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM heart where id=?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);

    $message = "Record Deleted successfully";
}

$sql = "SELECT * FROM heart";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Heart Details</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        td a.edit-btn {
            display: inline-block;
            background-color: #4CAF50;
            color: #fff;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            margin: 5px;
        }

        td a.edit-btn:hover {
            background-color: #45a049;
        }

        td a.delete-btn {
            display: inline-block;
            background-color: #f44336;
            color: #fff;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
        }

        td a.delete-btn:hover {
            background-color: #d32f2f;
        }

        @media screen and (max-width: 600px) {
            table {
                border-collapse: collapse;
                width: 100%;
            }

            table,
            th,
            td {
                border: 1px solid #ddd;
            }

            th,
            td {
                text-align: left;
                padding: 8px;
            }


            thead {
                display: none;
            }

            tr {
                border-bottom: 1px solid #ddd;
                display: block;
                margin-bottom: 10px;
            }

            td {
                border: none;
                display: flex;
                flex-direction: column;
            }

            td::before {
                content: attr(data-label);
                font-weight: bold;
                text-transform: uppercase;
                margin-bottom: 5px;
            }

            td:last-child {
                border-bottom: none;
            }
        }
    </style>
</head>

<body>
    <form method="post" enctype="multipart/form-data">
    <a href="dashboard.php" class="btn btn-primary">Back to Dashboard</a>
        <h2>Heart Table</h2>
        <table border="1">
            <tr>
                <th>Id</th>
                <th>Heading</th>
                <th>Image</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            <?php foreach ($records as $record): ?>
                <tr>
                    <td>
                        <?php echo $record['id']; ?>
                    </td>
                    <td>
                        <?php echo $record['heading']; ?>
                    </td>
                    <td>
                        <img src="<?php echo $record['image']; ?>" alt="image" width="100px" style="max-width: 100px;">
                    </td>
                    

                    <td>
                        <?php echo $record['description']; ?>
                    </td>
                    <td>
                        <a href="edit_heart.php?id=<?php echo $record['id']; ?>" class="edit-btn">Edit</a>
                        <a href="?delete=<?php echo $record['id']; ?>"
                            onclick="return confirm('Are you sure you want to delete this record?')"
                            class="delete-btn">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        
    </form>
</body>

</html>