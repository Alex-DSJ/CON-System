<!-- This file is completed by Yuxin Wang-40024855 individually -->
<!-- all required php files here -->
<?php require_once "../common/header.php";?>
<!-- all required js files here -->
<script src="../static/functions.js"></script>
<div class="wrapper" style="margin-top: 5%">
    <section class="content">
        <div class="container-fluid">
            <div class="row m-auto">
                <div class="m-auto">
                    <div class="card">
                        <div class="card-body ">
                            <p class="login-box-msg">Login:-)</p>

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
                                        <button type="button" class="btn btn-primary btn-block" onclick="member_login()">Login <i class="fas fa-sign-in-alt"></i></button>
                                        <button type="button" class="btn btn-primary btn-block" onclick="window.location.href='../main.php'">Return Index <i class="fas fa-arrow-left"></i></button>
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
