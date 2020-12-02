<!-- This file is completed by kimchhengheng-26809413 individually -->
<!-- all required php files here -->
<?php 
    require_once "../common/header.php";
    require_once "../func/posting_func.php";
?>
<!-- all required js files here -->
<script src="../static/functions.js"></script>
<?php
if (checkMemberLogin() == false) {
    header("Location:./login.php");
}
if (isset($_GET['id'])) {
    $info = getPostingInfo($_GET['id']);
} else {
    $info = [];
}
?>
<div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="margin-left:0px;!important;">
        <ul class="navbar-nav" id="my-nav">
            <li class="nav-item"><a class="nav-link" href="#" role="button"><i class="fas fa-bars"></i></a></li>
            <li class="nav-item d-none d-sm-inline-block"><a href="index.php" class="nav-link">Home</a></li>
            <li class="nav-item d-none d-sm-inline-block active"><a href="social.php" class="nav-link">Social</a></li>
            <li class="nav-item d-none d-sm-inline-block"><a href="contract.php" class="nav-link">Contract</a></li>
            <li class="nav-item d-none d-sm-inline-block"><a href="posting.php" class="nav-link">My Posting</a></li>
            <li class="nav-item d-none d-sm-inline-block"><a href="message.php" class="nav-link">Message</a></li>
            <li class="nav-item d-none d-sm-inline-block"><a href="base_info.php" class="nav-link">Base Info</a></li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-sign-out" class="logout" onclick="logout()">logout</i>
                </a>
            </li>
        </ul>
    </nav>
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

