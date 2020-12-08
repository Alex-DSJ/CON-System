<?php
require_once "../func/func.php";

if (checkUserLogin() == false) {
    header("Location:/login.php");
}
$contractList = getContractList();  //get all contracts from the database
$userContractRelList = getContractRelList();    //get all user_contract relations from the database
$adminList = getAllAdmins();
$memberList = getMemberList();

$nameOptions = '<optgroup label="Admin">';
foreach ($adminList as $admin) {
    if($admin['id'] != 1){
        $nameOptions .= "<option value='{$admin['id']}'>{$admin['name']}</option>";
    }
}
$nameOptions .= '</optgroup><optgroup label="Member">';
foreach ($memberList as $member) {
    $nameOptions .= "<option value='{$member['id']}'>{$member['name']}</option>";
}
$nameOptions .= '</optgroup>';
?>

<!-- This file is completed by shijun DENG-40084956 individually -->

<!-- all required php files here -->
<?php require_once "../common/header.php"; ?>

<!-- all required js files here -->
<script src="../static/functions.js"></script>


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
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Message</th>
                                        <th>Status</th>
                                        <th>Creator Name</th>
                                        <th>Creator Role</th>
                                        <th>Option</th>
                                    </tr>
                                    </thead>
                                    <tbody id="group-list">
                                    <?php foreach ($contractList as $contract) {
                                        // get the creator role and id
                                        $userRole = '';
                                        $userName = '';
                                        foreach ($userContractRelList as $userContractRel) {
                                            if ($userContractRel['contract_id'] == $contract['id']) {
                                                $userRole = $userContractRel['user_type'];
                                                $userID = $userContractRel['uid'];
                                                // get the creator name
                                                if ($userRole == 'Admin' || $userRole == 'Super Admin') {
                                                    foreach ($adminList as $admin) {
                                                        if ($admin['id'] == $userID) {
                                                            $userName = $admin['name'];
                                                        }
                                                    }
                                                }
                                                else {
                                                    foreach ($memberList as $member) {
                                                        if ($member['id'] == $userID) {
                                                            $userName = $member['name'];
                                                        }
                                                    }
                                                }
                                            }
                                        }

                                        
                                        ?>
                                        <tr>
                                            <td><?php echo $contract['id'] ?></td>
                                            <td><?php echo $contract['title'] ?></td>
                                            <td><?php echo $contract['content'] ?></td>
                                            <td><?php echo $contract['status'] ?></td>
                                            <td><?php echo $userName ?></td>
                                            <td><?php echo $userRole ?></td>
                                            <td data-id="<?php echo $contract['id'] ?>" data-info="<?php echo rawurlencode(json_encode($contract)) ?>">
                                                <button class="btn btn-danger btn-sm" onclick="delContract($(this))">Del</button>
                                                <button class="btn btn-warning btn-sm"  onclick="editContractBySA($(this))">Edit</button>
                                            </td>
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
    <div class="modal fade" id="modal-add-contract">
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
                        <label for="">Title</label>
                        <input type="text" class="form-control"  id="title">
                        <label for="">Content</label>
                        <textarea class="form-control" rows="5" aria-label="With textarea" id="content"></textarea>
                        <label for="">Status</label>
                        <select name="" id="status" class="form-control">
                            <option value="normal">Normal</option>
                            <option value="urgent">Urgent</option>
                        </select>
                        <label for="">Created For</label>
                        <select name="" id="creator" class="form-control">
                            <option value="" disabled selected>Please Select</option>
                            <optgroup label="Super Admin">
                                <option value="1">admin</option>
                            </optgroup>
                            <?php echo $nameOptions; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="submitContractBySA()">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- the popup form for updating a contract -->
    <div class="modal fade" id="modal-edit-contract">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <span class="modal-title" style="font-weight: bold;font-size: 1.2rem">Edit Contract
                    <p style="font-size: 1rem;font-weight: normal" id="route-title"></p>
                </span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body" style="margin: 20px">
                <div class="form-group row">
                        <label for="" id="id_edit"></label>
                        <label for="">Title</label>
                        <input type="text" class="form-control"  id="title_edit">
                        <label for="">Content</label>
                        <textarea class="form-control" rows="5" aria-label="With textarea" id="content_edit"></textarea>
                        <label for="">Status</label>
                        <select name="" id="status_edit" class="form-control">
                            <option value="normal">Normal</option>
                            <option value="urgent">Urgent</option>
                        </select>
                        <label for="">Created For</label>
                        <select name="" id="creator_edit" class="form-control">
                            <option value="" disabled selected>Please Select</option>
                            <optgroup label="Super Admin">
                                <option value="1">admin</option>
                            </optgroup>
                            <?php echo $nameOptions; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="updateContractBySA()">Save</button>
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
