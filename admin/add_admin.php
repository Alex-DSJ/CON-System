<?php
//get building list from the DB for the select
require_once "../func/building_func.php";

$buildings = getBuildingList();
$buildingStr = '<option value="">please select</option>';

foreach ($buildings as $building) {
    $buildingStr .= "<option value='{$building['id']}'>{$building['building_name']}</option>";
}
?>


<!-- This is the pop-up form for adding association admin -->
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
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>