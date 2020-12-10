<?php require_once "./common/header.php";?>
<div class="wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row m-auto">
                <div class="m-auto">
                    <div class="card" style="margin-top: 30%">
                        <div class="card-body ">
                            <button class="btn btn-primary" onclick="window.location.href='./admin/login.php'">Super Admin</button>
                            <br>
                            <button class="btn btn-primary" onclick="window.location.href='./owner/index.php'" style="margin-top: 5px">Admin</button>
                            <br>
                            <button class="btn btn-primary" onclick="window.location.href='./member/index.php'" style="margin-top: 5px">Member</button>
                            <br>
                            <button class="btn btn-primary" style="margin-top: 5px" onclick="window.location.href='./guest.php'">Guest</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php require_once "./common/footer.php";?>
