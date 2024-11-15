<?php
// include database and object files
include_once '../config/database.php';
include_once 'stat/api/objects/Swapf_stat.php';

$ret = "";
$python = "/swp_flow_workdir/anaconda3/envs/KAI_envFev5/bin/python /home/workdir_team/IL_profiler/IL_profiler.py";
$output = "";
$resp = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$input = "";
	if (isset($_REQUEST['input'])) {
		$input = $_REQUEST['input'];
	}
	
	if ("$input" != "") {
		$ret = hash("md5", $input . microtime());
		mkdir("/moteur/" . $ret);
		file_put_contents("/moteur/" . $ret . "/input.json", $input);
		$cmd = $python . " /moteur/" . $ret . "/input.json 2<&1";
		exec($cmd, $output);
		$report_content = "Command:" . $cmd . "\r\nOutput:" . print_r($output, true);
		file_put_contents("/moteur/" . $ret . "/report", $report_content);
		$resp = file_get_contents("/moteur/" . $ret . "/input.json");
		$database = new Database();
		$db = $database->getConnection();
		$swapf_stat = new Swapf_stat($db);
		if ( false === $resp ) {
			$resp = "";
			$dbres = $swapf_stat->write_Run($ret, "NO OUTPUT");
		} else {
			$dbres = $swapf_stat->write_Run($ret, $resp);
		}
	}
}
http_response_code(200);
echo $resp;
?>