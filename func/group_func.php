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

function delGroupHandler()
{
    global $inputs;
    $sql = "delete from `group` where id = " . $inputs['id'];
    execSql($sql);
    formatOutput(true, 'delete success');
}

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
?>