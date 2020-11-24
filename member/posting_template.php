<?php require_once "../common/header.php";?>

<?php
// check user login 
?>
<div class="wrapper">

    <?php require_once "./nav.php"?>

    <section class="content">
        <div class="container-fluid">

            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Posting</h3>
                        </div>
                        <div class="card-body">
                            
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
                           
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>


<?php require_once "../common/footer.php";?>

