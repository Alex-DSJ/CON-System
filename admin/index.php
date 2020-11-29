<!-- This file is completed by shijun DENG-40084956 individually -->
<!-- all required php files here -->
<?php
    require_once "../common/header.php";
    require_once "../func/building_func.php";
    require_once "../func/func.php";
?>

<!-- all required js file here -->
<script src="../static/auth.js"></script>
<script src="../static/admin.js"></script>

<!-- check if a user is logged in -->
<?php
if (checkUserLogin() == false || getLogin()['uid'] !== ADMIN_ID) {
    // header("Location:./login.php");
}

$buildings = getBuildingList();
$buildingStr = '<option value="">please select</option>';

foreach ($buildings as $building) {
    $buildingStr .= "<option value='{$building['id']}'>{$building['building_name']}</option>";
}

?>

<!-- html content here -->
<div class="wrapper">    
    <!-- HTML for the navbar start -->
    <?php require_once "navbar.php" ?>
    <!-- HTML for the navbar end -->

    <!-- main table of the page start here -->
    <section class="content">
        <div class="container-fluid">

            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Admin List</h3>
                        </div>
                        <div class="card-body">

                            <div style="margin-bottom: 10px">
                                <button class="btn btn-primary btn-sm" onclick="addAdmin()">Add</button>
                            </div>

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>name</th>
                                    <th>building Name</th>
                                    <th>create time</th>
                                    <th>update time</th>
                                    <th>option</th>
                                </tr>
                                </thead>
                                <tbody id="group-list">

                                <!-- TODO group list -->

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer" style="display: none;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- main table of the page end here -->

    <!-- popup form for add admin start -->
    <div class="modal fade" id="modal-add-admin">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title" style="font-weight: bold;font-size: 1.2rem">Add Admin
                        <p style="font-size: 1rem;font-weight: normal" id="route-title"></p>
                    </span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body" style="margin: 20px">
                    <div class="form-group row">
                        <label for="">Admin User Name</label>
                        <input type="text" class="form-control" id="admin_name">
                        <label for="">Admin Password</label>
                        <input type="password" class="form-control" id="admin_password">
                        <label for="">Admin Building</label>
                        <select name="" id="admin_building" class="form-control">
                        <!-- TODO getBuildingList and display all buildings in the DB -->
                            <?php echo $buildingStr; ?>
                        </select>
                    </div>
                </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="submitAdmin()">Save</button>
            </div>
        </div>
    </div>
    <!-- popup form for add admin end -->

    <!-- TODO buttons for edit and delete admin -->
</div>


    
</div>


<?php require_once "../common/footer.php";?>
