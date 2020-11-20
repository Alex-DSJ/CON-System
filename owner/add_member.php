<div class="modal fade" id="modal-add-member">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title" style="font-weight: bold;font-size: 1.2rem">Add Member
                    <p style="font-size: 1rem;font-weight: normal" id="route-title"></p>
                </span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body" style="margin: 20px">
                <div class="form-group row">
                    <label for=""><span style="color: red">*</span>Name</label>
                    <input type="text" class="form-control" id="name">
                    <label for=""><span style="color: red">*</span>Password</label>
                    <input type="password" class="form-control" id="password">
                    <label for=""><span style="color: red">*</span>Address</label>
                    <input type="text" class="form-control" id="address">
                    <label for=""><span style="color: red">*</span>Condos</label>
                    <select name="" id="condos" class="selectpicker form-control" data-live-search="true" multiple title="please select">
                        <?php echo $condoStr; ?>
                    </select>
                    <label for=""><span style="color: red">*</span>Email</label>
                    <input type="email" class="form-control" id="email">
                    <label for="">Family</label>
                    <input type="text" class="form-control" id="family">
                    <label for="">Colleagues</label>
                    <input type="text" class="form-control" id="colleagues">
                    <label for="">Privilege</label>
                    <select name="" id="privilege" class="form-control">
                        <option value="">please select</option>
                        <option value="low">low</option>
                        <option value="normal">normal</option>
                        <option value="high">high</option>
                    </select>
                    <label for="">Status</label>
                    <select name="" id="status" class="form-control" >
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