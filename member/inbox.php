<!-- This file is completed by kimchhengheng-26809413 individually -->
<!-- all required php files here -->
<?php 
    require_once "../common/header.php";
    require_once "../func/func.php";

?>
<!-- all required js files here -->
<script src="../static/functions.js"></script>
<?php
if (checkMemberLogin() == false) {
    header("Location:./login.php");
}
$dataList = getInboxMessage();
?>
<div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="margin-left:0px;!important;">
        <ul class="navbar-nav" id="my-nav">
            <li class="nav-item"><a class="nav-link" href="#" role="button"><i class="fas fa-bars"></i></a></li>
            <li class="nav-item d-none d-sm-inline-block"><a href="index.php" class="nav-link">Home</a></li>
            <li class="nav-item d-none d-sm-inline-block"><a href="social.php" class="nav-link">Social</a></li>
            <li class="nav-item d-none d-sm-inline-block"><a href="contract.php" class="nav-link">Contract</a></li>
            <li class="nav-item d-none d-sm-inline-block"><a href="posting.php" class="nav-link">My Posting</a></li>
            <li class="nav-item d-none d-sm-inline-block active"><a href="message.php" class="nav-link">Message</a></li>
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
                            <h3 class="card-title">InBox Message</h3>
                        </div>

                        <div class="card-body">
                            <div style="margin-bottom: 10px">
                                <button class="btn btn-primary btn-sm" onclick="window.location.href='inbox.php'">Inbox <i class="fas fa-inbox"></i></button>
                                <button class="btn btn-primary btn-sm" onclick="window.location.href='sentbox.php'">SendBox <i class="fas fa-paper-plane"></i></button>
                            </div>

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Message</th>
                                    <th>Sender</th>
                                    <th>create time</th>
                                </tr>
                                </thead>
                                <tbody id="group-list">
                                <?php foreach ($dataList as $item) {
                                    ?>
                                    <tr>
                                        <td><?php echo $item['id'] ?></td>
                                        <td><?php echo $item['title'] ?></td>
                                        <td><?php echo $item['content'] ?></td>
                                        <td><?php echo $item['sender'] ?></td>
                                        <td><?php echo $item['create_time'] ?></td>
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