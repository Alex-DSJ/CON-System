<!-- This file is completed by shijun DENG-40084956 individually -->

<?php
// all required php files here
require_once "../func/dbQuerry.php";

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
    $res = updateDb('contract',[
        'status' => $inputs['status'],
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

?>