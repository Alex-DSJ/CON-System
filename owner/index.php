<?php
require_once "../func/func.php";
if (checkUserLogin() == false) {
    header("Location:./login.php");
}
$dataList = getMemberListAdmin();
$condo = getCondoList();
$condoStr = '';
foreach ($condo as $item) {
    $condoStr .= "<option value='{$item['id']}'>{$item['name']}</option>";
}
require_once "../common/header.php";
?>
<!-- This file is completed by saebom SHIN-40054234 individually -->
<!-- all required js files here -->
<script src="../static/functions.js"></script>
<link href="https://cdn.bootcss.com/bootstrap-select/1.13.10/css/bootstrap-select.min.css" rel="stylesheet">
<script src="https://cdn.bootcss.com/bootstrap-select/1.13.10/js/bootstrap-select.min.js"></script>
<!-- all required php files here -->
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
                            <h3 class="card-title">Member List</h3>
                        </div>
                        <div class="card-body">

                            <div style="margin-bottom: 10px">
                                <button class="btn btn-primary btn-sm" onclick="addMember()">Add</button>
                            </div>

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>name</th>
                                    <th>address</th>
                                    <th>email</th>
                                    <th>condos</th>
                                    <th>groups</th>
                                    <th>family</th>
                                    <th>colleagues</th>
                                    <th>privilege</th>
                                    <th>status</th>
                                    <th>create time</th>
                                    <th>update time</th>
                                    <th>option</th>
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
                                        <td><button class="btn btn-dark" data-id="<?php echo $item['id'] ?>" onclick="showCondo(<?php echo $item['id'] ?>)">condos</button></td>
                                        <td><button class="btn btn-dark" data-id="<?php echo $item['id'] ?>" onclick="showGroup(<?php echo $item['id'] ?>)">groups</button></td>
                                        <td><?php echo $item['family'] ?></td>
                                        <td><?php echo $item['colleagues'] ?></td>
                                        <td><?php echo $item['privilege'] ?></td>
                                        <td><?php echo $item['status'] ?></td>
                                        <td><?php echo $item['create_time'] ?></td>
                                        <td><?php echo $item['last_update_time'] ?></td>
                                        <td data-id="<?php echo $item['id'] ?>" data-info="<?php echo rawurlencode(json_encode($item)) ?>">
                                            <button class="btn btn-danger btn-sm" onclick="delMember($(this))">del</button>
                                            <button class="btn btn-warning btn-sm" onclick="editMember($(this))">edit</button>
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
                    <label for=""><span style="color: red">*</span>Condos</label>
                    <select name="" id="condos" class="form-control">
                        <option value="">please select</option>
                        <?php
                        foreach ($condo as $item) {
                        ?>
                        <option value="<?php echo $item['id']?>">
                            <?php echo $item['name']?></option>
                            <?php
                            }
                            ?>
                    </select>
                    <label for="">Family</label>
                    <input type="text" class="form-control" id="family">
                    <label for="">Colleagues</label>
                    <input type="text" class="form-control" id="colleagues">
                    <label for="">Privilege</label>
                    <select name="" id="privilege" class="form-control">
                        <option value="">please select</option>
                        <option value="low">low</option>
                        <option value="normal">normal</option>
                        <option value="high">high</option>
                    </select>
                    <label for="">Status</label>
                    <select name="" id="status" class="form-control" >
                        <option value="">please select</option>
                        <option value="active">active</option>
                        <option value="inactive">inactive</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="submitMember()">Save</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

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
                    <label for=""><span style="color: red">*</span>Condos</label>
                    <select name="" id="condos_edit" class="form-control" title="please select">
                        <?php echo $condoStr; ?>
                    </select>
                    <label for="">Family</label>
                    <input type="text" class="form-control" id="family_edit">
                    <label for="">Colleagues</label>
                    <input type="text" class="form-control" id="colleagues_edit">
                    <label for="">Privilege</label>
                    <select name="" id="privilege_edit" class="form-control">
                        <option value="">please select</option>
                        <option value="low">low</option>
                        <option value="normal">normal</option>
                        <option value="high">high</option>
                    </select>
                    <label for="">Status</label>
                    <select name="" id="status_edit" class="form-control" >
                        <option value="">please select</option>
                        <option value="active">active</option>
                        <option value="inactive">inactive</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="submitMemberEdit()">Save</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modal-condos">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title" style="font-weight: bold;font-size: 1.2rem">Detail
                    <p style="font-size: 1rem;font-weight: normal" id="route-title"></p>
                </span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body" style="margin: 20px">
                <div class="form-group row">
                    <table class="table table-hover" id="condos-contanier">

                    </table>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php require_once "../common/footer.php";?>
