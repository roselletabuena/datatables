$(document).ready(function(){
    // tinawag ko yung function na display_data para mag-take effect siya kapag nagload na yung page
    display_data();

    // ito yung function na magdi-display sa table yung mga data from database
    function display_data() {

        // basehan ko tong variable na to para sa condition ko sa display.php
        var action = "fetch";

        $.ajax({
            // ito yung location kung saan niya ibabato yung mga data
            url: "php/display.php",
            method: "POST",
            // ito yung data na ibabato sa another php file which is action = "fetch"
            data: { action : action },
            // itong function na to, magte-take effect siya after matapos yung process dun sa location ng ibabato nating data
            success: function(data) {
                // kung ano man yung na-return na value from target location natin, yun yung ilalagay niya sa table element natin na may id na product_data
                $("#product_data").html(data);
                // itong .DataTable() function na to, gagawin na niyang DataTable yung table natin
                $("#product_data").DataTable();
            }
        });
    }

    $('#add_form').submit(function(event) {
        event.preventDefault();

        var name = $("#prod_name").val();
        var description = $("#prod_desc").val();
        var image = $("#prod_img").val();
        var action = "insert_user";
        if (name != "" && description != "" && image != "") {
            var extension = $("#prod_img").val().split('.').pop().toLowerCase();
            if (jQuery.inArray(extension, ["gif","png","jpg","jpeg"]) == -1) {
                alert("Invalid Image File");
            } else {
                $.ajax({
                    url: "php/insert.php",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function() {
                        $("#add_modal").modal("hide");
                        $("#product_data").DataTable().destroy();
                        display_data();
                        $("#add_form")[0].reset();
                    }
                });
            }
        }
    });

    $(document).on("click", ".update_this", function() {
        var product_id = $(this).attr("id");
        $.ajax({
            url:"php/update_form.php",
            method:"POST",
            data: { product_id : product_id },
            success:function(data){
                $("#update_modal").modal("show");
                $("#update_id").html(data);
            }
        });
    });

    $(document).on("click", ".delete_this", function() {
        var product_id = $(this).attr("id");
        $.ajax({
            url:"php/delete_confirmation.php",
            method:"POST",
            data: { product_id : product_id },
            success:function(data){
                $("#delete_modal").modal("show");
                $("#delete_id").html(data);
            }
        });
    });
});