<?php
include 'connection.php';

$query = 'SELECT * FROM tbl_product';
$stmt = $dbc->query($query);

if (isset($_POST["action"])) {
    $output = '
    <thead>
        <tr>
            <td><center>Name</center></td>
            <td><center>Description</center></td>
            <td><center>Image</center>
            <td><center>Action</center></td>
        </tr>
    </thead>';
    while ($row = $stmt->fetch()) {
        $output .= '
        <tr>
            <td>'.$row["name"].'</td>
            <td>'.$row["description"].'</td>
            <td>
                <center>
                    <img src="data:image/jpeg;base64,'.base64_encode($row["image"]).'" alt="image" height="60">
                </center>
            </td>
            <td>
                <center>
                    <button type="button" class="btn btn-xs btn-success update_this" id="'.$row["id"].'">Update</button>
                    <button type="button" class="btn btn-xs btn-danger delete_this" id="'.$row["id"].'">Delete</button>
                </center>
            </td>
        </tr>';
    }

    echo $output;
}
?>