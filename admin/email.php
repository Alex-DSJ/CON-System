<?php
require_once "../func/func.php";
if (checkUserLogin() == false) {
    header("Location:./login.php");
}
$mailList = getAllEmails();
$memberList = getMemberList();
$nameOptions = '';
foreach ($memberList as $member) {
    $nameOptions .= "<option value='{$member['id']}'>{$member['name']}</option>";
}
?>
<!-- This file is completed by shijun DENG - 40084956 refers to /member/message.php -->

<!-- all required php files here -->
<?php require_once "../common/header.php"; ?>


<!-- all required js here -->
<script src="https://cdn.bootcdn.net/ajax/libs/bootstrap-select/2.0.0-beta1/js/bootstrap-select.js"></script>
<script src="../static/functions.js"></script>
<link href="https://cdn.bootcdn.net/ajax/libs/bootstrap-select/2.0.0-beta1/css/bootstrap-select.min.css" rel="stylesheet">


<div class="wrapper">

    <?php require_once "navbar.php"?>

    <!-- newly added -->
        <section class="content">
        <div class="container-fluid">
            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Emails</h3>
                        </div>
                        <div class="card-body">
                            <div style="margin-bottom: 10px">
                                <button class="btn btn-primary btn-sm" onclick="addEmail()">Add</button>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>create time</th>
                                    <th>option</th>
                                </tr>
                                </thead>
                                <tbody id="group-list">
                                <?php foreach ($mailList as $item) {
                                    ?>
                                    <tr>
                                        <td><?php echo $item['id'] ?></td>
                                        <td><?php echo $item['title'] ?></td>
                                        <td><?php echo $item['sender'] ?></td>
                                        <td><?php echo $item['receiver'] ?></td>
                                        <td><?php echo $item['create_time'] ?></td>
                                        <td data-id="<?php echo $item['id'] ?>" data-info="<?php echo rawurlencode(json_encode($item)) ?>">
                                            <!-- <button class="btn btn-primary btn-sm" onclick="assignAdmin($(this))">Assign</button> -->
                                            <button class="btn btn-danger btn-sm" onclick="delEmail($(this))">Del</button>
                                            <button class="btn btn-warning btn-sm"  onclick="editEmail($(this))">Edit</button>
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

<!-- popup form for add email for a member by the super admin -->
<div class="modal fade" id="modal-add-email">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title" style="font-weight: bold;font-size: 1.2rem">Add Email
                    <p style="font-size: 1rem;font-weight: normal" id="route-title"></p>
                </span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body" style="margin: 20px">
                <div class="form-group row">
                    <label for=""><span style="color: red">*</span>Title</label>
                    <input type="text" class="form-control" id="title">
                    <label for=""><span style="color: red">*</span>Sender</label>
                    <select name="" id="sender" class="form-control">
                        <option value="" disabled selected>Please Select</option>
                        <?php echo $nameOptions; ?>
                    </select>
                    <label for=""><span style="color: red">*</span>Receiver</label>
                    <select class="form-control" id="receiver">
                        <option value="" disabled selected>Please Select</option>
                        <?php echo $nameOptions; ?>
                    </select>
                    <label for=""><span style="color: red">*</span>Content</label>
                    <textarea name="" id="content" cols="30" rows="10" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="submitEmail()">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- the popup form for edit button -->
<div class="modal fade" id="modal-edit-email">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title" style="font-weight: bold;font-size: 1.2rem">Edit Email
                    <p style="font-size: 1rem;font-weight: normal" id="route-title"></p>
                </span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body" style="margin: 20px">
                <div class="form-group row">
                    <label for="" id="id_edit"></label>
                    <label for=""><span style="color: red">*</span>Title</label>
                    <input type="text" class="form-control" id="title_edit">
                    <label for=""><span style="color: red">*</span>Sender</label>
                    <select name="" id="sender_edit" class="form-control">
                        <option value="" disabled selected>Please Select</option>
                        <?php echo $nameOptions; ?>
                    </select>
                    <label for=""><span style="color: red">*</span>Receiver</label>
                    <select class="form-control" id="receiver_edit">
                        <option value="" disabled selected>Please Select</option>
                        <?php echo $nameOptions; ?>
                    </select>
                    <label for=""><span style="color: red">*</span>Content</label>
                    <textarea name="" id="content_edit" cols="30" rows="10" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="submitEmailEdit()">Save</button>
            </div>
        </div>
    </div>
</div>

<?php require_once "../common/footer.php";?>
