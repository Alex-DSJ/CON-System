<?php require_once "../common/header.php";?>
<?php
// To Do check if member login 
// if (checkMemberLogin() == false) {
    // header("Location:./login.php");
// }


?>
<div class="wrapper">

    <?php require_once "./nav.php"?>

    <section class="content">
        <div class="container-fluid">

            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Base Info</h3>
                        </div>
                        <!-- to display the information of the member after -->
                        <!-- <div class="card-body">
                            <p>#:    <strong><?php echo $info['id'] ?></strong></p>
                            <p>name:    <strong><?php echo $info['name'] ?></strong></p>
                            <p>address: <strong><?php echo $info['address'] ?></strong></p>
                            <p>email:   <strong><?php echo $info['email'] ?></strong></p>
                            <p>privilege:   <strong><?php echo $info['privilege'] ?></strong></p>
                            <p>status:  <strong><?php echo $info['status'] ?></strong></p>
                        </div> -->
                    </div>
                    

                </div>
            </div>
        </div>
    </section>
</div>

<?php require_once "../common/footer.php";?>
