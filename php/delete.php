<?php
include 'connection.php';

if(!empty($_POST)) {
    $id = $_POST["id"];
    $query = "DELETE FROM tbl_product WHERE id = ?";
    $dbc->prepare($query)->execute([$id]);
}
?>