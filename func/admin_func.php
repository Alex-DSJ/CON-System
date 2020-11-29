<?php
require_once "dbQuerry.php";

// get the list of all admins
function getAdminList()
{
    $sql = "SELECT a.*, 
            IFNULL(c.building_name,'-') AS building_name,
            IFNULL(b.building_id,'0') AS building_id
            FROM admin a
            LEFT JOIN admin_building b ON a.id = b.admin_id 
            LEFT JOIN building c ON c.id = b.building_id
            WHERE a.id != 1";

    return getAll($sql);
}


?>