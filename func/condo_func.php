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

function getCondoList()
{
    $sql = "select a.*,c.building_name from condo a 
left join condo_building b on a.id = b.condo_id
left join building c on c.id = b.building_id
where b.building_id = ?";
    return getAll($sql, [getLogin()['bid']]);
}

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

function delCondoHandler()
{
    global $inputs;
    $sql = "delete from condo where id = " . $inputs['id'];
    execSql($sql);
    formatOutput(true, 'delete success');
}
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



?>