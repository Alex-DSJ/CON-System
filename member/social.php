<?php
require_once "../func/func.php";

if (checkMemberLogin() == false) {
    header("Location:./login.php");
}

$suggestFriendList = getSuggestFriend();
$suggestPostingList = getSuggestPosting();
$suggestGroupList = getSuggestGroup();

require_once "../common/header.php";
?>

<!-- This file is completed by kimchhengheng-26809413 individually -->

<!-- all required js files here -->
<script src="../static/functions.js"></script>
<link href="https://cdn.bootcss.com/bootstrap-select/1.13.10/css/bootstrap-select.min.css" rel="stylesheet">
<script src="https://cdn.bootcss.com/bootstrap-select/1.13.10/js/bootstrap-select.min.js"></script>

<div class="wrapper">

    <!-- navbar here -->
    <?php require_once "nav.php";?>

    <!-- the main table of this page -->
    <section class="content">
        <div class="container-fluid">
            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Search Friend</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group form-inline">
                                <input type="text" class="form-control from-inline" style=" width: 200px" placeholder="search member username" id="friend_keyword">
                                <button class="btn btn-success" onclick="searchFriend()">Search</button>
                            </div>
                            <div>
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>username</th>
                                        <th>email</th>
                                        <th>option</th>
                                    </tr>
                                    </thead>
                                    <tbody id="friend-search-container">
                                    <?php foreach ($suggestFriendList as $item){ ?>
                                        <tr>
                                            <td><?php echo $item['name']; ?></td>
                                            <td><?php echo $item['email']; ?></td>
                                            <td data-id="<?php echo $item['id'] ?>">
                                                <button class="btn btn-primary" onclick="applyFriend($(this))">apply</button>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer" style="display: none;">
                        </div>
                    </div>
                    <div class="card m-t-10">
                        <div class="card-header">
                            <h3 class="card-title">Search Postings</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group form-inline">
                                <input type="text" class="form-control from-inline" style="width: 250px" placeholder="search posting title/content" id="posting_keyword">
                                <button class="btn btn-success btn-sm" onclick="searchPosting()">Search</button>
                            </div>
                            <div>
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>title</th>
                                        <th>author</th>
                                        <th>create_time</th>
                                        <th>option</th>
                                    </tr>
                                    </thead>
                                    <tbody id="posting-search-container">
                                    <?php foreach ($suggestPostingList as $item){ ?>
                                        <tr>
                                            <td><?php echo $item['id']; ?></td>
                                            <td><?php echo $item['title']; ?></td>
                                            <td><?php echo $item['name']; ?></td>
                                            <td><?php echo $item['create_time']; ?></td>
                                            <td data-id="<?php echo $item['id'] ?>">
                                                <button class="btn btn-primary btn-sm" onclick="detailPosting($(this))">detail</button>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer" style="display: none;">
                        </div>
                    </div>
                    <div class="card m-t-10">
                        <div class="card-header">
                            <h3 class="card-title">Search Groups</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group form-inline">
                                <input type="text" class="form-control from-inline" style="width: 250px" placeholder="search group name" id="group_keyword">
                                <button class="btn btn-success btn-sm" onclick="searchGroup()">Search</button>
                            </div>
                            <div>
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>name</th>
                                        <th>description</th>
                                        <th>option</th>
                                    </tr>
                                    </thead>
                                    <tbody id="group-search-container">
                                    <?php foreach ($suggestGroupList as $item){ ?>
                                        <tr>
                                            <td><?php echo $item['group_name']; ?></td>
                                            <td><?php echo $item['description']; ?></td>
                                            <td data-id="<?php echo $item['id'] ?>">
                                                <button class="btn btn-primary" onclick="applyGroup($(this))">apply</button>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
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