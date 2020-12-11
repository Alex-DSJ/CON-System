<?php
require_once "../func/func.php";
if (checkUserLogin() == false) {
    header("Location:/owner/login.php");
}
$dataList = getAllGroups();
$applyList = getAllGroupApplies();
?>
<!-- This file is completed by shijun DENG-40084956 refer to /owner/group.php -->

<!-- all required js files here -->
<script src="../static/functions.js"></script>
<!-- all required php files here -->
<?php require_once "../common/header.php"; ?>

<div class="wrapper">

    <!-- navbar here -->
    <?php require_once "navbar.php" ?>

    <!-- main table of the condo tab -->
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
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Descrption</th>
                                    <th>Create Time</th>
                                    <th>Members</th>
                                    <th>Option</th>
                                </tr>
                                </thead>
                                <tbody id="group-list">
                                <?php foreach ($dataList as $item) {
                                    ?>
                                    <tr>
                                        <td><?php echo $item['id'] ?></td>
                                        <td><?php echo $item['group_name'] ?></td>
                                        <td><?php echo $item['description'] ?></td>
                                        <td><?php echo $item['create_time'] ?></td>
                                        <td>
                                            <button class="btn btn-dark show-members" data-id="<?php echo $item['id'] ?>" onclick="displayMembers($(this))">Members</button>
                                        </td>
                                        <td data-id="<?php echo $item['id'] ?>" data-info="<?php echo rawurlencode(json_encode($item)) ?>">
                                            <button class="btn btn-danger btn-sm" onclick="delGroup($(this))">Del</button>
                                            <button class="btn btn-warning btn-sm" onclick="editGroup($(this))">Edit</button>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Group Apply</h3>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Group Name</th>
                                    <th>Member Name</th>
                                    <th>Create Time</th>
                                    <th>Handle Time</th>
                                    <th>Option</th>
                                </tr>
                                </thead>
                                <tbody id="group-list">
                                <?php foreach ($applyList as $item) {
                                    ?>
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
                                                <button class="btn btn-danger btn-sm"  onclick="handleApplyBySA($(this),'agree')">Agree</button>
                                                <button class="btn btn-warning btn-sm" onclick="handleApplyBySA($(this),'disagree')">Disagree</button>
                                            <?php
                                            }
                                            else{
                                                echo $item['status'];
                                            }
                                            ?>
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

<!-- the popup form for adding a group -->
<div class="modal fade" id="modal-add-group">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title" style="font-weight: bold;font-size: 1.2rem">Add Group
                    <p style="font-size: 1rem;font-weight: normal" id="route-title"></p>
                </span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
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

<!-- the popup form for editing a group -->
<div class="modal fade" id="modal-edit-group">
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
                        <label for="">Group Name</label>
                        <input type="text" class="form-control" id="name_edit">
                        <label for="">Group Description</label>
                        <input type="text" class="form-control" id="desc_edit">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="submitGroupEditBySA()">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- popup form for display the member list of the group -->
<div class="modal fade" id="modal-members">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title" style="font-weight: bold;font-size: 1.2rem">Member List
                    <p style="font-size: 1rem;font-weight: normal" id="route-title"></p>
                </span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body" style="margin: 20px">
                <div class="form-group row">
                    <table class="table table-hover" id="members-container">
                        <!-- member list here -->
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once "../common/footer.php";?>
