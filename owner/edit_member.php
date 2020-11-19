<div class="modal fade" id="modal-edit-member">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title" style="font-weight: bold;font-size: 1.2rem">Edit Admin
                    <p style="font-size: 1rem;font-weight: normal" id="route-title"></p>
                </span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body" style="margin: 20px">
                <div class="form-group row">
                    <input type="hidden" id="id_edit">
                    <label for=""><span style="color: red">*</span>Name</label>
                    <input type="text" class="form-control" id="name_edit">
                    <label for=""><span style="color: red">*</span>Password</label>
                    <input type="password" class="form-control" id="password_edit">
                    <label for=""><span style="color: red">*</span>Address</label>
                    <input type="text" class="form-control" id="address_edit">
                    <label for=""><span style="color: red">*</span>Condos</label>
                    <select name="" id="condos_edit" class="selectpicker form-control" data-live-search="true" multiple title="please select">
                        <?php echo $condoStr; ?>
                    </select>
                    <label for=""><span style="color: red">*</span>Email</label>
                    <input type="email" class="form-control" id="email_edit">
                    <label for="">Family</label>
                    <input type="text" class="form-control" id="family_edit">
                    <label for="">Colleagues</label>
                    <input type="text" class="form-control" id="colleagues_edit">
                    <label for="">Privilege</label>
                    <select name="" id="privilege_edit" class="form-control">
                        <option value="">please select</option>
                        <option value="low">low</option>
                        <option value="normal">normal</option>
                        <option value="high">high</option>
                    </select>
                    <label for="">Status</label>
                    <select name="" id="status_edit" class="form-control" >
                        <option value="">please select</option>
                        <option value="active">active</option>
                        <option value="inactive">inactive</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Save</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>