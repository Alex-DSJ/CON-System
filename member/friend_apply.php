<?php require_once "../common/header.php";?>
<script src="../static/functions.js"></script>
<?php
require_once "../func/func.php";
if (checkMemberLogin() == false) {
    header("Location:./login.php");
}
$info = getNewFriendApply();
?>
<div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="margin-left:0px;!important;">
        <ul class="navbar-nav" id="my-nav">
            <li class="nav-item"><a class="nav-link" href="#" role="button"><i class="fas fa-bars"></i></a></li>
            <li class="nav-item d-none d-sm-inline-block"><a href="index.php" class="nav-link">Home</a></li>
            <li class="nav-item d-none d-sm-inline-block"><a href="social.php" class="nav-link">Social</a></li>
            <li class="nav-item d-none d-sm-inline-block"><a href="contract.php" class="nav-link">Contract</a></li>
            <li class="nav-item d-none d-sm-inline-block"><a href="posting.php" class="nav-link">My Posting</a></li>
            <li class="nav-item d-none d-sm-inline-block"><a href="message.php" class="nav-link">Message</a></li>
            <li class="nav-item d-none d-sm-inline-block active"><a href="base_info.php" class="nav-link">Base Info</a></li>
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
                            <h3 class="card-title">Friend Apply List</h3>
                        </div>
                        <div class="card-body">
                            <table class="table-striped table">
                                <tr>
                                    <th>Applier Name</th>
                                    <th>Create Time</th>
                                    <th>Options</th>
                                </tr>
                                <?php foreach ($info as $item){
                                    ?>
                                    <tr>
                                        <td><?php echo $item['applier_name']?></td>
                                        <td><?php echo $item['create_time']?></td>
<!--                                        <input type="hidden" id="applier_id" value="--><?php //$item['applier_id']?><!--">-->
                                        <td data-id="<?php echo $item['id']?>">
                                            <button class="btn btn-sm btn-danger disagree-friend">disagree</button>
                                            <button class="btn btn-sm btn-success agree-friend">agree</button>
                                        </td>
                                    </tr>
                                    <?php
                                } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<?php require_once "../common/footer.php";?>
