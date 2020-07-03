<?php
include 'connection.php';

if (isset($_FILES['new_prod_img']['name'])) {
    $data = '';

    $id = $_POST['new_id'];
    $product_name = $_POST['new_prod_name'];
    $product_description = $_POST['new_prod_desc'];
    
    $file = file_get_contents($_FILES['new_prod_img']['tmp_name']);

    $query = "UPDATE tbl_product SET name = ?, description = ?, image = ? WHERE id = ?";

    try {
        if ($dbc->prepare($query)->execute([$product_name, $product_description, $file, $id])) {
            $data = true;
        }
    } catch (PDOException $ex) {
        $data = $ex->getMessage();
    }
} else {
    $id = $_POST['new_id'];
    $product_name = $_POST['new_prod_name'];
    $product_description = $_POST['new_prod_desc'];

    $query = "UPDATE tbl_product SET name = ?, description = ? WHERE id = ?";

    try {
        if ($dbc->prepare($query)->execute([$product_name, $product_description, $id])) {
            $data = true;
        }
    } catch (PDOException $ex) {
        $data = $ex->getMessage();
    }
}
?>