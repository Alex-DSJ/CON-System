<?php 

require_once dirname(__FILE__).'/db.php';

function formatOutput($success = true, $msg = 'option success', $data = []) {
    header('Content-Type:application/json');
    echo json_encode([
        'success' => $success,
        'msg' => $msg,
        'data' => $data
    ]);
    exit;
}

// get the first instance of the query
function getOne($sql = '', $data = []) {
    global $db;
    $stmt = $db->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// get all instances of the query
function getAll($sql = '', $data = []) {
    global $db;
    $stmt = $db->prepare($sql);
    $stmt->execute($data);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// execute the query
function execSql($sql = '') {
    global $db;
    $db->exec($sql);
    return $db->lastInsertId();
}

// update a table with parameters of certain condition
function updateDb($table, $parameters=[], $condition=[]) {
    $sql = "UPDATE `$table` SET ";
    $fields = [];
    $pdo_parameters = [];
    foreach ( $parameters as $field=>$value){
        $fields[] = '`'.$field.'`=:field_'.$field;
        $pdo_parameters['field_'.$field] = $value;
    }

    $sql .= implode(',', $fields);
    $fields = [];
    $where = '';
    if(is_string($condition)) {
        $where = $condition;
    } else if(is_array($condition)) {
        foreach($condition as $field=>$value){
            $parameters[$field] = $value;
            $fields[] = '`'.$field.'`=:condition_'.$field;
            $pdo_parameters['condition_'.$field] = $value;
        }
        $where = implode(' AND ', $fields);
    }
    if(!empty($where)) {
        $sql .= ' WHERE '.$where;
    }
    global $db;
    $stmt = $db->prepare($sql);
    return $stmt->execute($pdo_parameters);
}

// insert parameters to a table
function insert($table, $parameters=[]) {
    $sql = "INSERT INTO `$table`";
    $fields = [];
    $placeholder = [];
    foreach ( $parameters as $field=>$value){
        $placeholder[] = ':'.$field;
        $fields[] = '`'.$field.'`';
    }
    $sql .= '('.implode(",", $fields).') VALUES ('.implode(",", $placeholder).')';

    global $db;
    $stmt = $db->prepare($sql);
    $stmt->execute($parameters);
    return $db->lastInsertId();
}
?>