<!-- This file is completed by shijun DENG-40084956, refer from .owner/member.php -->

<!-- required php files and necessary data generation here -->
<?php
require_once "../common/header.php";
require_once "../func/func.php";
if (checkUserLogin() == false) {
    header("Location:/owner/login.php");
}
$condoList = getAllCondos();
$building = getBuildingList();
$buildingStr = '<option value="">please select</option>';
foreach ($building as $item) {
    $buildingStr .= "<option value='{$item['id']}'>{$item['building_name']}</option>";
}
?>

<!-- required script and external resource here -->
<script src="../static/functions.js"></script>

<!-- page starts here -->
<div class="wrapper">

    <!-- navbar here -->
    <?php require_once "navbar.php"; ?>

    <section class="content">
        <div class="container-fluid">

            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Condo List</h3>
                        </div>
                        <div class="card-body">
                            <div style="margin-bottom: 10px">
                                <button class="btn btn-primary btn-sm" onclick="addCondo()">Add</button>
                            </div>
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
                                <?php foreach ($condoList as $condo) {
                                    ?>
                                    <tr>
                                        <td><?php echo $condo['id'] ?></td>
                                        <td><?php echo $condo['name'] ?></td>
                                        <td><?php echo $condo['area'] ?></td>
                                        <td><?php echo $condo['cost'] ?></td>
                                        <td><?php echo $condo['building_name'] ?></td>
                                        <td><?php echo $condo['create_time'] ?></td>
                                        <td><?php echo $condo['last_update_time'] ?></td>
                                        <td data-id="<?php echo $condo['id'] ?>" data-info="<?php echo rawurlencode(json_encode($condo)) ?>">
                                            <button class="btn btn-danger btn-sm" onclick="delCondo($(this))">Del</button>
                                            <button class="btn btn-warning btn-sm" onclick="editCondo($(this))">Edit</button>
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

<!-- popup form for adding a condo -->
<div class="modal fade" id="modal-add-condo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title" style="font-weight: bold;font-size: 1.2rem">Add Condo
                    <p style="font-size: 1rem;font-weight: normal" id="route-title"></p>
                </span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body" style="margin: 20px">
                <div class="form-group row">
                    <label for="">Select a Building</label>
                    <select name="" id="building" class="form-control">
                        <?php echo $buildingStr; ?>
                    </select>
                    <label for="">Condo Name</label>
                    <input type="text" class="form-control" id="name">
                    <label for="">Condo Area/m²</label>
                    <input type="number" class="form-control" id="area">
                    <label for="">Property Costs/m²</label>
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
                    <p style="font-size: 1rem;font-weight: normal" id="route-title"></p>
                </span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body" style="margin: 20px">
                <div class="modal-body" style="margin: 20px">
                    <div class="form-group row">
                        <input type="hidden" id="id_edit">
                        <label for="">Select a Building</label>
                        <select name="" id="building_edit" class="form-control">
                            <?php echo $buildingStr; ?>
                        </select>
                        <label for="">Condo Name</label>
                        <input type="text" class="form-control" id="name_edit">
                        <label for="">Condo Area/m²</label>
                        <input type="number" class="form-control" id="area_edit">
                        <label for="">Property Costs/m²</label>
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
