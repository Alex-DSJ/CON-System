<!-- This file is completed by shijun DENG-40084956 individually -->

<!-- all required js files here -->
<script src="../static/functions.js"></script>

<!-- all required php files here -->
<?php require_once "../common/header.php";
require_once "../func/building_func.php";
require_once "../func/func.php";

if (checkUserLogin() == false || getLogin()['uid'] !== ADMIN_ID) {
    header("Location:/admin/login.php");
}
$dataList = getBuildingList();
?>


<div class="wrapper">

<?php require_once "navbar.php";?>

    <!-- main table of the building tab -->
    <section class="content">
        <div class="container-fluid">
            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Building List</h3>
                        </div>
                        <div class="card-body">
                            <div style="margin-bottom: 10px">
                                <button class="btn btn-primary btn-sm" onclick="addBuilding()">Add</button>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>building name</th>
                                    <th>description</th>
                                    <th>area</th>
                                    <th>address</th>
                                    <th>create time</th>
                                    <th>option</th>
                                </tr>
                                </thead>
                                <tbody id="group-list">
                                <?php foreach ($dataList as $item) {
                                    ?>
                                    <tr>
                                        <td><?php echo $item['id'] ?></td>
                                        <td><?php echo $item['building_name'] ?></td>
                                        <td><?php echo $item['description'] ?></td>
                                        <td><?php echo $item['area'] ?></td>
                                        <td><?php echo $item['address'] ?></td>
                                        <td><?php echo $item['create_time'] ?></td>
                                        <td data-id="<?php echo $item['id'] ?>" data-info="<?php echo rawurlencode(json_encode($item)) ?>">
                                            <button class="btn btn-danger btn-sm" onclick="delBuilding($(this))">del</button>
                                            <button class="btn btn-warning btn-sm"  onclick="editBuilding($(this))">edit</button>
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

<!-- the popup form for add button -->
<div class="modal fade" id="modal-add-building">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title" style="font-weight: bold;font-size: 1.2rem">Add Building
                    <p style="font-size: 1rem;font-weight: normal" id="route-title"></p>
                </span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body" style="margin: 20px">
                <div class="form-group row">
                    <label for="">Building Name</label>
                    <input type="text" class="form-control" id="name">
                    <label for="">Description</label>
                    <input type="text" class="form-control" id="desc">
                    <label for="">Address</label>
                    <input type="text" class="form-control" id="address">
                    <label for="">Area</label>
                    <input type="number" class="form-control" id="area">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="submitBuilding()">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- the popup form for edit button -->
<div class="modal fade" id="modal-edit-building">
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
                    <label for="">Building Name</label>
                    <input type="text" class="form-control" id="name_edit">
                    <label for="">Description</label>
                    <input type="text" class="form-control" id="desc_edit">
                    <label for="">Address</label>
                    <input type="text" class="form-control" id="address_edit">
                    <label for="">Area</label>
                    <input type="number" class="form-control" id="area_edit">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="submitBuildingEdit()">Save</button>
            </div>
        </div>
    </div>
</div>

<?php require_once "../common/footer.php";?>
