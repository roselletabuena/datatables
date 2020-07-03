<?php
include 'connection.php';

if (!empty($_POST)) {
    $data = '';

    $product_name = $_POST['prod_name'];
    $product_description = $_POST['prod_desc'];
    
    $file = file_get_contents($_FILES['prod_img']['tmp_name']);

    $query = "INSERT INTO tbl_product (name, description, image) VALUES (?, ?, ?)";

    try {
        if ($dbc->prepare($query)->execute([$product_name, $product_description, $file])) {
            $data = true;
        }
    } catch (PDOException $ex) {
        $data = $ex->getMessage();
    }
}

?>