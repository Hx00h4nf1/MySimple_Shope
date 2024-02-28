<?php
require 'connect.php';
$name = "";
$phone = "";
$email = "";
$address = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    do {
        if (empty($name) || empty($phone) || empty($email) || empty($address)) {
            $errorMessage = "All fields are required";
            break;
        }

        $sql = "INSERT INTO employees (name, phone, email, address) VALUES ('$name', '$phone', '$email', '$address')";
        $result = $con->prepare($sql);
        $result->execute();
 
        if ($result) {
            $successMessage = "Employee added successfully";
        } else {
            $errorMessage = "Employee not added";
            header("Location: /myShope/index.php");
            exit;
        }

        $name = "";
        $phone = "";
        $email = "";
        $address = "";

        $successMessage = "Emploee added successfully";

    }while (false);
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