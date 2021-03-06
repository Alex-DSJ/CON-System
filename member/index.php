<?php
require_once "../func/func.php";
if (checkMemberLogin() == false) {
    header("Location: ./login.php");
}
$info = getMemberInfo();
$condoInfo = getMemberCondoInfo();
$groupInfo = getMemberGroupInfo();
?>

<!-- This file is completed by Yuxin Wang-40024855 individually -->

<!-- all required js files here -->
<script src="../static/functions.js"></script>

<!-- all required php files here -->
<?php require_once "../common/header.php";?>

<div class="wrapper">

    <!-- Header for the Member -->
    <?php require_once "nav.php";?>

    <!-- Content of the Home Page -->
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
                        <div class="card-header">
                            <h3 class="card-title">Group Posting</h3>
                        </div>
                        <div class="card-body">
                            <div>
                                <table class="table-striped table">
                                    <tr>
                                        <th>Group Name</th>
                                        <th>Group Description</th>
                                        <th>Option</th>
                                    </tr>
                                    <?php foreach ($groupInfo as $item){
                                        ?>
                                        <tr>
                                            <td><?php echo $item['group_name']?></td>
                                            <td><?php echo $item['description']?></td>
                                            <td data-id="<?php echo $item['union_id'] ?>"><button class="btn btn-danger" onclick="detailGroupPostingMember(<?php echo $item['id']?>)">All Post</button></td>
                                        </tr>
                                        <?php
                                    } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require_once "../common/footer.php";?>
