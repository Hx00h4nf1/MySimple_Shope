<?php
require 'connect.php';
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM employees WHERE id =$id";
    $result = $con->prepare($sql);
    $result->execute();
}
    header("Location: /myShope/index.php");
    exit;
?>