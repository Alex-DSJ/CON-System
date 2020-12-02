<!-- This file is completed by shijun DENG-40084956 individually -->

<!-- all required php files here -->
<?php 
require_once "../common/header.php";
require_once "../func/func.php";
?>

<!-- all required js file here -->
<script src="../static/functions.js"></script>

<?php
if (checkUserLogin() == false || getLogin()['uid'] !== ADMIN_ID) {
    header("Location:login.php");
}
$dataList = getAdminList();
$building = getBuildingList();
$buildingStr = '<option value="">please select</option>';
foreach ($building as $item) {
    $buildingStr .= "<option value='{$item['id']}'>{$item['building_name']}</option>";
}
?>

<div class="wrapper">

    <?php require_once "navbar.php";?>

    <!-- the main table of the admin tab -->
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
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Building Name</th>
                                    <th>Create Time</th>
                                    <th>Update Time</th>
                                    <th>Option</th>
                                </tr>
                                </thead>
                                <tbody id="group-list">
                                <?php foreach ($dataList as $item) {
                                    ?>
                                    <tr>
                                        <td><?php echo $item['id'] ?></td>
                                        <td><?php echo $item['name'] ?></td>
                                        <td><?php echo $item['building_name'] ?></td>
                                        <td><?php echo $item['create_time'] ?></td>
                                        <td><?php echo $item['last_update_time'] ?></td>
                                        <td data-id="<?php echo $item['id'] ?>" data-name="<?php echo $item['name'] ?>" data-building="<?php echo $item['building_id'] ?>" data-pass="<?php echo $item['password'] ?>">
                                            <button class="btn btn-danger btn-sm" onclick="delAdmin($(this))">del</button>
                                            <button class="btn btn-warning btn-sm" onclick="editAdmin($(this))">edit</button>
                                        </td>
                                    </tr>
                                <?php
                                } ?>
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
</div>

<!-- the popup form for adding an admin -->
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
                        <?php echo $buildingStr; ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="submitAdmin()">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- the popup form for edit button -->
<div class="modal fade" id="modal-edit-admin">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title" style="font-weight: bold;font-size: 1.2rem">Edit Admin
                    <p style="font-size: 1rem;font-weight: normal" id="route-title"></p>
                </span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body" style="margin: 20px">
                <div class="form-group row">
                    <input type="hidden" id="id_edit">
                    <label for="">Admin User Name</label>
                    <input type="text" class="form-control" id="admin_name_edit">
                    <label for="">Admin Password</label>
                    <input type="password" class="form-control" id="admin_password_edit">
                    <label for="">Admin Building</label>
                    <select name="" id="admin_building_edit" class="form-control">
                        <?php echo $buildingStr; ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="submitAdminEdit()">Save</button>
            </div>
        </div>
    </div>
</div>

<?php require_once "../common/footer.php";?>
