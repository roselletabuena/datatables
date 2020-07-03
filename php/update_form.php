<?php
include 'connection.php';

if (isset($_POST["product_id"])) {
    $output = '';

    $query = 'SELECT * FROM tbl_product WHERE id = '.$_POST['product_id'].'';
    $stmt = $dbc->query($query);

    while ($row = $stmt->fetch()) {
        $output .= '
            <div class="modal-header">
                <h4>Update product</h4>
            </div>
            <form id="update_form" enctype="multipart/form-data">
                <div class="modal-body" id="update_id">
                    <input type="hidden" id="new_id" name="new_id" value="'.$row["id"].'">
                    <label for="new_prod_name">Product Name</label>
                    <input type="text" id="new_prod_name" name="new_prod_name" placeholder="Name" class="form-control" value="'.$row["name"].'">
                    <br>
                    <label for="new_prod_desc">Product Description</label>
                    <input type="text" id="new_prod_desc" name="new_prod_desc" placeholder="Description" class="form-control" value="'.$row["description"].'">
                    <br>
                    <label>Product Image</label>
                    <div>
                        <center>
                            <img id="my_img" class="img-thumbnail" src="data:image/jpeg;base64,'.base64_encode($row["image"]).'" alt="image" style="height: 100px;">
                        </center>
                    </div>
                    <br>
                    <label for="new_prod_img">Change Image</label>
                    <input type="file" id="new_prod_img" name="new_prod_img">
                </div>
                <div class="modal-footer">
                    <input type="submit" id="update" name="update" class="btn btn-sm btn-success" value="Save">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        ';

        $output .= '
            <script>
            $(document).ready(function(){
                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        
                        reader.onload = function (e) {
                            $("#my_img").attr("src", e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }

                $("#new_prod_img").change(function(){
                    readURL(this);
                });

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

                $("#update_form").submit(function(event) {
                    event.preventDefault();

                    var id = $("#new_id").val();
                    var name = $("#new_prod_name").val();
                    var description = $("#new_prod_desc").val();
                    var image = $("#new_prod_img").val();

                    // alert(id);

                    if (name != "" && description != "") {
                        if (image != "") {
                            var extension = $("#new_prod_img").val().split(".").pop().toLowerCase();
                            if (jQuery.inArray(extension, ["gif","png","jpg","jpeg"]) == -1) {
                                alert("Invalid Image File");
                            } else {
                                $.ajax({
                                    url: "php/update.php",
                                    method: "POST",
                                    data: new FormData(this),
                                    contentType: false,
                                    processData: false,
                                    success: function(data) {
                                        $("#update_modal").modal("hide");
                                        $("#product_data").DataTable().destroy();
                                        display_data();
                                    }
                                });
                            }
                        } else {
                            $.ajax({
                                url: "php/update.php",
                                method: "POST",
                                data: $("#update_form").serialize(),
                                success: function(data) {
                                    $("#update_modal").modal("hide");
                                    $("#product_data").DataTable().destroy();
                                    display_data();
                                }
                            });
                        }
                    }
                });
            });
            </script>
        ';
    }
    echo $output;
}
?>