<?php
require_once "../func/func.php";

if (checkUserLogin() == false) {
    header("Location:./login.php");
}

if (isset($_GET['id'])) {
    $groupName=getGroupName($_GET['id']);
    $allPostInGroup= getALlPostByGroup($groupName['group_name']);
} else {
    $info = [];
}
?>

<!-- This file is completed by saebom SHIN-40054234 individually -->

<!-- all required php files here -->
<?php require_once "../common/header.php";?>
<script src="../static/functions.js"></script>

<div class="wrapper">

    <!-- navbar here -->
    <?php require_once "nav.php";?>

    <!-- content of the Friend Hot Posts Page -->
    <section class="content">
        <div class="container-fluid">
            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div class="card m-t-10">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo $groupName['group_name'];?></h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>title</th>
                                    <th>name</th>
                                    <th>create time</th>
                                    <th>option</th>
                                </tr>
                                </thead>
                                <tbody id="group-list">
                                <?php
                                foreach ($allPostInGroup as $item) { ?>
                                    <tr>
                                        <td><?php echo $item['id']; ?></td>
                                        <td><?php echo $item['title']; ?></td>
                                        <td><?php echo $item['name']; ?></td>
                                        <td><?php echo $item['create_time']; ?></td>
                                        <td data-id="<?php echo $item['id']; ?>">
                                            <button class="btn btn-primary btn-sm" onclick="detailPostingOwner($(this))"><i class="fas fa-info-circle"></i></button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer" style="display: none;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require_once "../common/footer.php";?>
