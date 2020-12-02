<?php

// --------********--------********--------********--------********--------********
// Functions for the SUPER ADMIN starts here
// author: Shijun Deng (40084956)
// --------********--------********--------********--------********--------********

session_start();

require_once dirname(__FILE__).'./db.php';
require_once "dbQuerry.php";

define('ADMIN_ID', '1');

// check if a user has logged in
function checkUserLogin() {
    if (!isset($_SESSION['uid'])) {
        return false;
    }
    return true;
}

// get login info from SESSION
function getLogin() {
    return [
        'uid' => isset($_SESSION['uid']) ? $_SESSION['uid'] : 0 ,
        'bid' => isset($_SESSION['bid']) ? $_SESSION['bid'] : 0 ,
        'mid' => isset($_SESSION['mid']) ? $_SESSION['mid'] : 0 ,
    ];
}

// clear sensitive sessions for the user
function clearLogin() {
    $_SESSION['uid'] = null;
    $_SESSION['bid'] = null;
    $_SESSION['mid'] = null;
    unset($_SESSION['uid']);
    unset($_SESSION['mid']);
    unset($_SESSION['bid']);
}

// get the compare the username and password with databse
// act accordingly with the result
function loginHandler($inputs = []) {
    $username = $inputs['username'];
    $password = $inputs['password'];
    $sql = 'SELECT * FROM `admin` WHERE name = ? AND password = ?';
    $res = getOne($sql, [$username, $password]);
    $buildingRes = getOne("SELECT * FROM `admin_building` WHERE admin_id =?", [$res['id']]);
    if (!$res) {
        formatOutput(false, 'username or password error');
    } else {
        $bid = isset($buildingRes['building_id']) ? $buildingRes['building_id'] : '0';
        setLogin($res['id'],$bid);
        formatOutput(true, 'login success', $res);
    }
}

// ask the super admin to change the information for the first login
function resetHandler($inputs = []) {
    if (getLogin()['uid'] !== ADMIN_ID) {
        formatOutput(false, 'Authority error');
    } else {
        $username = $inputs['username'];
        $password = $inputs['password'];
        if ($username == 'admin' || $inputs['password'] == 'admin') {
            formatOutput(false, 'Initial information must be changed after the first login');
        } else {
            $res = updateDb('admin',[
                'name' => $username,
                'password' => $password,
                'is_first_login' => 1
            ], [
                'id' => ADMIN_ID
            ]);
            formatOutput(true, 'update success', $res);
        }
    }
}

// invoke clearLogin() to clear the all sensitive sessions for the user
// and logout
function logoutHandler() {
    clearLogin();
    formatOutput(true, 'logout success');
}

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

//get all buildings' name and return
function getBuildingList() {
    return getAll("SELECT * FROM building");
}

// add a new building to the database
function addBuildingHandler() {
    global $inputs;
    $adminId = insert('building',[
        'building_name' => $inputs['name'],
        'address' => $inputs['address'],
        'description' => $inputs['desc'],
        'area' => $inputs['area'],
    ]);
    formatOutput(true, 'add success');
}

// update a building to the database
function editBuildingHandler() {
    global $inputs;
    $res = updateDb('building', [
        'building_name' => $inputs['name'], 
        'address' => $inputs['address'],
        'description' => $inputs['desc'],
        'area' => $inputs['area']],
        ['id' => $inputs['id']]);
    formatOutput(true, 'update success', $res);
}

// delete a building from the databse
function delBuildingHandler() {
    global $inputs;
    $sql = "DELETE FROM building WHERE id = " . $inputs['id'];
    execSql($sql);
    formatOutput(true, 'delete success');
}

// obtain the detail of a building
function getBuildingInfo() {
    return getOne("SELECT * FROM building WHERE id = ?",[getLogin()['bid']]);
}

// get all contract from the database
function getContractList() {
    $sql = <<<sql
            SELECT * FROM contract ORDER BY id DESC
            sql;
    return getAll($sql);
}

// update a contract to the database
function updateContractHandler() {
    global $inputs;
    $res = updateDb('contract',
                    ['status' => $inputs['status'],],
                    ['id' => $inputs['id']]);
    formatOutput(true, 'update success', $res);
}

// add a new contract to the database
function addContractHandler() {
    global $inputs;

    $cid = insert('contract',[
        'title' => $inputs['title'],
        'content' => $inputs['content'],
        'status' => $inputs['status'],
    ]);

    $loginInfo = getLogin();
    if (isset($loginInfo['uid']) && $loginInfo['uid'] ) {
        $userType = 'admin';
        $uid = $loginInfo['uid'];
    } else {
        $userType = 'member';
        $uid = $loginInfo['mid'];
    }

    insert('user_contract',[
        'user_type' => $userType,
        'uid' => $uid,
        'contract_id' => $cid,
    ]);

    formatOutput(true, 'add success');
}

// --------********--------********--------********--------********--------********
// Functions for the SUPER ADMIN ends here
// author: Shijun Deng (40084956)
// --------********--------********--------********--------********--------********

?>