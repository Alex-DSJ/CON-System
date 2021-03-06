<?php
require_once "../func/func.php";

if (checkMemberLogin() == false) {
    header("Location:./login.php");
}

$dataList = getSentboxMessage();

require_once "../common/header.php";
?>

<!-- This file is completed by kimchhengheng-26809413 individually -->

<!-- all required js files here -->
<script src="../static/functions.js"></script>

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
                            <h3 class="card-title">SentBox Message</h3>
                        </div>
                        <div class="card-body">
                            <div style="margin-bottom: 10px">
                                <button class="btn btn-primary btn-sm" onclick="window.location.href='inbox.php'">Inbox <i class="fas fa-inbox"></i></button>
                                <button class="btn btn-primary btn-sm" onclick="window.location.href='sentbox.php'">SendBox <i class="fas fa-paper-plane"></i></button>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Message</th>
                                        <th>Receiver</th>
                                        <th>create time</th>
                                    </tr>
                                </thead>
                                <tbody id="group-list">
                                    <?php foreach ($dataList as $item) { ?>
                                    <tr>
                                        <td><?php echo $item['id'] ?></td>
                                        <td><?php echo $item['title'] ?></td>
                                        <td><?php echo $item['content'] ?></td>
                                        <td><?php echo $item['receiver'] ?></td>
                                        <td><?php echo $item['create_time'] ?></td>
                                    </tr>
                                    <?php } ?>
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