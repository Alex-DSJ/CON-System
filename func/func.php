<?php

// --------********--------********--------********--------********--------********
// Functions for the SUPER ADMIN starts here
// author: Shijun Deng (40084956)
// --------********--------********--------********--------********--------********

session_start();

require_once dirname(__FILE__).'./db.php';
require_once dirname(__FILE__)."/dbQuerry.php";

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
    $sql = "sql
            SELECT * FROM contract ORDER BY id DESC
            sql";
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

// --------********--------********--------********--------********--------********
// Functions for the OWNER/ADMIN starts here
// author: saebom SHIN (40054234)
// --------********--------********--------********--------********--------********

function getCondoList()
{
    $sql = "select a.*,c.building_name from condo a 
left join condo_building b on a.id = b.condo_id
left join building c on c.id = b.building_id
where b.building_id = ?";
    return getAll($sql, [getLogin()['bid']]);
}

function getGroupList()
{
    return getAll("select * from `group` where admin_id = ?", [getLogin()['uid']]);
}

function getGroupApplyList()
{
    return getAll("select 
b.name as member_name ,c.group_name,a.create_time,a.id,ifnull(a.handle_time,'-')  as handle_time,a.status
from `member_group_apply` a 
inner join member b on a.member_id = b.id
inner join `group` c on a.group_id = c.id
where c.admin_id = ?
", [getLogin()['uid']]);
}

function getPostingAll()
{
    return getAll("select b.* from member_posting a inner join posting b on a.posting_id = b.id ");
}
// --------********--------********--------********--------********--------********
// Functions for the OWNER/ADMIN ends here
// author: saebom SHIN (40054234)
// --------********--------********--------********--------********--------********

// --------********--------********--------********--------********--------********
// Functions for the Member ends here
// author:
// --------********--------********--------********--------********--------********
function checkMemberLogin()
{
    if (!isset($_SESSION['mid'])) {
        return false;
    }
    return true;
}

function getMemberList()
{
    return getAll("select * from member ");
}


function editMemberHandler()
{
    global $inputs;

    $sql = "delete from `member_condo` where member_id = " . $inputs['id'];
    execSql($sql);

    foreach ($inputs['condos'] as $condoId) {
        insert('member_condo', [
            'member_id' => $inputs['id'],
            'condo_id' => $condoId
        ]);
    }

    updateDb('member',[
        'name' => $inputs['name'],
        'password' => $inputs['password'],
        'address' => $inputs['address'],
        'email' => $inputs['email'],
        'family' => $inputs['family'],
        'colleagues' => $inputs['colleagues'],
        'privilege' => $inputs['privilege'],
        'status' => $inputs['status'],
    ],[
        'id' => $inputs['id']
    ]);
    formatOutput(true, 'update success');

}

function delMemberHandler()
{
    global $inputs;
    $sql = "delete from `member` where id = " . $inputs['id'];
    execSql($sql);
    formatOutput(true, 'delete success');
}

function addMemberHandler()
{
    global $inputs;

    $condos = $inputs['condos'];

    $lastId = insert('member', [
        'name' => $inputs['name'],
        'password' => $inputs['password'],
        'address' => $inputs['address'],
        'email' => $inputs['email'],
        'family' => $inputs['family'],
        'colleagues' => $inputs['colleagues'],
        'privilege' => $inputs['privilege'],
        'status' => $inputs['status'],
    ]);

    foreach ($condos as $condoId) {
        insert('member_condo', [
            'member_id' => $lastId,
            'condo_id' => $condoId
        ]);
    }

    formatOutput(true, 'add success');
}


function getMemberGroupList()
{
    return getAll("select b.group_name,b.id from member_group a inner join `group` b on a.group_id = b.id where a.member_id =?", [getLogin()['mid']]);
}

function getMailList()
{
    return getAll("select id,`email` from `member` where id != ?", [getLogin()['mid']]);

}

function getInboxMessage()
{
    $sql = "select * from `mail` where receiver_id = ?";
    // to change with member id
    return getAll($sql, 2);
}

function getSentboxMessage()
{
    $sql = "select * from `mail` where sender_id = ?";
    // to change with member id
    return getAll($sql, 2);
}

function getPostingList()
{
    // dynamic member id after [getLogin()['mid']]
    return getAll("select b.* from member_posting a inner join posting b on a.posting_id = b.id  where a.member_id = ?", [3]);
}

function getPostingInfo($id = 0)
{
    // dynamic posting id after
    return getOne("select b.* from member_posting a inner join posting b on a.posting_id = b.id  where a.posting_id = ?", [7]);
}


function delPostingHandler()
{
    global $inputs;
    $sql = "delete from `posting` where id = " . 7;
    execSql($sql);
    formatOutput(true, 'delete success');
}

function addPostingHandler()
{
    global $inputs;

    $src = uploadFile();

    $lastId = insert('posting',[
        'pic' => $src,
        'title' => $inputs['title'],
        'content' => $inputs['content'],
    ]);

    insert('member_posting', [
        'posting_id' => $lastId,
        'member_id' => getLogin()['mid']
    ]);

    formatOutput(true, 'add success',$lastId);
}

function editPostingHandler()
{
    global $inputs;

    if (!empty($_FILES) && $_FILES['fileToUpload']['name']) {
        $src = uploadFile();
        $lastId = updateDb('posting',[
            'pic' => $src,
            'title' => $inputs['title'],
            'content' => 3
        ], [
            "id" => $inputs['id']
        ]);
    } else {
        $lastId = updateDb('posting',[
            'title' => $inputs['title'],
            'content' => $inputs['content'],
        ], [
            "id" => $inputs['id']
        ]);
    }

    formatOutput(true, 'update success',$inputs['id']);
}
function uploadFile()
{
    if (!empty($_FILES) && $_FILES['fileToUpload']['name']) {

        $baseDir = dirname(dirname(__FILE__)).'/static/upload/';

        $date = date ('Ymdhis').getLogin()['mid'];
        $fileName = $_FILES['fileToUpload']['name'];
        $name = explode('.',$fileName);
        $newFileName = $date.'.'.$name[1];
        $newPath = $baseDir . $newFileName;

        $filename = iconv('UTF-8','gbk',basename($_FILES['fileToUpload']['name']));
        $oldPath = $baseDir.$filename;

        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'],$oldPath)){
            rename($oldPath,$newPath);
            return $newFileName;
        }
    }
    return 'default/demo-default.jpg';
}


function getSuggestFriend()
{
    return getAll("select a.name,a.email from member a 
where a.id != ? and a.id not in (select apply_member_id from member_friend_apply where status = 0)
limit 5",
        [getLogin()['mid']]
    );
}
function getSuggestPosting()
{
    return getAll("select a.*,c.name from posting a 
inner join member_posting b on a.id = b.posting_id
inner join member c on c.id = b.member_id
limit 5");
}


function friendSearchHandler()
{
    global $inputs;
    $keyword = $inputs['keyword'];
    $res = getAll("select a.name,a.email from member a 
where a.name like '%$keyword%' and a.id not in (select apply_member_id from member_friend_apply where status = 0)"
    );
    formatOutput(true, 'success',$res);
}

function postingSearchHandler()
{
    global $inputs;
    $keyword = $inputs['keyword'];
    $res = getAll("select a.*,c.name from posting a 
inner join member_posting b on a.id = b.posting_id
inner join member c on c.id = b.member_id where a.title like '%$keyword%' or a.content like '%$keyword%'");
    formatOutput(true, 'success',$res);
}

function groupSearchHandler()
{
    global $inputs;
    $keyword = $inputs['keyword'];
    $res = getAll("select * from `group` where group_name like '%$keyword%' or description like '%$keyword%'");
    formatOutput(true, 'success',$res);
}

// --------********--------********--------********--------********--------********
// Functions for the Member ends here
// author:
// --------********--------********--------********--------********--------********
?>