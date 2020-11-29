<!-- This file is completed by shijun DENG-40084956 individually -->

<?php
// all required php files here
require_once "dbQuerry.php";

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
    insert('building',[
        'building_name' => $inputs['name'],
        'address' => $inputs['address'],
        'description' => $inputs['desc'],
        'area' => $inputs['area'],
    ]);
    formatOutput(true, 'add success');
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
?>
