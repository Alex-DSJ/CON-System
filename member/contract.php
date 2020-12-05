<?php require_once "../common/header.php";?>
<!-- all required js files here -->
<script src="../static/functions.js"></script>
<?php
require_once "../func/func.php";
if (checkMemberLogin() == false) {
    header("Location:./login.php");
}
$dataList = getMemberContractList();

?>
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="margin-left:0px;!important;">
            <ul class="navbar-nav" id="my-nav">
                <li class="nav-item"><a class="nav-link" href="#" role="button"><i class="fas fa-bars"></i></a></li>
                <li class="nav-item d-none d-sm-inline-block"><a href="index.php" class="nav-link">Home</a></li>
                <li class="nav-item d-none d-sm-inline-block"><a href="social.php" class="nav-link">Social</a></li>
                <li class="nav-item d-none d-sm-inline-block active"><a href="contract.php" class="nav-link">Contract</a></li>
                <li class="nav-item d-none d-sm-inline-block"><a href="posting.php" class="nav-link">My Posting</a></li>
                <li class="nav-item d-none d-sm-inline-block"><a href="message.php" class="nav-link">Message</a></li>
                <li class="nav-item d-none d-sm-inline-block"><a href="base_info.php" class="nav-link">Base Info</a></li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-sign-out" class="logout" onclick="logout()">logout</i>
                    </a>
                </li>
            </ul>
        </nav>
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
                                    <button class="btn btn-primary btn-sm" onclick="addContract()">Add</button>
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
                                                <button class="btn btn-danger btn-sm" onclick="delContract($(this))">del</button>
                                                <button class="btn btn-warning btn-sm"  onclick="editContract($(this))">edit</button>
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

    <div class="modal fade" id="modal-add-message">
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
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-edit-message">
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
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

<?php require_once "../common/footer.php";?>