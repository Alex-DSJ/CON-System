<?php require_once "./common/header.php";?>
<script src="./static/ajaxfileupload.js"></script>
<?php
require_once "./func/func.php";

if (isset($_GET['id'])) {
    $info = getPublicPostingInfo($_GET['id']);
    $comment = getPostingComment($_GET['id']);
} else {
    $info = [];
}
?>
<div class="wrapper">

    <section class="content">
        <div class="container-fluid">
            <nav>
                <a href="guest.php">Back</a>
            </nav>
            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Posting</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            if (isset($_GET['id'])) {
                                ?>
                                <div>
                                    <div>
                                        <label for="">Title</label> <br/>
                                        <p class="border-bottom"><?php echo $info['title'] ?></p>
                                    </div>
                                    <div>
                                        <img src="./static/upload/<?php echo $info['pic'] ?>" alt="" width="400px" height="300px" class="rounded">
                                    </div>
                                    <div>
                                        <label for="">Content</label><br/>
<!--                                        change title to content-->
                                        <p class="border-bottom"><?php echo $info['content'] ?></p>
                                    </div>
                                    <div>
                                        <label for="">Comment</label>
                                        <ul>
                                            <?php
                                            foreach ($comment as $item) {
                                                ?>
                                                <li class="border-bottom">
                                                    <?php echo $item['content'] ?>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>



<?php require_once "./common/footer.php";?>
