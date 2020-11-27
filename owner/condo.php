<?php require_once "../common/header.php";?>
<?php
require_once "../func/func.php";
if (checkUserLogin() == false) {
    header("Location:/owner/login.php");
}
$dataList = getCondoList();
$buildingInfo = getBuildingInfo();

?>
<div class="wrapper">

    <?php require_once "./nav.php" ?>
    <?php require_once "./add_condo.php" ?>
    <?php require_once "./edit_condo.php" ?>

    <section class="content">
        <div class="container-fluid">

            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Building Info</h3>
                            <div style="margin-bottom: 10px">
                                <button class="btn btn-primary btn-sm" onclick="addCondo()"><i class="far fa-plus-square"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>Name: <strong><?php echo $buildingInfo['building_name'] ?></strong> </p>
                            <p>Description: <strong><?php echo $buildingInfo['description'] ?></strong></p>
                            <p>Address: <strong><?php echo $buildingInfo['address'] ?></strong> </p>
                            <p>Area: <strong><?php echo $buildingInfo['area'] ?></strong> </p>
                            <p>CreateTime: <strong><?php echo $buildingInfo['create_time'] ?></strong> </p>
                        </div>
                        <div class="card-footer" style="display: none;">
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Condo List</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>name</th>
                                    <th>area</th>
                                    <th>cost</th>
                                    <th>building Name</th>
                                    <th>create time</th>
                                    <th>update time</th>
                                    <th>option</th>
                                </tr>
                                </thead>
                                <tbody id="group-list">
                                <?php foreach ($dataList as $item) {
                                    ?>
                                    <tr>
                                        <td><?php echo $item['id'] ?></td>
                                        <td><?php echo $item['name'] ?></td>
                                        <td><?php echo $item['area'] ?></td>
                                        <td><?php echo $item['cost'] ?></td>
                                        <td><?php echo $item['building_name'] ?></td>
                                        <td><?php echo $item['create_time'] ?></td>
                                        <td><?php echo $item['last_update_time'] ?></td>
                                        <td data-id="<?php echo $item['id'] ?>" data-info="<?php echo rawurlencode(json_encode($item)) ?>">
                                            <button class="btn btn-danger btn-sm" onclick="delCondo($(this))"><i class="fas fa-trash-alt"></button>
                                            <button class="btn btn-warning btn-sm" onclick="editCondo($(this))"><i class="fas fa-edit"></i></button>
                                        </td>
                                    </tr>
                                <?php
                                } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer" style="display: none;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>





<?php require_once "../common/footer.php";?>