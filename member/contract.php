<?php
require_once "../func/func.php";
if (checkMemberLogin() == false) {
    header("Location: ./login.php");
}
$dataList = getMemberContractList();
?>

<!-- This file is completed by Yuxin Wang-40024855 individually -->

<!-- all required php files here -->
<?php require_once "../common/header.php";?>

<!-- all required js files here -->
<script src="../static/functions.js"></script>

    <div class="wrapper">

        <!-- Header for the Member -->
        <?php require_once "nav.php";?>

        <!-- Content of the Contract Page -->
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="margin-top: 20px">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Contract Message</h3>
                            </div>
                            <div class="card-body">
                                <div style="margin-bottom: 10px">
                                    <button class="btn btn-primary btn-sm" onclick="addContract()"><i class="far fa-plus-square"></i></button>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Message</th>
                                        <th>Status</th>
                                        <th>Create time</th>
                                        <th>Option</th>
                                    </tr>
                                    </thead>
                                    <tbody id="group-list">
                                    <?php foreach ($dataList as $item) {
                                        ?>
                                        <tr>
                                            <td><?php echo $item['title'] ?></td>
                                            <td><?php echo $item['content'] ?></td>
                                            <td><?php echo $item['status'] ?></td>
                                            <td><?php echo $item['create_time'] ?></td>
                                            <td data-id="<?php echo $item['id'] ?>" data-info="<?php echo rawurlencode(json_encode($item)) ?>">
                                                <button class="btn btn-danger btn-sm" onclick="delContract($(this))"><i class="fas fa-trash-alt"></i></button>
                                                <button class="btn btn-warning btn-sm"  onclick="editContract($(this))"><i class="fas fa-edit"></i></button>
                                            </td>
                                        </tr>
                                        <?php
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Popup form for adding a contract -->
    <div class="modal fade" id="modal-add-contract">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <span class="modal-title" style="font-weight: bold;font-size: 1.2rem">Add Contract
                    <p style="font-size: 1rem;font-weight: normal" id="route-title"></p>
                </span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body" style="margin: 20px">
                    <div class="form-group row">
                        <label for="">Title</label>
                        <input type="text" class="form-control" id="title">
                        <label for="">Message</label>
                        <input type="text" class="form-control" id="content">
                        <label for="">Status</label>
                        <select name="" id="status" class="form-control">
                            <option value="normal">normal</option>
                            <option value="urgent">urgent</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="submitContract()">Save</button>
                </div>
            </div>
        </div>
    </div>

<!-- Popup form for editing a contract -->
    <div class="modal fade" id="modal-edit-contract">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <span class="modal-title" style="font-weight: bold;font-size: 1.2rem">Edit Contract
                    <p style="font-size: 1rem;font-weight: normal" id="route-title"></p>
                </span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body" style="margin: 20px">
                    <div class="form-group row">
                        <label for="">Title</label>
                        <input type="hidden" class="form-control" id="id_edit">
                        <input type="text" class="form-control" id="title_edit">
                        <label for="">Message</label>
                        <input type="text" class="form-control" id="content_edit">
                        <label for="">Status</label>
                        <select name="" id="status_edit" class="form-control">
                            <option value="normal">normal</option>
                            <option value="urgent">urgent</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="submitContractEdit()">Save</button>
                </div>
            </div>
        </div>
    </div>
    
<?php require_once "../common/footer.php";?>