<?php
// session_start();
require_once dirname(__FILE__).'./db.php';

// function formatOutput($success = true, $msg = 'option success', $data = [])
// {
//     header('Content-Type:application/json');
//     echo json_encode([
//         'success' => $success,
//         'msg' => $msg,
//         'data' => $data
//     ]);
//     exit;
// }

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
?>