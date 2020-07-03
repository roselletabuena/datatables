<?php
include 'connection.php';

if (isset($_POST['product_id'])) {
    $output = '';

    $query = 'SELECT * FROM tbl_product WHERE id = '.$_POST['product_id'].'';
    $stmt = $dbc->query($query);

    while ($row = $stmt->fetch()) {
        $output .= '
            <form id="confirmation_dialog">
                <input type="hidden" name="id" id="id" value="'.$row['id'].'">
                <p>Are you sure you want to delete '.$row['name'].'?</p>
                <div style="text-align : right;">
                    <input type="submit" name="delete" id="delete" value="Confirm" class="btn btn-success">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>';

        $output .= '
            <script>
            $(document).ready(function(){
                function display_data() {
                    var action = "fetch";
                    $.ajax({
                        url: "php/display.php",
                        method: "POST",
                        data: { action : action },
                        success: function(data) {
                            $("#product_data").html(data);
                            $("#product_data").DataTable();
                        }
                    });
                }

                $("#confirmation_dialog").on("submit", function(event) {
                    event.preventDefault();
                    $.ajax({
                        url: "php/delete.php",
                        method: "POST",
                        data: $("#confirmation_dialog").serialize(),
                        success:function(data){
                            $("#delete_modal").modal("hide");
                            $("#product_data").DataTable().destroy();
                            display_data();
                            $("#confirmation_dialog")[0].reset();
                        }
                    });
                });
            });
            </script>
        ';
    }
    echo $output;
}
?>


