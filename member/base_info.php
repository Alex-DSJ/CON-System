<?php require_once "../common/header.php";?>
<?php
require_once "../func/func.php";

if (checkMemberLogin() == false) {
    header("Location:/member/login.php");
}
$info = getMemberInfo();
$condoInfo = getMemberCondoInfo();
$groupInfo = getMemberGroupInfo();
$friendInfo = getMemberFriendInfo();

?>
<div class="wrapper">

    <?php require_once "./nav.php"?>

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
                        <div class="card-header">
                            <h3 class="card-title">Condo Info</h3>
                        </div>
                        <div class="card-body">
                            <table class="table-striped table">
                                <tr>
                                    <th>Condo Name</th>
                                    <th>Area</th>
                                    <th>Cost</th>
                                </tr>
                                <?php foreach ($condoInfo as $item){
                                    ?>
                                    <tr>
                                        <td><?php echo $item['name']?></td>
                                        <td><?php echo $item['area']?></td>
                                        <td><?php echo $item['cost']?></td>
                                    </tr>
                                    <?php
                                } ?>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Group Info</h3>
                        </div>
                        <div class="card-body">
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
                                        <td><button class="btn btn-danger" onclick="withdraw()">withdraw</button></td>
                                    </tr>
                                    <?php
                                } ?>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Friend Info</h3>
                        </div>
                        <div class="card-body">
                            <table class="table-striped table">
                                <tr>
                                    <th>Friend Name</th>
                                    <th>Create Time</th>
                                </tr>
                                <?php foreach ($friendInfo as $item){
                                    ?>
                                    <tr>
                                        <td><?php echo $item['name']?></td>
                                        <td><?php echo $item['create_time']?></td>
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
