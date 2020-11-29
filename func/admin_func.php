<!-- This file is completed by shijun DENG-40084956 individually -->

<!-- all required php files here -->
<?php
require_once dirname(__FILE__).'./db.php';
require_once "../func/dbQuerry.php";

function setLogin($uid = 0, $bid = 0) {
    $_SESSION['uid'] = $uid;
    $_SESSION['bid'] = $bid;
}

// add an admin to the database
// check the username incase of dulplicate
function addAdminHandler() {
    global $inputs;

    if (getOne("SELECT count(1) FROM admin WHERE name = ?",[$inputs['admin_username']]) > 1) {
        formatOutput(false, 'username repeat');
    }

    $adminId = insert('admin',[
        'name' => $inputs['admin_username'],
        'password' => $inputs['admin_password'],
    ]);
    insert('admin_building', [
       'admin_id' => $adminId,
       'building_id' => $inputs['admin_building'],
    ]);

    formatOutput(true, 'add success');
}

// delete a certain admin from the database
function delAdminHandler() {
    global $inputs;
    $sql = "DELETE FROM admin WHERE id = " . $inputs['id'];
    execSql($sql);
    formatOutput(true, 'delete success');
}

// update the info of an admin to the database
function editAdminHandler() {
    global $inputs;
    updateDb('admin',[
        'name' => $inputs['admin_username'],
        'password' => $inputs['admin_password'],
    ], [
        'id' => $inputs['id']
    ]);
    updateDb('admin_building',[
        'building_id' => $inputs['admin_building'],
    ], [
        'admin_id' => $inputs['id']
    ]);
    formatOutput(true, 'update success');

}

// get all admins from the database
function getAdminList() {
    $sql = "SELECT a.*,
            IFNULL(c.building_name,'-') AS building_name,
            IFNULL(b.building_id,'0') AS building_id
            FROM admin a
            LEFT JOIN admin_building b ON a.id = b.admin_id 
            LEFT JOIN building c ON c.id = b.building_id
            WHERE a.id != 1";
    return getAll($sql);
}