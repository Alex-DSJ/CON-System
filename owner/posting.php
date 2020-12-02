<!-- This file is completed by saebom SHIN-40054234 individually -->

<!-- all required js files here -->

<!-- all required php files here -->
<?php require_once "../common/header.php";
require_once "../func/func.php";
if (checkUserLogin() == false) {
    header("Location:/owner/login.php");
}
$dataList = getPostingAll();
?>
    <div class="wrapper">
        <!-- navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="margin-left:0px;!important;">
            <ul class="navbar-nav" id="my-nav">
                <li class="nav-item"><a class="nav-link" href="#" role="button"><i class="fas fa-bars"></i></a></li>
                <li class="nav-item d-none d-sm-inline-block "><a href="index.php" class="nav-link">Member</a></li>
                <li class="nav-item d-none d-sm-inline-block"><a href="group.php" class="nav-link">Group</a></li>
                <li class="nav-item d-none d-sm-inline-block"><a href="condo.php" class="nav-link">CONDO</a></li>
                <li class="nav-item d-none d-sm-inline-block active"><a href="posting.php" class="nav-link">Posting</a></li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-sign-out" class="logout" onclick="logout()">logout</i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- main table of the condo tab -->
        <section class="content">
            <div class="container-fluid">

                <div class="row" style="margin-top: 20px">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">My Posting</h3>
                            </div>

                            <div class="card-body">
<!--                                <div style="margin-bottom: 10px">-->
<!--                                    <button class="btn btn-primary btn-sm" onclick="window.location.href='posting_tmpl.php'">Add</button>-->
<!--                                </div>-->

                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>title</th>
                                        <th>create time</th>
                                        <th>option</th>
                                    </tr>
                                    </thead>
                                    <tbody id="group-list">
                                    <?php foreach ($dataList as $item) {
                                        ?>
                                        <tr>
                                            <td><?php echo $item['id'] ?></td>
                                            <td><?php echo $item['title'] ?></td>
                                            <td><?php echo $item['create_time'] ?></td>
                                            <td data-id="<?php echo $item['id'] ?>">
                                                <button class="btn btn-danger btn-sm" onclick="delPosting($(this))">del</button>
<!--                                                <button class="btn btn-warning btn-sm" onclick="editPosting($(this))">edit</button>-->
                                                <button class="btn btn-primary btn-sm" onclick="detailPostingOwner($(this))">detail</button>
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

<?php require_once "../common/footer.php";?>