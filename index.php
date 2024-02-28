
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>List Of Emploees</h2>
        <a class="btn btn-primary" href="/myShope/create.php" role="button">
            Add Employee
        </a>
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Created at</th>
                </tr>
            </thead>
            <tbody>
            <?php
                require 'connect.php';
                $sql = 'SELECT * FROM employees';
                $stmt = $con->prepare($sql);
                $stmt->execute();
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($results as $row) {
                    echo "
                    <tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['address']}</td>
                        <td>{$row['created_at']}</td>
                        <td>
                            <a class='btn btn-primary' href='/myShope/edit.php?id={$row['id']}' role='button'>Edit</a>
                            <a class='btn btn-danger' href='/myShope/delete.php?id={$row['id']}' role='button'>Delete</a>
                        </td>
                    </tr>";
                }                

            ?>
            </tbody>
        </table>
    </div>
</body>
</html>