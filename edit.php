<?php
require 'connect.php';
$id = "";
$name = "";
$phone = "";
$email = "";
$address = "";

$successMessage = "";
$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['id'])) {
        header("location: /myShope/index.php");
        exit;
    }
    $id = $_GET['id'];
    $sql = "SELECT * FROM employees WHERE id = $id";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC); 
    if (!$row) {
        header("location: /myShope/index.php");
        exit;
    }
    $name = $row['name'];
    $phone = $row['phone'];
    $email = $row['email'];
    $address = $row['address'];
}
else
{
    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    do {
        if(empty($id) || empty($name) || empty($phone) || empty($email) || empty($address)){
            $errorMessage = "All fields are required";
            break;
        }

        $sql = "UPDATE employees SET name = '$name' , phone = '$phone' , email = '$email' WHERE id = '$id'";
        $stmt = $con->prepare($sql);
        $stmt->execute();

        if ($stmt) {
            $successMessage = "Employee updated successfully";
        } else {
            $errorMessage = "Employee not updated";
            header("Location: /myShope/index.php");
            exit;
        }
    } while(false);

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>New Client</h2>
        <?php
        if(!empty($errorMessage))
        {
            echo "
            <div class='alert alert-danger' role='alert'>
                <strong>{$errorMessage}</strong>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
        <form method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" value="<?php echo $email ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address ?>">
                </div>
            </div>
            <?php
        if(!empty($successMessage))
        {
            echo "
            <div class='alert alert-success alert-dismiss fade show' role='alert'>
                <strong>{$successMessage}</strong>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/myShope/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
