<?php
require_once "../func/func.php";

if (checkUserLogin() == false) {
    header("Location:/admin/login.php");
}
$dataList = getMemberList();
$condoList = getAllCondos();
$condoStr = "<option value=''>Please Select</option>";
foreach ($condoList as $item) {
    $condoStr .= "<option value='{$item['id']}'>{$item['name']}</option>";
}
?>

<!-- This file is completed by shijun DENG-40084956, refer from .owner/member.php -->

<!-- required scripts and external resources here -->
<link href="https://cdn.bootcss.com/bootstrap-select/1.13.10/css/bootstrap-select.min.css" rel="stylesheet">
<script src="https://cdn.bootcss.com/bootstrap-select/1.13.10/js/bootstrap-select.min.js"></script>

<!-- required php files and necessary data generation here -->
<?php require_once "../common/header.php"; ?>

<!-- page starts here -->
<div class="wrapper">

    <!-- navbar here -->
    <?php require_once "navbar.php"; ?>

    <!-- main table of the member tab -->
    <section class="content">
        <div class="container-fluid">

            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Member List</h3>
                        </div>
                        <div class="card-body">

                            <div style="margin-bottom: 10px">
                                <button class="btn btn-primary btn-sm" onclick="addMember()">Add</button>
                            </div>

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                    <th>Condos</th>
                                    <th>Groups</th>
                                    <th>Family</th>
                                    <th>Colleagues</th>
                                    <th>Privilege</th>
                                    <th>Status</th>
                                    <th>Create time</th>
                                    <th>Update time</th>
                                    <th>Option</th>
                                </tr>
                                </thead>
                                <tbody id="group-list">
                                <?php foreach ($dataList as $item) {
                                    ?>
                                    <tr>
                                        <td><?php echo $item['id'] ?></td>
                                        <td><?php echo $item['name'] ?></td>
                                        <td><?php echo $item['address'] ?></td>
                                        <td><?php echo $item['email'] ?></td>
                                        <td><button class="btn btn-dark" data-id="<?php echo $item['id'] ?>" onclick="showCondoSA(<?php echo $item['id'] ?>)">condos</button></td>
                                        <td><button class="btn btn-dark" data-id="<?php echo $item['id'] ?>" onclick="showGroup(<?php echo $item['id'] ?>)">groups</button></td>
                                        <td><?php echo $item['family'] ?></td>
                                        <td><?php echo $item['colleagues'] ?></td>
                                        <td><?php echo $item['privilege'] ?></td>
                                        <td><?php echo $item['status'] ?></td>
                                        <td><?php echo $item['create_time'] ?></td>
                                        <td><?php echo $item['last_update_time'] ?></td>
                                        <td data-id="<?php echo $item['id'] ?>" data-info="<?php echo rawurlencode(json_encode($item)) ?>">
                                            <button class="btn btn-danger btn-sm" onclick="delMember($(this))">Del</button>
                                            <button class="btn btn-warning btn-sm" onclick="editMember($(this))">Edit</button>
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
<!-- main page ends here -->

<!-- popup from for adding a member -->
<div class="modal fade" id="modal-add-member">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title" style="font-weight: bold;font-size: 1.2rem">Add Member
                    <p style="font-size: 1rem;font-weight: normal" id="route-title"></p>
                </span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body" style="margin: 20px">
                <div class="form-group row">
                    <label for=""><span style="color: red">*</span>Name</label>
                    <input type="text" class="form-control" id="name">
                    <label for=""><span style="color: red">*</span>Password</label>
                    <input type="password" class="form-control" id="password">
                    <label for=""><span style="color: red">*</span>Address</label>
                    <input type="text" class="form-control" id="address">
                    <label for=""><span style="color: red">*</span>Condo</label>
                    <select name="" id="condo" class="form-control">
                        <?php echo $condoStr; ?>
                    </select>
                    <label for="">Family</label>
                    <input type="text" class="form-control" id="family">
                    <label for="">Colleagues</label>
                    <input type="text" class="form-control" id="colleagues">
                    <label for="">Privilege</label>
                    <select name="" id="privilege" class="form-control">
                        <option value="">Please Select</option>
                        <option value="low">Low</option>
                        <option value="normal">Normal</option>
                        <option value="high">High</option>
                    </select>
                    <label for="">Status</label>
                    <select name="" id="status" class="form-control" >
                        <option value="">Please Select</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="submitMemberBySA()">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- popup form for editing a member -->
<div class="modal fade" id="modal-edit-member">
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
                    <label for=""><span style="color: red">*</span>Name</label>
                    <input type="text" class="form-control" id="name_edit">
                    <label for=""><span style="color: red">*</span>Password</label>
                    <input type="password" class="form-control" id="password_edit">
                    <label for=""><span style="color: red">*</span>Address</label>
                    <input type="text" class="form-control" id="address_edit">
                    <label for="">Condo</label>
                    <select name="" id="condos_edit" class="form-control">
                        <?php echo $condoStr; ?>
                    </select>
                    <label for="">Family</label>
                    <input type="text" class="form-control" id="family_edit">
                    <label for="">Colleagues</label>
                    <input type="text" class="form-control" id="colleagues_edit">
                    <label for="">Privilege</label>
                    <select name="" id="privilege_edit" class="form-control">
                        <option value="">Please Select</option>
                        <option value="low">Low</option>
                        <option value="normal">Normal</option>
                        <option value="high">High</option>
                    </select>
                    <label for="">Status</label>
                    <select name="" id="status_edit" class="form-control" >
                        <option value="">Please Select</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="submitMemberEditBySA()">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- popup form for display the condo list of the member -->
<div class="modal fade" id="modal-condos">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title" style="font-weight: bold;font-size: 1.2rem">Condo List
                    <p style="font-size: 1rem;font-weight: normal" id="route-title"></p>
                </span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body" style="margin: 20px">
                <div class="form-group row">
                    <table class="table table-hover" id="condos-contanier">
                        <!-- member list here -->
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once "../common/footer.php";?>