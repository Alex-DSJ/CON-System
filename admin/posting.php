<?php
require_once "../func/func.php";
if (checkUserLogin() == false) {
    header("Location:/owner/login.php");
}
$dataList = getPostingAll();
?>

<!-- This file is completed by shijun DENG-40084956 refers to /owner/posting.php -->

<!-- all required js files here -->
<script src="../static/functions.js"></script>
<!-- all required php files here -->
<?php require_once "../common/header.php"; ?>
    <div class="wrapper">
    
        <!-- navbar -->
        <?php require_once "navbar.php"; ?>

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