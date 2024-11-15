<?php
// include database and object files
include_once '../../config/database.php';
include_once '../stat/api/objects/Swapf_stat.php';

echo "<html><body>";

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
$swapf_stat = new Swapf_stat($db);

$stmt = $swapf_stat->count_Visits();

if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
	echo '<br>NBV: ' . $Cnt;
}
	
$stmt = $swapf_stat->count_Runs();

if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
	echo '<br>NBM: ' . $Cnt;
}
	
$stmt = $swapf_stat->count_Subs();

if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
	echo '<br>NBS: ' . $Cnt;
}

$stmt = $swapf_stat->count_Upgrades();

if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
	echo '<br>NBU: ' . $Cnt;
}
echo "</body></html>";
?>
