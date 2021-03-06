<?php
require_once "../func/func.php";
if (checkUserLogin() == false) {
    header("Location:./login.php");
}
$dataList = getGroupList();
$applyList = getGroupApplyList();
require_once "../common/header.php";
?>

<!-- This file is completed by saebom SHIN-40054234 individually -->

<!-- all required js files here -->
<script src="../static/functions.js"></script>

<div class="wrapper">

    <!-- navbar here -->
    <?php require_once "nav.php";?>

    <!-- the main table of this page -->
    <section class="content">
        <div class="container-fluid">
            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Group List</h3>
                        </div>
                        <div class="card-body">
                            <div style="margin-bottom: 10px">
                                <button class="btn btn-primary btn-sm" onclick="addGroup()">Add</button>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>name</th>
                                    <th>descrption</th>
                                    <th>create time</th>
                                    <th>update time</th>
                                    <th>option</th>
                                </tr>
                                </thead>
                                <tbody id="group-list">
                                <?php foreach ($dataList as $item) { ?>
                                    <tr>
                                        <td><?php echo $item['id'] ?></td>
                                        <td><?php echo $item['group_name'] ?></td>
                                        <td><?php echo $item['description'] ?></td>
                                        <td><?php echo $item['create_time'] ?></td>
                                        <td><?php echo $item['last_update_time'] ?></td>
                                        <td data-id="<?php echo $item['id'] ?>" data-info="<?php echo rawurlencode(json_encode($item)) ?>">
                                            <button class="btn btn-danger btn-sm" onclick="delGroup($(this))">del</button>
                                            <button class="btn btn-warning btn-sm" onclick="editGroup($(this))">edit</button>
                                            <button class="btn btn-primary btn-sm" onclick="detailGroupMember(<?php echo $item['id'] ?>)">detail</button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer" style="display: none;">
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Group Apply</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>group name</th>
                                    <th>member name</th>
                                    <th>create time</th>
                                    <th>handle time</th>
                                    <th>option</th>
                                </tr>
                                </thead>
                                <tbody id="group-list">
                                <?php foreach ($applyList as $item) { ?>
                                    <tr>
                                        <td><?php echo $item['id'] ?></td>
                                        <td><?php echo $item['group_name'] ?></td>
                                        <td><?php echo $item['member_name'] ?></td>
                                        <td><?php echo $item['create_time'] ?></td>
                                        <td><?php echo $item['handle_time'] ?></td>
                                        <td data-id="<?php echo $item['id'] ?>" data-info="<?php echo rawurlencode(json_encode($item)) ?>">
                                            <?php
                                            if ($item['status'] == '') {
                                                ?>
                                                <button class="btn btn-danger btn-sm"  onclick="handleApply($(this),'agree')">agree</button>
                                                <button class="btn btn-warning btn-sm" onclick="handleApply($(this),'disagree')">disagree</button>
                                                <?php
                                            } ?>
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

<!-- popup fprm for adding a group -->
<div class="modal fade" id="modal-add-group">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title" style="font-weight: bold;font-size: 1.2rem">Add Group
                    <p style="font-size: 1rem;font-weight: normal" id="route-title"></p>
                </span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body" style="margin: 20px">
                <div class="form-group row">
                    <label for="">Group Name</label>
                    <input type="text" class="form-control" id="name">
                    <label for="">Group Description</label>
                    <input type="text" class="form-control" id="desc">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="submitGroup()">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- popup form for editing a group -->
<div class="modal fade" id="modal-edit-group">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title" style="font-weight: bold;font-size: 1.2rem">Edit Condo
                    <p style="font-size: 1rem;font-weight: normal" id="route-title"></p>
                </span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">�</span></button>
            </div>
            <div class="modal-body" style="margin: 20px">
                <div class="modal-body" style="margin: 20px">
                    <div class="form-group row">
                        <input type="hidden" id="id_edit">
                        <label for="">Group Name</label>
                        <input type="text" class="form-control" id="name_edit">
                        <label for="">Group Description</label>
                        <input type="text" class="form-control" id="desc_edit">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="submitGroupEdit()">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- popup form for displaying the member list of a group -->
<div class="modal fade" id="modal-GroupMember">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title" style="font-weight: bold;font-size: 1.2rem">Detail
                    <p style="font-size: 1rem;font-weight: normal" id="route-title"></p>
                </span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body" style="margin: 20px">
                <div class="form-group row">
                    <table class="table table-hover" id="GroupMember-contanier">

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once "../common/footer.php";?>
