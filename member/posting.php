<!-- This file is completed by kimchhengheng-26809413 individually -->
<!-- all required php files here -->
<?php 
    require_once "../common/header.php";
    require_once "../func/posting_func.php";
    require_once "../func/func.php";
?>

<!-- all required js here -->
<script src="../static/auth.js"></script>
<script src="../static/posting.js"></script>


<?php
// to check the login 

$dataList = getPostingList();
?>
<div class="wrapper">

    <?php require_once "./nav.php"?>

    <section class="content">
        <div class="container-fluid">

            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">My Posting</h3>
                        </div>

                        <div class="card-body">
                            <div style="margin-bottom: 10px">
                                <button class="btn btn-primary btn-sm" onclick="window.location.href='posting_template.php'"><i class="far fa-plus-square"></i></button>
                            </div>

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
                                            <button class="btn btn-danger btn-sm" onclick="delPosting($(this))"><i class="fas fa-trash-alt"></i></button>
                                            <button class="btn btn-warning btn-sm" onclick="editPosting($(this))"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-primary btn-sm" onclick="detailPosting($(this))"><i class="fas fa-info-circle"></i></button>
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