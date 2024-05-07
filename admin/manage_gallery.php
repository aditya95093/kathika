<?php

include('includes/config.php');
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE  FROM gallery WHERE id=?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
    $message = "Record Delete successfully";
}

$sql = "SELECT * FROM gallery";
$stmt = $dbh->query($sql);
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Gallery Table</title>
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
        <h2>Gallery Table</h2>
        <table border="1">
            <tr>
                <th>Id</th>
                <th>Heading</th>
                <th>Image</th>
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
                        <a href="edit_gallery.php?id=<?php echo $record['id']; ?>" class="edit-btn">Edit</a>
                        <a href="?delete=<?php echo $record['id']; ?>"
                            onclick="return confirm('Are you sure you want to delete this record?')"
                            class="delete-btn">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="dashboard.php" class="btn btn-primary">Back to Dashboard</a>
    </form>
</body>

</html>