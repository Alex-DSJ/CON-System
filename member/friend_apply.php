<!-- This file is completed by Yuxin Wang-40024855 individually -->

<!-- all required php files here -->
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
    <!-- Header for the Member -->
    <?php require_once "nav.php"?>
    <!-- Content of the Friend Apply Page -->
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
