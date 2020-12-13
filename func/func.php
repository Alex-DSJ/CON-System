<?php

// --------********--------********--------********--------********--------********
// Functions for the SUPER ADMIN starts here
// author: Shijun Deng (40084956)
// --------********--------********--------********--------********--------********

session_start();

require_once dirname(__FILE__).'/db.php';
require_once dirname(__FILE__) . "/dbQuery.php";

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

// compare the username and password with databse and login
function loginHandler($inputs = []) {
    $username = $inputs['username'];
    $password = $inputs['password'];
    $sql = 'SELECT * FROM `admin` WHERE `name` = ? AND password = ?';
    $res = getOne($sql, [$username, $password]);
    if (!$res) {
        formatOutput(false, 'username or password error');
    }
    else{
        $buildingRes = getOne("SELECT * FROM `admin_building` WHERE admin_id =?", [$res['id']]);
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
        if ( $password == 'admin') {
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

// invoke clearLogin() to clear the all sensitive sessions for the user and logout
function logoutHandler() {
    clearLogin();
    formatOutput(true, 'logout success');
}

// store the user id and building id in the session for later use
function setLogin($uid = 0, $bid = 0) {
    $_SESSION['uid'] = $uid;
    $_SESSION['bid'] = $bid;
}

// add an admin with a unique name to the database
function addAdminHandler() {
    global $inputs;
    global $db;

    $sql = "SELECT count(1) FROM admin WHERE name = " . $inputs['admin_username'];
    $count = getOne("SELECT count(1) FROM admin WHERE name = ?", [$inputs['admin_username']]);
    if ($count['count(1)'] > 0) {
        formatOutput(false, 'The username exists, please change another one');
    }
    else{
        $adminId = insert('admin',[
            'name' => $inputs['admin_username'],
            'password' => $inputs['admin_password']
        ]);
    
        $admin_buildingId = insert('admin_building', [
           'admin_id' => $adminId,
           'building_id' => $inputs['admin_building'],
        ]);
        formatOutput(true, 'add success');
    }
}

// delete a certain admin from the database
function delAdminHandler() {
    global $inputs;
    $sql = "DELETE FROM `admin` WHERE id = " . $inputs['id'];
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

// get all admins which have buildings from the database
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

// get the list of all admins
function getAllAdmins(){
    $sql = "SELECT * FROM admin";
    return getALl($sql);
}

//get all buildings' name and return
function getBuildingList() {
    return getAll("SELECT * FROM building");
}

// add a new building to the database
function addBuildingHandler() {
    global $inputs;
    $buildingId = insert('building',[
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

// get all contracts from the database
function getContractList() {
    $sql = "SELECT * FROM contract ORDER BY id DESC";
    return getAll($sql);
}

// get all contract-member relations from the database
function getContractRelList(){
    $sql = "SELECT * FROM user_contract ORDER by id DESC";
    return getAll($sql);
}

// update a contract by the super admin or the admins
function updateContractHandler1() {
    global $inputs;

    //update contract
    $res = updateDb('contract',[
        'status' => $inputs['status'],
        'title' => $inputs['title'],
        'content' => $inputs['content'],
    ], [
        'id' => $inputs['id']
    ]);

    //update user_contract
    $res = updateDb('user_contract',[
        'user_type' => $inputs['role'],
        'uid' => $inputs['creator_id'],
    ], [
        'contract_id' => $inputs['id']
    ]);

    formatOutput(true, 'update success', $res);
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

// add a new contract to the database by the super admin
function addContractHandler1() {
    global $inputs;

    $cid = insert('contract',[
        'title' => $inputs['title'],
        'content' => $inputs['content'],
        'status' => $inputs['status'],
    ]);

    insert('user_contract',[
        'user_type' => $inputs['role'],
        'uid' => $inputs['id'],
        'contract_id' => $cid,
    ]);

    formatOutput(true, 'add success');
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
function getMemberContractList() {
    $sql = "SELECT  b.* 
            FROM user_contract a INNER JOIN contract b ON a.contract_id = b.id 
            WHERE a.user_type = 'member' AND a.uid = ? 
            ORDER BY b.id DESC";
    return getAll($sql, [getLogin()['mid']]);
}

// delete the contract
function delContractHandler() {
    global $inputs;
    $sql1 = "delete from contract where id = " . $inputs['id'];
    execSql($sql1);

    $sql2 = "DELETE FROM user_contract WHERE contract_id = " . $inputs['id'];
    execSql($sql2);

    formatOutput(true, 'delete success');
}

// edit contract by the super admin
function editContractHandler1() {
    global $inputs;

    updateDb('contract',[
        'title' => $inputs['title'],
        'status' => $inputs['status'],
        'content' => $inputs['content'],
    ], [
        'id' => $inputs['id'],
        'admin_id' => getLogin()['uid']
    ]);

    formatOutput(true, 'update success');
}

// add a member to the database by the super admin
function addMemberHandler1() {
    global $inputs;

    if (numberOfSameEmailAddress($inputs['email']) > 0) {
        formatOutput(false, "ERROR! The email address " . $inputs['email'] ." already existed, please choose another one.");
    }

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

    $sql = insert('member_condo', [
        'member_id' => $lastId,
        'condo_id' => $inputs['condo_id']
    ]);

    formatOutput(true, 'add success');
}

// update a member in the database by a super admin
function editMemberHandler1() {
    global $inputs;

    $sqlThisEmail = "SELECT email FROM member WHERE id = " . $inputs['id'];
    $thisEmailAddress = getAll($sqlThisEmail);



    // if the email address is changed
    if ($inputs['email'] != $thisEmailAddress[0]['email']) {
        $sqlOtherEmails = "SELECT email FROM member WHERE id <> " . $inputs['id'];
        $OtherEmailAddresses = getAll($sqlOtherEmails);

    
        foreach ($OtherEmailAddresses as $email) {
            if ($inputs['email'] == $email['email']) {
                $outputString = $inputs['email'] . ' == ' . $email['email'];
                formatOutput(false, "ERROR! The email address " . $inputs['email'] ." already existed, please choose another one.");
            }
        }
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

    if (isset($inputs['condo_id'])) {
        insert('member_condo', [
            'member_id' => $inputs['id'],
            'condo_id' => $inputs['condo_id']
        ]);
    }

    formatOutput(true, 'update success');
}

// delete an associated condo of a member
function delMemberCondoHandler() {
    global $inputs;

    $sql = "DELETE FROM `member_condo` WHERE id = " . $inputs['id'];

    execSql($sql);

    formatOutput(true, 'delete success');
}

// get all postings of the system
function getAllPostings() {
    return getAll("select * from posting");
}

// get all groups of the system by the super admin
function getAllGroups() {
    return getAll("SELECT * FROM `group`");
}

// get member-group relations by the super admin
function getMemberGroupInfo1() {
    global $inputs;

    $res = getAll('SELECT mg.*,
	                m.name
                    FROM member_group mg
                    JOIN member m
                        ON m.id = mg.member_id
                    WHERE group_id = ?' , [$inputs['id']]);
    formatOutput(true, 'success', $res);
}

// update group info my the super admin
function editGroupHandler1() {
    global $inputs;

    updateDb('group',[
        'group_name' => $inputs['name'],
        'description' => $inputs['desc'],
    ], [
        'id' => $inputs['id'],
    ]);

    formatOutput(true, 'update success');
}

// get all group applies of the system by the super admin
function getAllGroupApplies() {
    return getALL('SELECT mga.*,
                        m.name AS member_name,
                        g.group_name
                    FROM member_group_apply mga
                    JOIN `member` m
                        ON m.id = mga.member_id
                    join `group` g
                        on mga.group_id = g.id');
}

// handler the group application
function groupApplyHandler1() {
    global $inputs;

    updateDb('member_group_apply',[
        'status' => $inputs['type'],
        'handle_time' => date('Y-m-d H:i:s'),
    ], [
        'id' => $inputs['id']
    ]);

    if ($inputs['type'] == 'agree') {
        insert('member_group',[
            'member_id' => $inputs['member_id'],
            'group_id' => $inputs['group_id']
        ]);
    }

    formatOutput(true, 'update success');
}

// get all emails in the system
function getAllEmails() {
    return getALL('SELECT * FROM mail');
}

// add an email to the database
function addEmailHandler1() {
    global $inputs;

    insert('mail',[
        'title' => $inputs['title'],
        'content' => $inputs['content'],
        'sender_id' => $inputs['sender_id'],
        'sender' => $inputs['sender_name'],
        'receiver_id' => $inputs['receiver_id'],
        'receiver' => $inputs['receiver_name'],
        'is_read' => 'unread'
    ]);

    formatOutput(true, 'add success');
}

// update an email to the database
function editEmailHandler1() {
    global $inputs;

    updateDb('mail', [
        'title' => $inputs['title'],
        'sender_id' => $inputs['sender_id'],
        'sender' => $inputs['sender_name'],
        'receiver_id' => $inputs['receiver_id'],
        'receiver' => $inputs['receiver_name'],
        'content' => $inputs['content'],   
    ], [
        'id' => $inputs['id']
    ]);

    formatOutput(true, 'update success');
}

// delete an email in the database by the super admin
function delEmailHandler1() {
    global $inputs;

    $sql = "DELETE FROM mail WHERE id = " . $inputs['id'];
    execSql($sql);

    formatOutput(true, 'delete success');
}

// check if the email address is repeated
function numberOfSameEmailAddress($email) {
    $sql = "SELECT * FROM member WHERE email = '" . $email . "'";
    $result = getAll($sql);

    return count($result);
}


// update the info of condo to the database
function editCondoHandler1() {
    global $inputs;

    updateDb('condo',[
        'name' => $inputs['name'],
        'area' => $inputs['area'],
        'cost' => $inputs['cost'],
    ], [
        'id' => $inputs['id']
    ]);

    updateDb('condo_building',[
        'building_id' => $inputs['building_id']
    ], [
        'condo_id' => $inputs['id']
    ]);

    formatOutput(true, 'update success');
}

// add a condo to the database by the super admin
function addCondoHandler1() {
    global $inputs;

    $lastId = insert('condo',[
        'name' => $inputs['name'],
        'area' => $inputs['area'],
        'cost' => $inputs['cost'],
    ]);

    insert('condo_building', [
        'condo_id' => $lastId,
        'building_id' => $inputs['building_id'],
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

// get all memberlist from the database
function getMemberList() {
    return getAll("SELECT * FROM member ");
}

// get all member list of an admin
function getMemberListAdmin() {
    $sql = "SELECT d.*
            FROM admin_building a,
                condo_building b,
                member_condo c,
                member d 
            WHERE a.admin_id=? AND a.building_id = b.building_id AND b.condo_id= c.condo_id AND c.member_id = d.id AND b.building_id=? ORDER BY d.id ASC";
    
    return getAll($sql, [getLogin()['uid'], getLogin()['bid']]);
}

// get the condo list of a certain building from the database
function getCondoList() {
    $sql = "SELECT c.*,
	            b.building_name
            FROM condo c 
            LEFT JOIN condo_building cb 
            ON c.id = cb.condo_id
            LEFT JOIN building b 
            ON b.id = cb.building_id
            WHERE cb.building_id = ?";
    return getAll($sql, [getLogin()['bid']]);
}

//get all condos of the system
function getAllCondos() {
    $sql = "SELECT c.*,
	            b.building_name
            FROM condo_building cb
            JOIN building b
	            ON b.id = cb.building_id
            JOIN condo c
	            ON c.id = cb.condo_id";
    return getAll($sql);
}

// update the info of condo to the database
function editCondoHandler()	{	
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
function delCondoHandler() {
    global $inputs;

    $sql = "delete from condo where id = " . $inputs['id'];
    execSql($sql);

    formatOutput(true, 'delete success');
}

// add a new condo to the dataase
function addCondoHandler() {
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
function getGroupList() {
    return getAll("SELECT * FROM `group` WHERE admin_id = ?", [getLogin()['uid']]);
}

// get all group apply list from the database
function getGroupApplyList() {
    return getAll("SELECT b.name AS member_name ,
                        c.group_name,
                        a.create_time,
                        a.id,
                        IFNULL(a.handle_time,'-') AS handle_time,a.status
                    FROM `member_group_apply` a 
                    INNER JOIN member b ON a.member_id = b.id
                    INNER JOIN `group` c ON a.group_id = c.id
                    WHERE c.admin_id = ?", [getLogin()['uid']]);
}

// get the name of a give group by id
function getGroupName($id=0) {
    return getOne("SELECT group_name FROM `group` WHERE id = ?",[$id]);
}

//get all posting within the group
function getALlPostByGroup($name) {
    return getAll("SELECT a.*, c.name FROM posting a, member_posting b, `member` c WHERE a.`status`=? AND a.id = b.posting_id AND b.member_id = c.id"
        , [$name]);
}

// get all the member from the group
function getMemberWithinGroupInfo() {
    global $inputs;

    $res = getAll("SELECT a.*, b.id as member_groupId FROM `member` a, member_group b WHERE b.group_id = ? AND b.member_id=a.id", [$inputs['id']]);
    formatOutput(true, 'success', $res);
}

// delete the member from the group
function delMemberGroupHandle() {
    global $inputs;

    $sql = "DELETE FROM `member_group` WHERE id = " . $inputs['id'];
    execSql($sql);

    formatOutput(true, 'delete success');
}

// handle a group apply from a member
function groupApplyHandler() {
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
function editGroupHandler() {
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
function delGroupHandler() {
    global $inputs;

    $sql = "delete from `group` where id = " . $inputs['id'];
    execSql($sql);

    formatOutput(true, 'delete success');
}

// add the info of group to the database
function addGroupHandler() {
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
// Functions for the OWNER starts here
// author: saebom SHIN(40054234)
// --------********--------********--------********--------********--------********

// get the condos according to the member id
function memberCondosHandler() {
    global $inputs;

    $res = getAll('SELECT a.*,b.name FROM member_condo a INNER JOIN condo b ON a.condo_id = b.id WHERE a.member_id = ?', [$inputs['id']]);
    
    formatOutput(true, 'success', $res);
}

// update a member in the database
function editMemberHandler() {
    global $inputs;

    if (emailRepeated($inputs['email'])) {
        formatOutput(false, 'ERROR! The auto-generated email address already existed, please choose another one.');
    }

    $sql = "DELETE FROM `member_condo` WHERE member_id = " . $inputs['id'];
    execSql($sql);

    insert('member_condo', [
        'member_id' => $inputs['id'],
        'condo_id' => $inputs["condos"]
    ]);

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


function delMemberHandler() {
    global $inputs;

    $sql = "DELETE FROM `member` WHERE id = " . $inputs['id'];
    execSql($sql);

    formatOutput(true, 'delete success');
}

function addMemberHandler() {
    global $inputs;

    if (emailRepeated($inputs['email'])) {
        formatOutput(false, 'ERROR! The auto-generated email address already existed, please choose another one.');
    }

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

    insert('member_condo', [
        'member_id' => $lastId,
        'condo_id' => $inputs["condos"]
    ]);

    formatOutput(true, 'add success');
}

// --------********--------********--------********--------********--------********
// Functions for the OWNER ends here
// author: saebom SHIN(40054234)
// --------********--------********--------********--------********--------********

// --------********--------********--------********--------********--------********
// Functions for the POSTING starts here
// author: kimchhengheng(26809413) / saebom SHIN(40054234)
// --------********--------********--------********--------********--------********

// get all the posting by the logged member
function getPostingList() {
    return getAll("SELECT b.* 
                    FROM member_posting a 
                    INNER JOIN posting b 
                        ON a.posting_id = b.id  
                    WHERE a.member_id = ?"
        , [getLogin()['mid']]);
}

// get detail information of the posting by the specific id
function getPostingInfo($id = 0) {
    return getOne("SELECT b.* 
                    FROM member_posting a 
                    INNER JOIN posting b 
                        ON a.posting_id = b.id  
                    WHERE a.posting_id = ?"
        , [$id]);
}

// get all the posting which have status public
function getPublicPost() {
    return getAll("SELECT * FROM posting WHERE status= 'public'");
}

// get all postings of some members who belong to the admin of uid
function getPostingAll() {
        $sql ="SELECT f.* ,
                    i.name
                FROM member_posting e,
                    posting f,
                    `member` i
                WHERE e.member_id= i.id AND e.posting_id = f.id AND e.member_id IN (
                        SELECT d.id 
                        FROM admin_building a,
                            condo_building b,  
                            member_condo c,
                            `member` d 
                        WHERE a.admin_id=? 
                            AND a.building_id = b.building_id
                            AND b.condo_id= c.condo_id 
                            AND c.member_id = d.id ) 
                            ORDER BY i.name ASC";
        return getAll($sql, [getLogin()['uid']]);
}

// handle the delete post by specific id
function delPostingHandler() {
    global $inputs;

    $sql = "DELETE FROM `posting` WHERE id = " . $inputs['id'];
    execSql($sql);

    formatOutput(true, 'delete success');
}

// add new row to the posting table, member posting(will keep track who post the posting)
function addPostingHandler() {
    global $inputs;

    $src = uploadFile();

    $lastId = insert('posting',[
        'pic' => $src,
        'title' => $inputs['title'],
        'content' => $inputs['content'],
 	    'status' => $inputs['status']
    ]);

    insert('member_posting', [
        'posting_id' => $lastId,
        'member_id' => getLogin()['mid']
    ]);

    formatOutput(true, 'add success',$lastId);
}

// edit the posting
function editPostingHandler() {
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
function uploadFile() {
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
function getPublicPostingInfo($id = 0) {
    return getOne("SELECT * FROM posting WHERE id = ?", [$id]);
}

// the comment of the posting
function getPostingComment($id = 0) {
    return getAll("SELECT r.content FROM posting_reply pr 
                        INNER JOIN  posting p on pr.posting_id = p.id 
                        INNER JOIN reply r on pr.reply_id = r.id WHERE p.id = $id");
}

// handle the comment that is add the posting
function addCommentHandler() {
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

// get the postings from other member
function getOtherPublicPosting(){
    return getAll("SELECT DISTINCT a.* , c.name 
                    FROM posting a,
                        member_posting b, 
                        `member` c 
                    WHERE a.`status` = 'public' 
                        AND a.id = b.posting_id 
                        AND b.member_id <>? 
                        AND b.member_id =c.id"
        , [getLogin()['mid']]);
}

// --------********--------********--------********--------********--------********
// Functions for the POSTING ends here
// author: saebom SHIN(40054234) / kimchhengheng(26809413)
// --------********--------********--------********--------********--------********

// --------********--------********--------********--------********--------********
// Functions for the MEMBER start  here
// author: Yuxin Wang-40024855/ kimchhengheng(26809413)
// --------********--------********--------********--------********--------********

// check the session of the member id is set or not
function checkMemberLogin() {
    if (!isset($_SESSION['mid'])) {
        return false;
    }
    return true;
}

// handle the login of the member
function memberLoginHandler() {
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
function setMemberLogin($uid) {
    $_SESSION['mid'] = $uid;
}

// get full information of the member by using their id
function getMemberInfo($id = 0) {
    if ($id == 0) {
        $id = getLogin()['mid'];
    }

    return getOne("SELECT * FROM member WHERE id = ?", [$id]);
}

// get the group that the logged member be part of
function getMemberGroupInfo() {
    global $inputs;

    if (empty($inputs)) {
        $mid = getLogin()['mid'];
    } else {
        $mid = $inputs['id'];
    }

    $res = getAll("SELECT b.*,a.id AS union_id 
                    FROM member_group a 
                    INNER JOIN `group` b 
                        ON a.group_id = b.id 
                    WHERE a.member_id = ?", [$mid]);

    if (empty($inputs)) {
        return $res;
    } else {
        formatOutput(true, 'success', $res);
    }
}

// get the information of condo who own by the logged member
function getMemberCondoInfo() {
    return getAll("SELECT b.name,
                        b.area,
                        b.cost 
                    FROM member_condo a 
                    INNER JOIN condo b 
                        ON a.condo_id = b.id
                    WHERE a.member_id = ?",
        [getLogin()['mid']]);
}
// --------********--------********--------********--------********--------********
// Functions for the MEMBER end  here
// author: Yuxin Wang-40024855/ kimchhengheng(26809413)
// --------********--------********--------********--------********--------********
// --------********--------********--------********--------********--------********
// Functions for the Message start  here
// author: kimchhengheng(26809413)
// --------********--------********--------********--------********--------********

// get email of all the member
function getMailList() {
    return getAll("SELECT id,`email` FROM `member` WHERE id != ?"
        , [getLogin()['mid']]);
}
// get the inbox message
function getInboxMessage() {
    $sql = "SELECT * FROM `mail` WHERE receiver_id = ?";
    return getAll($sql, [getLogin()['mid']]);
}
//get the sent box message
function getSentboxMessage() {
    $sql = "SELECT * FROM `mail` WHERE sender_id = ?";
    return getAll($sql, [getLogin()['mid']]);
}
// handle when message is add
function addMessageHandler() {
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
function getSuggestFriend() {
    return getAll("SELECT a.id, a.name,a.email 
                    FROM member a 
                    WHERE a.id != ? AND a.id NOT IN (
                            SELECT friend_id 
                            FROM member_friend 
                            WHERE member_id =? ) 
                    AND a.id NOT IN (
                            SELECT apply_member_id 
                            FROM member_friend_apply 
                            WHERE status = \"\" 
                            AND member_id = ?) 
                    LIMIT 5",
        [getLogin()['mid'],getLogin()['mid'],getLogin()['mid']]);
}

// get the suggest posting to display in the social page
function getSuggestPosting() {
    return getAll("SELECT a.*,c.name 
                        FROM posting a 
                        INNER JOIN member_posting b ON a.id = b.posting_id
                        INNER JOIN member c ON c.id = b.member_id
                        LIMIT 5");
}

// get the suggest group that member can apply( member not member of the group and not apply to group yet)
function getSuggestGroup() {
    return getAll("SELECT * FROM `group` a 
            WHERE id NOT IN (
                SELECT group_id 
                FROM member_group 
                WHERE member_id=?)
            AND a.id NOT IN (
                SELECT group_id 
                FROM member_group_apply 
                WHERE status = \"\") 
            LIMIT 5"
        ,[getLogin()['mid']]);
}

// search friend from the whole table with keyword from input user(search by member name)
function friendSearchHandler() {
    global $inputs;

    $keyword = $inputs['keyword'];
    $res = getAll("SELECT a.name,a.email 
                        FROM member a 
                        WHERE a.name LIKE '%$keyword%' 
                        AND a.id NOT IN (
                            SELECT apply_member_id 
                            FROM member_friend_apply 
                            WHERE status = 0)"
    );

    formatOutput(true, 'success',$res);
}

// search posting from the whole table with keyword from input user(either title or content search)
function postingSearchHandler() {
    global $inputs;

    $keyword = $inputs['keyword'];
    $res = getAll("SELECT a.*,c.name 
                        FROM posting a 
                            INNER JOIN member_posting b 
                                ON a.id = b.posting_id
                            INNER JOIN member c 
                                ON c.id = b.member_id 
                            WHERE a.title LIKE '%$keyword%' OR a.content LIKE '%$keyword%'");
    
    formatOutput(true, 'success',$res);
}

// search group from whole table with keyword from input user(search by group name or description of group)
function groupSearchHandler() {
    global $inputs;

    $keyword = $inputs['keyword'];
    $res = getAll("SELECT * 
                        FROM `group` 
                        WHERE group_name LIKE '%$keyword%' OR description LIKE '%$keyword%'");
    
    formatOutput(true, 'success',$res);
}

// handle action when the logged member apply friend to other member
function friendApplyHandler() {
    global $inputs;

    insert('member_friend_apply',[
        'member_id' => getLogin()['mid'],
        'apply_member_id' => $inputs['id']
    ]);

    formatOutput(true, 'apply success');
}

// handle action when logged member apply group
function friendGroupHandler() {
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
// author: Yuxin Wang-40024855
// --------********--------********--------********--------********--------********

// get member-friend relations from the database
function getMemberFriendInfo() {
    return getAll("SELECT a.id, b.name FROM member_friend a INNER JOIN member b ON a.friend_id = b.id WHERE a.member_id=?", [getLogin()['mid']]);
}

// withdraw a member from a group
function withdrawGroupHandler() {
    global $inputs;

    $sql = "DELETE FROM `member_group` WHERE id = " . $inputs['id'];
    execSql($sql);

    formatOutput(true, 'delete success');
}

// withdraw a member from a friend
function unfriendHandle() {
    global $inputs;

    $res=getOne("SELECT * FROM member_friend WHERE id =?", [$inputs['id']]);

    $sql = "DELETE FROM `member_friend` WHERE member_id= ".$res['member_id']." AND friend_id= ".$res['friend_id'];
    execSql($sql);

    $sql = "DELETE FROM `member_friend` WHERE member_id= ".$res['friend_id']." AND friend_id= ".$res['member_id'];
    execSql($sql);

    formatOutput(true, 'delete success');
}

// --------********--------********--------********--------********--------********
// Functions for the BASE_INFO page start here
// author: Yuxin Wang-40024855
// --------********--------********--------********--------********--------********

// --------********--------********--------********--------********--------********
// Functions for the Member(Index) start here
// author: Yuxin Wang-40024855
// --------********--------********--------********--------********--------********

// get the latest 10 postings of a member's friend
function getFriendLastedPosting() {
    $sql = "SELECT b.*,
                c.name 
            FROM member_posting a
            INNER JOIN posting b 
                ON b.id = a.posting_id
            INNER JOIN member c 
                ON c.id = a.member_id
            WHERE a.member_id IN (
                    SELECT friend_id FROM member_friend WHERE member_id = ?)
            ORDER BY b.last_update_time DESC LIMIT 10";
    return getAll($sql, [getLogin()['mid']]);
}

// get all friend apply of a member
function getNewFriendApply() {
  return getAll("SELECT a.id,
                    b.name as applier_name ,
                    a.member_id as applier_id ,
                    a.create_time
                FROM member_friend_apply a , `member` b
                WHERE a.apply_member_id = ? 
                    AND a.member_id = b.id 
                    AND a.status = \"\"", [getLogin()['mid']]);
}

// reject a friend apply
function disAgreeFriendHandler() {
    global $inputs;

    $sql = "DELETE FROM `member_friend_apply` WHERE id = " . $inputs['id'];
    execSql($sql);

    formatOutput(true, 'option success');
}

// accept a friend apply
function agreeFriendHandler() {
    global $inputs;

    $res = getOne('SELECT * FROM member_friend_apply WHERE id = ?',[$inputs['id']]);

    insert('member_friend',[
        'member_id' => getLogin()['mid'],
        'friend_id' => $res['member_id']
    ]);

    insert('member_friend',[
        'member_id' =>  $res['member_id'],
        'friend_id' =>getLogin()['mid']
    ]);

    $sql = "DELETE FROM `member_friend_apply` WHERE id = " . $inputs['id'];
    execSql($sql);

    formatOutput(true, 'option success');
}
// --------********--------********--------********--------********--------********
// Functions for the Index ends here
// author: Yuxin Wang-40024855
// --------********--------********--------********--------********--------********
?>