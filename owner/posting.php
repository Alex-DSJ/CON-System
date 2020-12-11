<?php
require_once "../func/func.php";

if (checkUserLogin() == false) {
    header("Location:/owner/login.php");
}

$dataList = getPostingAll();
$allGroup = getGroupList();

require_once "../common/header.php";
?>

<!-- This file is completed by saebom SHIN-40054234 individually -->

<!-- all required js files here -->
<script src="../static/functions.js"></script>

    <div class="wrapper">

        <!-- navbar here -->
        <?php require_once "nav.php";?>

        <!-- main table of this page -->
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="margin-top: 20px">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Member Posting </h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>title</th>
                                        <th>author</th>
                                        <th>status</th>
                                        <th>create time</th>
                                        <th>option</th>
                                    </tr>
                                    </thead>
                                    <tbody id="group-list">
                                    <?php foreach ($dataList as $item) { ?>
                                        <tr>
                                            <td><?php echo $item['id'] ?></td>
                                            <td><?php echo $item['title'] ?></td>
                                            <td><?php echo $item['name'] ?></td>
                                            <td><?php echo $item['status'] ?></td>
                                            <td><?php echo $item['create_time'] ?></td>
                                            <td data-id="<?php echo $item['id'] ?>">
                                                <button class="btn btn-danger btn-sm" onclick="delPosting($(this))">del</button>
                                                <button class="btn btn-primary btn-sm" onclick="detailPostingOwner($(this))">detail</button>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
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
                                        <?php foreach ($allGroup as $item){ ?>
                                            <tr>
                                                <td><?php echo $item['group_name']?></td>
                                                <td><?php echo $item['description']?></td>
                                                <td data-id="<?php echo $item['union_id'] ?>"><button class="btn btn-danger" onclick="detailGroupPostingOwner(<?php echo $item['id']?>)">All Post</button></td>
                                            </tr>
                                            <?php } ?>
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