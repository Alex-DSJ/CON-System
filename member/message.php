<?php
require_once "../func/func.php";
if (checkMemberLogin() == false) {
    header("Location:./login.php");
}
$mailList = getMailList();
require_once "../common/header.php";
?>

<!-- This file is completed by kimchhengheng-26809413 individually -->

<!-- all required scripts and external resources here -->
<script src="https://cdn.bootcdn.net/ajax/libs/bootstrap-select/2.0.0-beta1/js/bootstrap-select.js"></script>
<script src="../static/functions.js"></script>
<link href="https://cdn.bootcdn.net/ajax/libs/bootstrap-select/2.0.0-beta1/css/bootstrap-select.min.css" rel="stylesheet">

<div class="wrapper">

    <!-- navbar here -->
    <?php require_once "nav.php";?>

    <!-- the main table of this page -->
    <section class="content">
        <div class="container-fluid">
            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Mail Manage</h3>
                        </div>
                        <div class="card-body">
                            <div style="margin-bottom: 10px">
                                <button class="btn btn-primary btn-sm" onclick="addMessage()">Add</button>
                                <button class="btn btn-primary btn-sm" onclick="window.location.href='inbox.php'">Inbox <i class="fas fa-inbox"></i></button>
                                <button class="btn btn-primary btn-sm" onclick="window.location.href='sentbox.php'">SendBox <i class="fas fa-paper-plane"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- popup form for creating a message -->
<div class="modal fade" id="modal-add-message">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title" style="font-weight: bold;font-size: 1.2rem">Add Message
                    <p style="font-size: 1rem;font-weight: normal" id="route-title"></p>
                </span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body" style="margin: 20px">
                <div class="form-group row">
                    <input type="hidden" id="id_comment_edit">
                    <label for="">Title</label>
                    <input type="text" class="form-control" id="title">
                    <label for="">Message</label>
                    <textarea name="" id="content" cols="30" rows="10" class="form-control"></textarea>
                    <label for="">Receiver</label>
                    <select class="form-control" id="receiver" title="please select receiver" required>
                        <option> </option>
                        <?php
                        foreach ($mailList as $item) {
                            ?>
                            <option value="<?php echo $item['id'].":".$item['email']?>">
                                <?php echo $item['email']?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="submitMessage()">Save</button>
            </div>
        </div>
    </div>
</div>

<?php require_once "../common/footer.php";?>
