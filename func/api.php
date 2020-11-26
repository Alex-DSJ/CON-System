<?php
require_once "./func.php";
require_once "./dbQuerry.php";
require_once "./posting_func.php";

// call all other php func need 

global $inputs;
$inputs = array_merge($_GET,$_POST);

if (isset($inputs['act'])) {
    $act = $inputs['act'];
    switch ($act) {
       
        case 'add_posting' : addPostingHandler();break;
        case 'del_posting' : delPostingHandler();break;
        case 'edit_posting' : editPostingHandler();break;
        case 'detail_posting' : groupApplyHandler();break;
        
        default :
            formatOutput(false, 'unknown action');
    }
} else {
    formatOutput(false, 'error');
}
?>