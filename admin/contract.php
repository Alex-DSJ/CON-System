<!-- This file is completed by shijun DENG-40084956 individually -->

<!-- all required php files here -->
<?php
require_once "../common/header.php";
require_once "../func/func.php";
?>

<!-- all required js files here -->
<script src="../static/functions.js"></script>

<?php
if (checkUserLogin() == false) {
    header("Location:/admin/login.php");
}
$dataList = getContractList();

?>
    <div class="wrapper">

    <?php require_once "navbar.php";?>

        <!-- the main table for the contract tab -->
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="margin-top: 20px">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Contract</h3>
                            </div>

                            <div class="card-body">
                                <div style="margin-bottom: 10px">
                                    <button class="btn btn-primary btn-sm" onclick="addContract()">Add</button>
                                </div>

                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Message</th>
                                        <th>Status</th>
                                        <th>Create time</th>
                                        <th>Option</th>
                                    </tr>
                                    </thead>
                                    <tbody id="group-list">
                                    <?php foreach ($dataList as $item) {
                                        ?>
                                        <tr>
                                            <td><?php echo $item['id'] ?></td>
                                            <td><?php echo $item['title'] ?></td>
                                            <td><?php echo $item['content'] ?></td>
                                            <td><?php echo $item['status'] ?></td>
                                            <td><?php echo $item['create_time'] ?></td>
                                            <td><button class="btn btn-primary edit-contract" data-id="<?php echo $item['id'] ?>" data-status="<?php echo $item['status'] ?>">Edit</button></td>
                                            </tr>
                                        <?php
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- the popup form for adding a contract -->
    <div class="modal fade" id="modal-add-message">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <span class="modal-title" style="font-weight: bold;font-size: 1.2rem">Add Contract
                    <p style="font-size: 1rem;font-weight: normal" id="route-title"></p>
                </span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body" style="margin: 20px">
                    <div class="form-group row">
                        <input type="hidden" id="edit_id">
                        <select name="" id="status" class="form-control">
                            <option value="normal">normal</option>
                            <option value="urgent">urgent</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="updateContract()">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

<?php require_once "../common/footer.php";?>
<script>
    $('body').on('click','.edit-contract',function () {
        let id = $(this).data('id');
        let status = $(this).data('status');
        console.log(status)
        $('#status').val(status)
        $('#edit_id').val(id)
        $('#modal-add-message').modal('show')
    })
</script>
