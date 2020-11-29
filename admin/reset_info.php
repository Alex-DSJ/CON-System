<?php require_once "../common/header.php";?>
<?php
    require_once "../func/func.php";
    if (checkUserLogin() == false || getLogin()['uid'] !== ADMIN_ID) {
        header("Location:/admin/login.php");
    }
?>
<div class="wrapper" style="margin-top: 5%">
    <section class="content">
        <div class="container-fluid">
            <div class="row m-auto">
                <div class="m-auto">
                    <div class="card">
                        <div class="card-body ">
                            <p class="login-box-msg">RESET LOGIN INFO:-)</p>

                            <div action="" method="post">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Username" required autocomplete="false" name="username" id="username">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" placeholder="Password" required autocomplete="false" name="password" id="password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-primary btn-block" onclick="resetLoginInfo()">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php require_once "../common/footer.php";?>
