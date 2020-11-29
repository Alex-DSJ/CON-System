<!-- This file is completed by shijun DENG-40084956 individually -->
<!-- all required php files here -->
<?php
    require_once "../common/header.php";
    require_once "../func/func.php";
    require_once "../func/contract_func.php";
?>

<!-- all required js file here -->
<script src="../static/contract.js"></script>

<?php

if (checkUserLogin() == false) {
    // header("Location:/admin/login.php");
}
$dataList = getContractList();

?>
    <div class="wrapper">

        <!-- navbar start here -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="margin-left:0px;!important;">
            <ul class="navbar-nav" id="my-nav">
                <li class="nav-item"><a class="nav-link" href="#" role="button"><i class="fas fa-bars"></i></a></li>
                <li class="nav-item d-none d-sm-inline-block "><a href="index.php" class="nav-link">Admin</a></li>
                <li class="nav-item d-none d-sm-inline-block"><a href="building.php" class="nav-link">Building</a></li>
                <li class="nav-item d-none d-sm-inline-block active"><a href="contract.php" class="nav-link">Contract</a></li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-sign-out" class="logout" onclick="logout()">logout</i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- navbar end here -->

        <!-- main table of the page strat here -->
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
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Message</th>
                                        <th>Status</th>
                                        <th>Create time</th>
                                        <th>Option</th>
                                    </tr>
                                    <tr>
                                        <td>hardcode data</td>
                                        <td>hardcode data</td>
                                        <td>hardcode data</td>
                                        <td>hardcode data</td>
                                        <td>hardcode data</td>
                                        <td><button class="btn btn-primary edit-contract">Edit</button></td>
                                    </tr>
                                    </thead>
                                    <tbody id="group-list">
                                    
                                    <!-- TODO get the contract list -->

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- main table of the page end here -->
    </div>

    <!-- popup form for adding a contract -->
    <div class="modal fade" id="modal-add-message">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <span class="modal-title" style="font-weight: bold;font-size: 1.2rem">Add Message
                    <p style="font-size: 1rem;font-weight: normal" id="route-title"></p>
                </span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body" style="margin: 20px">
                    <div class="form-group row">
                        <input type="hidden" id="edit_id">
                        <select name="" id="status" class="form-control">
                            <option value="normal">normal</option>
                            <option value="urgent">urgent</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="updateContract()">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- popup form for adding a contract -->

<?php require_once "../common/footer.php";?>
