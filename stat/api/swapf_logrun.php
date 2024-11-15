<?php
// include database and object files
include_once '../../../config/database.php';
include_once 'objects/Swapf_stat.php';

$res = false;

if($_SERVER['REQUEST_METHOD'] === 'POST') {

	$rn = "";
	if (isset($_REQUEST['rn'])) {
		$rn = $_REQUEST['rn'];
	}
	
	$res = "";
	if (isset($_REQUEST['res'])) {
		$res = $_REQUEST['res'];
	}
	
	if (("$rn" != "") && ("$res" != "")){
		$database = new Database();
		$db = $database->getConnection();
		$swapf_stat = new Swapf_stat($db);
		$res = $swapf_stat->write_Run($rn, $res);
	}
}
http_response_code(200);
echo "OK";
?>
