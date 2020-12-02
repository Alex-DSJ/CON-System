<!-- This file is completed by saebom SHIN-40054234 individually -->

<!-- all required js files here -->
<script src="../static/ajaxfileupload.js"></script>
<script src="../static/functions.js"></script>

<!-- all required php files here -->
<?php require_once "../common/header.php";
require_once "../func/func.php";

if (checkUserLogin() == false) {
    header("Location:/owner/login.php");
}

if (isset($_GET['id'])) {
    $info = getPostingInfo($_GET['id']);
} else {
    $info = [];
}
?>
<div class="wrapper">
    <!-- navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="margin-left:0px;!important;">
        <ul class="navbar-nav" id="my-nav">
            <li class="nav-item"><a class="nav-link" href="#" role="button"><i class="fas fa-bars"></i></a></li>
            <li class="nav-item d-none d-sm-inline-block "><a href="index.php" class="nav-link">Member</a></li>
            <li class="nav-item d-none d-sm-inline-block"><a href="group.php" class="nav-link">Group</a></li>
            <li class="nav-item d-none d-sm-inline-block"><a href="condo.php" class="nav-link">CONDO</a></li>
            <li class="nav-item d-none d-sm-inline-block active"><a href="posting.php" class="nav-link">Posting</a></li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-sign-out" class="logout" onclick="logout()">logout</i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- main table of the condo tab -->
    <section class="content">
        <div class="container-fluid">

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
                                <div action="">
                                    <input type="hidden" value="<?php echo $info['id'] ?>" id="id_edit">
                                    <div class="row">
                                        <label for="">Title</label>
                                        <input type="text" class="form-control" id="title" value="<?php echo $info['title'] ?>">
                                    </div>
                                    <div class="row m-t-10" >
                                        <label for="">Image</label>
                                        <input type="file" id="fileToUpload" name="fileToUpload" value="" accept="image/jpeg,image/jpg,image/png"></td>
                                    </div>
                                    <div>
                                        <img src="../static/upload/<?php echo $info['pic'] ?>" alt="" width="400px" height="300px">

                                    </div>
                                    <div class="row m-t-10">
                                        <label for="">Content</label>
                                        <textarea name="" id="content" cols="30" rows="10" class="form-control" value=""><?php echo $info['title'] ?></textarea>
                                    </div>
                                    <button class="btn btn-primary save" onclick="savePosting('edit_posting')">Save</button>
                                    <?php if (isset($_GET['id']) && isset($_GET['act']) && $_GET['act'] == 'view') {
                                        ?>
                                        <button class="btn btn-primary comment" data-id="<?php echo $_GET['id'] ?>">Comment</button>
                                        <?php
                                    } ?>
                                </div>
                            <?php
                            } else {
                                ?>
                                <div>
                                    <div class="row">
                                        <label for="">Title</label>
                                        <input type="text" class="form-control" id="title">
                                    </div>
                                    <div class="row">
                                        <label for="">Image</label>
                                        <input type="file" id="fileToUpload" name="fileToUpload" value="" accept="image/jpeg,image/jpg,image/png"></td>
                                    </div>
                                    <div class="row m-t-10">
                                        <textarea name="" id="content" cols="30" rows="10" class="form-control"></textarea>
                                        <button class="btn btn-primary save" onclick="savePosting('add_posting')">Save</button>
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

<div class="modal fade" id="modal-add-comment">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title" style="font-weight: bold;font-size: 1.2rem">Add Comment
                    <p style="font-size: 1rem;font-weight: normal" id="route-title"></p>
                </span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body" style="margin: 20px">
                <div class="form-group row">
                    <input type="hidden" id="id_comment_edit">
                    <label for="">Comment</label>
                    <input type="text" class="form-control" id="comment_content">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="submitComment()">Save</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php require_once "../common/footer.php";?>

<script>
    $(function () {
        let isView = '<?php echo isset($_GET['act']) ? $_GET['act'] : ''; ?>'
        console.log(isView)
        if (isView == 'view') {
            $('body').find('#title,#content,#fileToUpload,select,textarea,.save').attr('disabled','disabled')
        }
    })
</script>