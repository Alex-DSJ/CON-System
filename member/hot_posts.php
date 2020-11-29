<?php require_once "../common/header.php";?>
    <link href="https://cdn.bootcss.com/bootstrap-select/1.13.10/css/bootstrap-select.min.css" rel="stylesheet">
    <script src="https://cdn.bootcss.com/bootstrap-select/1.13.10/js/bootstrap-select.min.js"></script>
<?php
require_once "../func/func.php";
if (checkMemberLogin() == false) {
    header("Location:/member/login.php");
}
$suggestPostingList = getFriendLastedPosting();//need work on
?>
    <div class="wrapper">

        <?php require_once "./nav.php"?>

        <section class="content">
            <div class="container-fluid">

                <div class="row" style="margin-top: 20px">
                    <div class="col-md-12">
                        <div class="card m-t-10">
                            <div class="card-header">
                                <h3 class="card-title">Hot Postings</h3>
                            </div>
                            <div class="card-body">
                                <div>
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>title</th>
                                            <th>author</th>
                                            <th>create_time</th>
                                            <th>option</th>
                                        </tr>
                                        </thead>
                                        <tbody id="posting-search-container">
                                        <?php foreach ($suggestPostingList as $item){
                                            ?>
                                            <tr>
                                                <td><?php echo $item['id']; ?></td>
                                                <td><?php echo $item['title']; ?></td>
                                                <td><?php echo $item['name']; ?></td>
                                                <td><?php echo $item['create_time']; ?></td>
                                                <td data-id="<?php echo $item['id'] ?>">
                                                    <button class="btn btn-primary btn-sm" onclick="detailPosting($(this))">detail</button>
                                                </td>
                                            </tr>
                                            <?php
                                        } ?>
                                        </tbody>
                                    </table>
                                </div>
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