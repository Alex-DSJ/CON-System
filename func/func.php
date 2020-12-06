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

// delete a building from the database
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
// --------********--------********--------********--------********--------********
// Functions for the SUPER ADMIN ends here
// author: Shijun Deng (40084956)
// --------********--------********--------********--------********--------********

// --------********--------********--------********--------********--------********
// Functions for the Contract page start here
// author: Shijun Deng (40084956)
// --------********--------********--------********--------********--------********

//contract both admin and member
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
    $res = updateDb('contract',[
        'status' => $inputs['status'],
        'title' => $inputs['title'],
        'content' => $inputs['content'],
    ], [
        'id' => $inputs['id']
    ]);
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

// get contract created by the member
function getMemberContractList()
{
    $sql = "select  b.* 
            from user_contract a inner join contract b on a.contract_id = b.id 
            where a.user_type = 'member' and a.uid = ? 
            order by b.id desc";
    return getAll($sql, [getLogin()['mid']]);
}

// delete the contract
function delContractHandler()
{
    global $inputs;
    $sql = "delete from contract where id = " . $inputs['id'];
    execSql($sql);
    formatOutput(true, 'delete success');
}

// --------********--------********--------********--------********--------********
// Functions for the Contract page ends here
// author: Shijun Deng (40084956)
// --------********--------********--------********--------********--------********


// --------********--------********--------********--------********--------********
// Functions for the OWNER/ADMIN starts here
// author: saebom SHIN (40054234)
// --------********--------********--------********--------********--------********

// get all memberlist from the database
function getMemberList()
{
    return getAll("select * from member ");
}

// get all condo list from the database
function getCondoList()
{
    $sql = "select a.*,c.building_name from condo a 
left join condo_building b on a.id = b.condo_id
left join building c on c.id = b.building_id
where b.building_id = ?";
    return getAll($sql, [getLogin()['bid']]);
}

// update the info of condo to the database
function editCondoHandler()
{
    global $inputs;
    updateDb('condo',[
        'name' => $inputs['name'],
        'area' => $inputs['area'],
        'cost' => $inputs['cost'],
    ], [
        'id' => $inputs['id']
    ]);
    formatOutput(true, 'update success');
}

// delete a condo from the database
function delCondoHandler()
{
    global $inputs;
    $sql = "delete from condo where id = " . $inputs['id'];
    execSql($sql);
    formatOutput(true, 'delete success');
}

// add a new condo to the dataase
function addCondoHandler()
{
    global $inputs;

    $lastId = insert('condo',[
        'name' => $inputs['name'],
        'area' => $inputs['area'],
        'cost' => $inputs['cost'],
    ]);
    insert('condo_building', [
        'condo_id' => $lastId,
        'building_id' => getLogin()['bid'],
    ]);

    formatOutput(true, 'add success');
}

// --------********--------********--------********--------********--------********
// Functions for the OWNER/ADMIN ends here
// author: saebom SHIN (40054234)
// --------********--------********--------********--------********--------********


// --------********--------********--------********--------********--------********
// Functions for the GROUP starts here
// author: saebom SHIN(40054234)
// --------********--------********--------********--------********--------********

// get all group list from the database
function getGroupList()
{
    return getAll("select * from `group` where admin_id = ?", [getLogin()['uid']]);
}

// get all group apply list from the database
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

// 
function groupApplyHandler()
{
    global $inputs;
    updateDb('member_group_apply',[
        'status' => $inputs['type'],
        'handle_time' => date('Y-m-d H:i:s'),
    ], [
        'id' => $inputs['id']
    ]);

    $info = getOne("select * from member_group_apply where id = ?", [$inputs['id']]);

    insert('member_group',[
        'member_id' => $info['member_id'],
        'group_id' => $info['group_id']
    ]);

    formatOutput(true, 'update success');
}

// update the info of group to the database
function editGroupHandler()
{
    global $inputs;
    updateDb('group',[
        'group_name' => $inputs['name'],
        'description' => $inputs['desc'],
    ], [
        'id' => $inputs['id'],
        'admin_id' => getLogin()['uid']
    ]);
    formatOutput(true, 'update success');
}

// delete the info of group from the database
function delGroupHandler()
{
    global $inputs;
    $sql = "delete from `group` where id = " . $inputs['id'];
    execSql($sql);
    formatOutput(true, 'delete success');
}

// add the info of group to the database
function addGroupHandler()
{
    global $inputs;

    $lastId = insert('group',[
        'admin_id' => getLogin()['uid'],
        'group_name' => $inputs['name'],
        'description' => $inputs['desc'],
    ]);

    formatOutput(true, 'add success');
}

// --------********--------********--------********--------********--------********
// Functions for the GROUP ends here
// author: saebom SHIN(40054234)
// --------********--------********--------********--------********--------********

// --------********--------********--------********--------********--------********
// Functions for the MEMBER starts here
// author: kimchhengheng(26809413) / saebom SHIN(40054234)
// --------********--------********--------********--------********--------********

// check the session of the member id is set or not
function checkMemberLogin()
{
    if (!isset($_SESSION['mid'])) {
        return false;
    }
    return true;
}

// handle the login of the member
function memberLoginHandler()
{
    global $inputs;
    $username = $inputs['username'];
    $password = $inputs['password'];
    $sql = 'select * from `member` where name = ? and password = ?';
    $res = getOne($sql, [$username, $password]);
    if (!$res) {
        formatOutput(false, 'username or password error');
    } else {
        setMemberLogin($res['id']);
        formatOutput(true, 'login success', $res);
    }
}
// set the session of the mid to the current login member id
function setMemberLogin($uid)
{
    $_SESSION['mid'] = $uid;
}
// get full information of the member by using their id
function getMemberInfo($id = 0)
{
    if ($id == 0) {
        $id = getLogin()['mid'];
    }
    return getOne("select * from member where id = ?", [$id]);
}
// get the information of condo who own by the logged member
function getMemberCondoInfo()
{
    return getAll("select b.name,b.area,b.cost 
                        from member_condo a 
                        inner join condo b on a.condo_id = b.id
                        where a.member_id = ?",
        [getLogin()['mid']]);
}
function memberCondosHandler()
{
    global $inputs;
    $res = getAll('select a.*,b.name from member_condo a inner join condo b on a.condo_id = b.id where a.member_id = ?', [$inputs['id']]);
    formatOutput(true, 'success', $res);
}
// get the group that the logged member be part of
function getMemberGroupInfo()
{
    global $inputs;
    if (empty($inputs)) {
        $mid = getLogin()['mid'];
    } else {
        $mid = $inputs['id'];
    }
    $res = getAll("select b.*,a.id as union_id 
                       from member_group a inner join `group` b on a.group_id = b.id 
                       where a.member_id = ?", [$mid]);
    if (empty($inputs)) {
        return $res;
    } else {
        formatOutput(true, 'success', $res);
    }
}




// member (owner)
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

    $lastId = insert('member',[
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

// --------********--------********--------********--------********--------********
// Functions for the MEMBER ends here
// author: kimchhengheng(26809413) / saebom SHIN(40054234)
// --------********--------********--------********--------********--------********

// --------********--------********--------********--------********--------********
// Functions for the POSTING starts here
// author: kimchhengheng(26809413) / saebom SHIN(40054234)
// --------********--------********--------********--------********--------********
// get all the posting by the logged member
function getPostingList()
{
    return getAll("select b.* 
                        from member_posting a inner join posting b on a.posting_id = b.id  
                        where a.member_id = ?"
        , [getLogin()['mid']]);
}
// get detail information of the posting by the specific id
function getPostingInfo($id = 0)
{
    return getOne("select b.* 
                        from member_posting a inner join posting b on a.posting_id = b.id  
                        where a.posting_id = ?"
        , [$id]);
}
// get all the posting which have status public
function getPublicPost(){
    return getAll("select * 
                        from posting 
                        where status= 'public'");
}
//
function getPostingAll()
{
    return getAll("select b.* from member_posting a inner join posting b on a.posting_id = b.id ");
}
// handle the delete post by specific id
function delPostingHandler()
{
    global $inputs;
    $sql = "delete from `posting` where id = " . $inputs['id'];
    execSql($sql);
    formatOutput(true, 'delete success');
}
// add new row to the posting table, member posting(will keep track who post the posting)
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
// edit the posting
function editPostingHandler()
{
    global $inputs;

    if (!empty($_FILES) && $_FILES['fileToUpload']['name']) {
        $src = uploadFile();
        $lastId = updateDb('posting',[
            'pic' => $src,
            'title' => $inputs['title'],
            'content' => $inputs['content'],
            'status' => $inputs['status']
        ], [
            "id" => $inputs['id']
        ]);
    } else {
        $lastId = updateDb('posting',[
            'title' => $inputs['title'],
            'content' => $inputs['content'],
            'status' => $inputs['status']
        ], [
            "id" => $inputs['id']
        ]);
    }

    formatOutput(true, 'update success',$inputs['id']);
}
// upload the image to folder static/upload
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
// to provide the detail information of the public posting by the id
function getPublicPostingInfo($id = 0)
{
    return getOne("select * from posting where id = ?", [$id]);
}
// the comment of the posting
function getPostingComment($id = 0) {

    return getAll("select r.content from posting_reply pr 
                        inner join  posting p on pr.posting_id = p.id 
                        inner join reply r on pr.reply_id = r.id where p.id = $id");
}
// handle the comment that is add the posting
function addCommentHandler()
{
    global $inputs;
    $content = $inputs['content'];
    $id = $inputs['id'];
    $replyId = insert('reply',[
        'content' => $content
    ]);

    insert('posting_reply',[
        'posting_id' => $id,
        'reply_id' => $replyId
    ]);

    insert('member_reply',[
        'member_id' => getLogin()['mid'],
        'posting_id' => $id
    ]);
    formatOutput(true, 'success');
}

// --------********--------********--------********--------********--------********
// Functions for the POSTING ends here
// author: saebom SHIN(40054234) / kimchhengheng(26809413)
// --------********--------********--------********--------********--------********


// get email of all the member
function getMailList()
{
    return getAll("select id,`email` 
                        from `member` where id != ?"
        , [getLogin()['mid']]);
}
// get the inbox message
function getInboxMessage()
{
    $sql = "select * from `mail` where receiver_id = ?";
    return getAll($sql, [getLogin()['mid']]);
}
//get the sent box message
function getSentboxMessage()
{
    $sql = "select * from `mail` where sender_id = ?";
    return getAll($sql, [getLogin()['mid']]);
}
// handle when message is add
function addMessageHandler()
{
    global $inputs;
    $lastId = insert('mail',[
        'title' => $inputs['title'],
        'content' => $inputs['content'],
        'sender_id' => getLogin()['mid'],
        'sender' => getMemberInfo()['email'],
        'receiver' => $inputs['receiverEmail'],
        'receiver_id' => $inputs['receiverId'],
    ]);
    formatOutput(true, 'add success');
}
// --------********--------********--------********--------********--------********
// Functions for the MESSAGE start here
// author: kimchheng heng(26809413)
// --------********--------********--------********--------********--------********

// --------********--------********--------********--------********--------********
// Functions for the SOCIAL start here
// author: kimchheng heng(26809413)
// --------********--------********--------********--------********--------********
// get the suggest friend that the member is not friend with and not apply for friend
function getSuggestFriend()
{
    return getAll("select a.id, a.name,a.email 
                        from member a 
                        where a.id != ?and a.id 
                            not in (
                                select friend_id 
                                from member_friend 
                                where member_id =?) 
                            and a.id not in (
                                select apply_member_id 
                                from member_friend_apply 
                                where status = \"\" 
                            and member_id = ?) limit 5",
        [getLogin()['mid'],getLogin()['mid'],getLogin()['mid']]
    );
}
// get the suggest posting to display in the social page
function getSuggestPosting()
{
    return getAll("select a.*,c.name 
                        from posting a 
                        inner join member_posting b on a.id = b.posting_id
                        inner join member c on c.id = b.member_id
                        limit 5");
}
// get the suggest group that member can apply( member not member of the group and not apply to group yet)
function getSuggestGroup(){
    return getAll("select * from `group` a 
            where id not in (
                select group_id 
                from member_group 
                where member_id=?)
            and a.id not in (
                select group_id 
                from member_group_apply 
                where status = \"\") limit 5"
        ,[getLogin()['mid']]);
}
// search friend from the whole table with keyword from input user(search by member name)
function friendSearchHandler()
{
    global $inputs;
    $keyword = $inputs['keyword'];
    $res = getAll("select a.name,a.email 
                        from member a 
                        where a.name like '%$keyword%' 
                        and a.id not in (
                            select apply_member_id 
                            from member_friend_apply 
                            where status = 0)"
    );
    formatOutput(true, 'success',$res);
}
// search posting from the whole table with keyword from input user(either title or content search)
function postingSearchHandler()
{
    global $inputs;
    $keyword = $inputs['keyword'];
    $res = getAll("select a.*,c.name 
                        from posting a 
                            inner join member_posting b 
                                on a.id = b.posting_id
                            inner join member c 
                                on c.id = b.member_id 
                        where a.title like '%$keyword%' or a.content like '%$keyword%'");
    formatOutput(true, 'success',$res);
}
// search group from whole table with keyword from input user(search by group name or description of group)
function groupSearchHandler()
{
    global $inputs;
    $keyword = $inputs['keyword'];
    $res = getAll("select * 
                        from `group` 
                        where group_name like '%$keyword%' or description like '%$keyword%'");
    formatOutput(true, 'success',$res);
}
// handle action when the logged member apply friend to other member
function friendApplyHandler()
{
    global $inputs;

    insert('member_friend_apply',[
        'member_id' => getLogin()['mid'],
        'apply_member_id' => $inputs['id']
    ]);

    formatOutput(true, 'apply success');
}
// handle action when logged member apply group
function friendGroupHandler()
{
    global $inputs;

    insert('member_group_apply',[
        'member_id' => getLogin()['mid'],
        'group_id' => $inputs['id']
    ]);

    formatOutput(true, 'apply success');
}
// --------********--------********--------********--------********--------********
// Functions for the SOCIAL start here
// author: kimchheng heng(26809413)
// --------********--------********--------********--------********--------********



// --------********--------********--------********--------********--------********
// Functions for the BASE_INFO page start here
// author:
// --------********--------********--------********--------********--------********

function getMemberFriendInfo()
{
    return getAll("
    select a.id, b.name from member_friend a inner join member b on a.friend_id = b.id where a.member_id=?", [getLogin()['mid']]);
}

function withdrawGroupHandler()
{
    global $inputs;
    $sql = "delete from `member_group` where id = " . $inputs['id'];
    execSql($sql);
    formatOutput(true, 'delete success');
}
function unfriendHandle()
{
    global $inputs;
    $res=getOne("select * from member_friend where id =?", [$inputs['id']]);
    $sql = "delete from `member_friend` where member_id= ".$res['member_id']." and friend_id= ".$res['friend_id'];
    execSql($sql);
    $sql = "delete from `member_friend` where member_id= ".$res['friend_id']." and friend_id= ".$res['member_id'];
    execSql($sql);
    formatOutput(true, 'delete success');
}
// --------********--------********--------********--------********--------********
// Functions for the Member(Index) start here
// author:
// --------********--------********--------********--------********--------********



function getFriendLastedPosting()
{
    $sql = "select b.*,c.name from member_posting a
inner join posting b on b.id = a.posting_id
inner join member c on c.id = a.member_id
where a.member_id in (select friend_id from member_friend where member_id = ?)  order by b.last_update_time DESC limit 10";
    return getAll($sql, [getLogin()['mid']]);
}

function getNewFriendApply()
{
  return getAll("select a.id,b.name as applier_name , a.member_id as applier_id ,a.create_time
from member_friend_apply a , `member` b
where a.apply_member_id = ? and a.member_id = b.id and a.status = \"\"", [getLogin()['mid']]);

}

function disAgreeFriendHandler()
{
    global $inputs;
    $sql = "delete from `member_friend_apply` where id = " . $inputs['id'];
    execSql($sql);
    formatOutput(true, 'option success');
}

function agreeFriendHandler()
{
    global $inputs;
    $res = getOne('select * from member_friend_apply where id = ?',[$inputs['id']]);
    insert('member_friend',[
        'member_id' => getLogin()['mid'],
        'friend_id' => $res['member_id']
    ]);
    insert('member_friend',[
        'member_id' =>  $res['member_id'],
        'friend_id' =>getLogin()['mid']
    ]);
    $sql = "delete from `member_friend_apply` where id = " . $inputs['id'];
    execSql($sql);
    formatOutput(true, 'option success');
}

// --------********--------********--------********--------********--------********
// Functions for the Index ends here
// author:
// --------********--------********--------********--------********--------********
?>