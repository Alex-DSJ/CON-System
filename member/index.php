<?php require_once "../common/header.php";?>
<!-- all required js files here -->
<script src="../static/functions.js"></script>
<?php
require_once "../func/func.php";
// if (checkMemberLogin() == false) {
//     header("Location:./login.php");
// }
 $info = getMemberInfo();
 $condoInfo = getMemberCondoInfo();
 $groupInfo = getMemberGroupInfo();
?>
<div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="margin-left:0px;!important;">
        <ul class="navbar-nav" id="my-nav">
            <li class="nav-item"><a class="nav-link" href="#" role="button"><i class="fas fa-bars"></i></a></li>
            <li class="nav-item d-none d-sm-inline-block"><a href="index.php" class="nav-link">Home</a></li>
            <li class="nav-item d-none d-sm-inline-block active"><a href="social.php" class="nav-link">Social</a></li>
            <li class="nav-item d-none d-sm-inline-block"><a href="contract.php" class="nav-link">Contract</a></li>
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
                            <h3 class="card-title">Base Info</h3>
                        </div>
                        <div class="card-body">
                            <p>#:    <strong><?php echo $info['id'] ?></strong></p>
                            <p>name:    <strong><?php echo $info['name'] ?></strong></p>
                            <p>address: <strong><?php echo $info['address'] ?></strong></p>
                            <p>email:   <strong><?php echo $info['email'] ?></strong></p>
                            <p>privilege:   <strong><?php echo $info['privilege'] ?></strong></p>
                            <p>status:  <strong><?php echo $info['status'] ?></strong></p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div style="width: 50px;height: 50px">
                                    <img src="../static/upload/default/new.png" alt="" style="width: 100%">
                                </div>
                                <button class="btn btn-info btn-sm" onclick="window.open('./friend_apply.php')">New Friend Apply+</button>
                            </div>
                            <div class="row m-t-10">
                                <div style="width: 50px;height: 50px">
                                    <img src="../static/upload/default/hot.png" alt="" style="width: 100%">
                                </div>
                                <button class="btn btn-success btn-sm" onclick="window.open('./hot_posts.php')">Friend Hot Posts</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

<?php require_once "../common/footer.php";?>
