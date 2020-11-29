<!-- This file is completed by shijun DENG-40084956 individually -->

<?php
session_start();

// initial ADMIN_ID as 1
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

// functions for auth

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

?>