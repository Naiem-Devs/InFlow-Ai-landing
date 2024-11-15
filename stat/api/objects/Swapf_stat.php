<?php
class Swapf_stat {
  
    // database connection and table name
    private $conn;
    private $runs_table_name = "Cochemist_runs";
	private $subs_table_name = "Cochemist_subs";
	private $upgrade_table_name = "Cochemist_upgrade";
	
	// Catalog:
	public $Cnt;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

	function count_Visits() {
		$query = "select COUNT(*) AS Cnt FROM " . $this->runs_table_name . " WHERE json_result='VISIT'";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
	
	function count_Runs() {
		$query = "select COUNT(*) AS Cnt FROM " . $this->runs_table_name . " WHERE json_result <> 'VISIT'";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
	
	function count_Subs() {
		$query = "select COUNT(*) AS Cnt FROM " . $this->subs_table_name;
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
	
	function count_Upgrades() {
		$query = "select COUNT(*) AS Cnt FROM " . $this->upgrade_table_name;
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	function write_Run($rn, $res) {
  
        $aaa = time();
		$dt = date("Y-m-d H:i:s", $aaa);
		$ipaddr = "";
		$ipcode = "";
		
		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ipaddr = $_SERVER['HTTP_CLIENT_IP'];
			$ipcode = "CLI";
        } else {
			if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ipaddr = $_SERVER['HTTP_X_FORWARDED_FOR'];
			    $ipcode = "FWD";
            } else {
                $ipaddr = $_SERVER['REMOTE_ADDR'];
			    $ipcode = "REM";
            }
		}

		$country = "";
		if ($ipaddr != "")
		{
			$url = "http://ip-api.com/json/" . $ipaddr . "?fields=country";
			$ch = curl_init();  
			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			$output=curl_exec($ch);
			curl_close($ch);
			$answer = json_decode($output, true);
			$country = $answer["country"];
			if ($country == "Russia") {
				$country = "France";
			}
		}

		$query = "INSERT INTO " . $this->runs_table_name . "(Run_Name,Dt_run,Ts_run,ipaddr,ipcode,Country,City,json_result)"
			. " VALUES (?,?,?,?,?,?,NULL,?)";
  
		// prepare query statement
		$stmt = $this->conn->prepare($query);
		
		// bind params
		$stmt->bindParam(1, $rn);
		$stmt->bindParam(2, $dt);
		$stmt->bindParam(3, $aaa);
		$stmt->bindParam(4, $ipaddr);
		$stmt->bindParam(5, $ipcode);
		$stmt->bindParam(6, $country);
		$stmt->bindParam(7, $res);
  
		// execute query
		$stmt->execute();
  
		return $stmt;
	}
	
	function write_Sub($email) {
  
        $aaa = time();
		$dt = date("Y-m-d H:i:s", $aaa);
		$ipaddr = "";
		$ipcode = "";
		
		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ipaddr = $_SERVER['HTTP_CLIENT_IP'];
			$ipcode = "CLI";
        } else {
			if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ipaddr = $_SERVER['HTTP_X_FORWARDED_FOR'];
			    $ipcode = "FWD";
            } else {
                $ipaddr = $_SERVER['REMOTE_ADDR'];
			    $ipcode = "REM";
            }
		}

		$country = "";
		if ($ipaddr != "")
		{
			$url = "http://ip-api.com/json/" . $ipaddr . "?fields=country";
			$ch = curl_init();  
			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			$output=curl_exec($ch);
			curl_close($ch);
			$answer = json_decode($output, true);
			$country = $answer["country"];
			if ($country == "Russia") {
				$country = "France";
			}
		}

		$query = "INSERT INTO " . $this->subs_table_name . "(Dt_run,Ts_run,ipaddr,ipcode,Country,City,Email)"
			. " VALUES (?,?,?,?,?,NULL,?)";
  
		// prepare query statement
		$stmt = $this->conn->prepare($query);
		
		// bind params
		$stmt->bindParam(1, $dt);
		$stmt->bindParam(2, $aaa);
		$stmt->bindParam(3, $ipaddr);
		$stmt->bindParam(4, $ipcode);
		$stmt->bindParam(5, $country);
		$stmt->bindParam(6, $email);
  
		// execute query
		$stmt->execute();
  
		return $stmt;
	}
	
	function write_Upgrade($email,$firstname,$lastname,$subject,$message) {
  
        $aaa = time();
		$dt = date("Y-m-d H:i:s", $aaa);
		$ipaddr = "";
		$ipcode = "";
		
		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ipaddr = $_SERVER['HTTP_CLIENT_IP'];
			$ipcode = "CLI";
        } else {
			if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ipaddr = $_SERVER['HTTP_X_FORWARDED_FOR'];
			    $ipcode = "FWD";
            } else {
                $ipaddr = $_SERVER['REMOTE_ADDR'];
			    $ipcode = "REM";
            }
		}

		$country = "";
		if ($ipaddr != "")
		{
			$url = "http://ip-api.com/json/" . $ipaddr . "?fields=country";
			$ch = curl_init();  
			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			$output=curl_exec($ch);
			curl_close($ch);
			$answer = json_decode($output, true);
			$country = $answer["country"];
			if ($country == "Russia") {
				$country = "France";
			}
		}

		$query = "INSERT INTO " . $this->upgrade_table_name . "(Dt_run,Ts_run,ipaddr,ipcode,Country,City,Email,First_name,Last_name,Subject,Message)"
			. " VALUES (?,?,?,?,?,NULL,?,?,?,?,?)";
  
		// prepare query statement
		$stmt = $this->conn->prepare($query);
		
		// bind params
		$stmt->bindParam(1, $dt);
		$stmt->bindParam(2, $aaa);
		$stmt->bindParam(3, $ipaddr);
		$stmt->bindParam(4, $ipcode);
		$stmt->bindParam(5, $country);
		$stmt->bindParam(6, $email);
		$stmt->bindParam(7, $firstname);
		$stmt->bindParam(8, $lastname);
		$stmt->bindParam(9, $subject);
		$stmt->bindParam(10, $message);
  
		// execute query
		$stmt->execute();
  
		return $stmt;
	}
}
?>
