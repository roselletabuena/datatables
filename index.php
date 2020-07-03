<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="table-responsive">
            <h3><center>DataTables</center></h3>
            <br>
            <table id="product_data" class="table table-striped table-bordered">
                
            </table>
        </div>
        <div>
            <button type="button" id="btn_add" class="btn btn-sm btn-info" style="float: right;" data-toggle="modal" data-target="#add_modal">Add New</button>
        </div>
    </div>
</body>
</html>

<!-- ito yung modal ng pag-add -->
<div id="add_modal" class="modal fade" data-keyboard="false" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Add new product</h4>
            </div>
            <form id="add_form" enctype="multipart/form-data">
                <div class="modal-body">
                    <label for="prod_name">Product Name</label>
                    <input type="text" id="prod_name" name="prod_name" placeholder="Name" class="form-control">
                    <br>
                    <label for="prod_desc">Product Description</label>
                    <input type="text" id="prod_desc" name="prod_desc" placeholder="Description" class="form-control">
                    <br>
                    <label for="prod_img">Product Image</label>
                    <input type="file" id="prod_img" name="prod_img">
                </div>
                <div class="modal-footer">
                    <input type="submit" id="submit" name="submit" class="btn btn-sm btn-success" value="Add Product">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ito yung sa update modal -->
<div id="update_modal" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" id="update_id">
        </div>
    </div>
</div>

<!-- ito naman yung modal ng delete confirmation -->
<div id="delete_modal" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Confirmation</h4>
            </div>
            <div class="modal-body" id="delete_id">
                
            </div>
        </div>
    </div>
</div>

<!-- ito yung mga script file -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<script src="js/script.js"></script>