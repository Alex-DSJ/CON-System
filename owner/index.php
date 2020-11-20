<?php require_once "../common/header.php";?>
<link href="https://cdn.bootcss.com/bootstrap-select/1.13.10/css/bootstrap-select.min.css" rel="stylesheet">
<script src="https://cdn.bootcss.com/bootstrap-select/1.13.10/js/bootstrap-select.min.js"></script>
<script src="../static/auth.js"></script>

<div class="wrapper">

    <?php require_once "./nav.php" ?>
    <?php require_once "./add_member.php" ?>
    <?php require_once "./edit_member.php" ?>

    <section class="content">
        <div class="container-fluid">

            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Member List</h3>
                        </div>
                        <div class="card-body">

                            <div style="margin-bottom: 10px">
                                <button class="btn btn-primary btn-sm"><i class="far fa-plus-square"></i></button>
                            </div>

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>name</th>
                                    <th>address</th>
                                    <th>email</th>
                                    <th>groups</th>
                                    <th>condos</th>
                                    <th>family</th>
                                    <th>colleagues</th>
                                    <th>privilege</th>
                                    <th>status</th>
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
                                        <td><?php echo $item['address'] ?></td>
                                        <td><?php echo $item['email'] ?></td>
                                        <td><button class="btn btn-dark show-condos" data-id="<?php echo $item['id'] ?>">condos</button></td>
                                        <td><button class="btn btn-dark show-groups" data-id="<?php echo $item['id'] ?>">groups</button></td>
                                        <td><?php echo $item['family'] ?></td>
                                        <td><?php echo $item['colleagues'] ?></td>
                                        <td><?php echo $item['privilege'] ?></td>
                                        <td><?php echo $item['status'] ?></td>
                                        <td><?php echo $item['create_time'] ?></td>
                                        <td><?php echo $item['last_update_time'] ?></td>
                                        <td data-id="<?php echo $item['id'] ?>" data-info="<?php echo rawurlencode(json_encode($item)) ?>">
                                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></button>
                                            <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></button>
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






<div class="modal fade" id="modal-condos">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title" style="font-weight: bold;font-size: 1.2rem">Detail
                    <p style="font-size: 1rem;font-weight: normal" id="route-title"></p>
                </span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body" style="margin: 20px">
                <div class="form-group row">
                    <table class="table table-hover" id="condos-contanier">

                    </table>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php require_once "../common/footer.php";?>
<script>
    $(function () {
        $('.selectpicker').selectpicker()
    })
</script>