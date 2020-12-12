<?php
require_once "../func/func.php";

if (checkUserLogin() == false) {
    header("Location:/owner/login.php");
}
$dataList = getCondoList();
$buildingInfo = getBuildingInfo();
 require_once "../common/header.php";
?>

<!-- This file is completed by saebom SHIN-40054234 individually -->

<!-- all required js files here -->
<script src="../static/functions.js"></script>

<div class="wrapper">

    <!-- navbar -->
    <?php require_once "nav.php";?>

    <!-- main table of the condo tab -->
    <section class="content">
        <div class="container-fluid">
            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Building Info</h3>
                            <div style="margin-bottom: 10px">
                                <button class="btn btn-primary btn-sm" onclick="addCondo()">Add</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>Name: <strong><?php echo $buildingInfo['building_name'] ?></strong> </p>
                            <p>Description: <strong><?php echo $buildingInfo['description'] ?></strong></p>
                            <p>Address: <strong><?php echo $buildingInfo['address'] ?></strong> </p>
                            <p>Area: <strong><?php echo $buildingInfo['area'] ?></strong> </p>
                            <p>CreateTime: <strong><?php echo $buildingInfo['create_time'] ?></strong> </p>
                        </div>
                        <div class="card-footer" style="display: none;">
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Condo List</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Area</th>
                                    <th>Cost</th>
                                    <th>Building Name</th>
                                    <th>Create Time</th>
                                    <th>Update Time</th>
                                    <th>Option</th>
                                </tr>
                                </thead>
                                <tbody id="group-list">
                                <?php foreach ($dataList as $item) { ?>
                                    <tr>
                                        <td><?php echo $item['id'] ?></td>
                                        <td><?php echo $item['name'] ?></td>
                                        <td><?php echo $item['area'] ?></td>
                                        <td><?php echo $item['cost'] ?></td>
                                        <td><?php echo $item['building_name'] ?></td>
                                        <td><?php echo $item['create_time'] ?></td>
                                        <td><?php echo $item['last_update_time'] ?></td>
                                        <td data-id="<?php echo $item['id'] ?>" data-info="<?php echo rawurlencode(json_encode($item)) ?>">
                                            <button class="btn btn-danger btn-sm" onclick="delCondo($(this))">Del</button>
                                            <button class="btn btn-warning btn-sm" onclick="editCondo($(this))">Edit</button>
                                        </td>
                                    </tr>
                                <?php } ?>
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

<!-- popup from for adding a condo -->
<div class="modal fade" id="modal-add-condo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title" style="font-weight: bold;font-size: 1.2rem">Add Condo
                    <p style="font-size: 1rem;font-weight: normal" id="route-title"><?php echo $buildingInfo['building_name'] ?></strong></p>
                </span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body" style="margin: 20px">
                <div class="form-group row">
                    <label for="">Condo Name</label>
                    <input type="text" class="form-control" id="name">
                    <label for="">Condo Area/&#13217;</label>
                    <input type="number" class="form-control" id="area">
                    <label for="">Property Costs/&#13217;</label>
                    <input type="number" class="form-control" id="cost">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="submitCondo()">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- popup form for editing a condo -->
<div class="modal fade" id="modal-edit-condo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title" style="font-weight: bold;font-size: 1.2rem">Edit Condo
                    <p style="font-size: 1rem;font-weight: normal" id="route-title"><?php echo $buildingInfo['building_name'] ?></p>
                </span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body" style="margin: 20px">
                <div class="modal-body" style="margin: 20px">
                    <div class="form-group row">
                        <input type="hidden" id="id_edit">
                        <label for="">Condo Name</label>
                        <input type="text" class="form-control" id="name_edit">
                        <label for="">Condo Area/&#13217;</label>
                        <input type="number" class="form-control" id="area_edit">
                        <label for="">Property Costs/&#13217;</label>
                        <input type="number" class="form-control" id="cost_edit">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="submitCondoEdit()">Save</button>
            </div>
        </div>
    </div>
</div>

<?php require_once "../common/footer.php";?>