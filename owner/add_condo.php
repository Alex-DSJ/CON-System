<div class="modal fade" id="modal-add-condo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title" style="font-weight: bold;font-size: 1.2rem">Add Condo
                    <p style="font-size: 1rem;font-weight: normal" id="route-title"><?php echo $buildingInfo['building_name'] ?></strong></p>
                </span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body" style="margin: 20px">
                <div class="form-group row">
                    <label for="">Condo Name</label>
                    <input type="text" class="form-control" id="name">
                    <label for="">Condo Area/m²</label>
                    <input type="number" class="form-control" id="area">
                    <label for="">Property Costs/m²</label>
                    <input type="number" class="form-control" id="cost">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="submitCondo()">Save</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>