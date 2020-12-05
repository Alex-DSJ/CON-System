<!-- This file is completed by saebom SHIN-40054234 individually -->

<!-- all required js files here -->
<script src="./static/functions.js"></script>

<!-- all required php files here -->
<?php require_once "./common/header.php";
require_once "./func/func.php";

$dataList =getPublicPost();
?>
    <div class="wrapper">
        <!-- main table of the guest tab -->
        <section class="content">
            <div class="container-fluid">
                <nav>
                    <a href="index.php">Main Page</a>
                </nav>
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
                                                <!-- check the detailPosting .js and .php for guest -->
                                                <button class="btn btn-primary btn-sm" onclick="detailPostingGuest($(this))">detail</button>
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