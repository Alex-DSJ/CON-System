<!-- This file is completed by saebom SHIN-40054234 individually -->

<!-- all required js files here -->
<script src="../static/posting.js"></script>

<!-- all required php files here -->
<?php require_once "../common/header.php";
require_once "../func/func.php";
require_once "../func/posting_func.php";

$dataList = getPostingAll();
?>
    <div class="wrapper">
        <!-- main table of the guest tab -->
        <section class="content">
            <div class="container-fluid">

                <div class="row" style="margin-top: 20px">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Posting</h3>
                            </div>

                            <div class="card-body">

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
<!--                                                <button class="btn btn-danger btn-sm" onclick="delPosting($(this))">del</button>-->
<!--                                                <button class="btn btn-warning btn-sm" onclick="editPosting($(this))">edit</button>-->
                                                <!-- check the detailPosting .js and .php for guest -->
                                                <button class="btn btn-primary btn-sm" onclick="detailPosting($(this))">detail</button>
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

<?php require_once "./common/footer.php";?>