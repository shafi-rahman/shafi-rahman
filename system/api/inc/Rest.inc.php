<?php
/* Name : Rest.inc.php
*  Author : shafi
*/
// require_once ('config.php');

class REST {
	// const variable
    const DB_SERVER = 'localhost';
    const SITEURL = 'https://maintenance.qrcs.org.qa/ticket/';
    const DB_USER = 'root';
    const DB_PASSWORD = '';
    const DB = 'ticketing_system';
    const PREFIX = 'ts_';

	const FIRSTKEY='Lk5Uz3slx3BrAghS1aaW5AYgWZRV0tIX5eI0yPchFz4';
    const SECONDKEY='EZ44mFi3TlAey1b2w4Y7lVDuqOSRxGXsa7nctnrJmMrA2vN6EJhrvdVZbxaQs5jpSe34X3ejFKo9Y5c83w';
	
	// variable
	public $data = "";
	public $db = NULL;
	public $_allow = array();
	public $_content_type = "application/json";
	public $_request = array();
	private $_method = "";		
	private $_code = 200;
	private $access_token_lifetime = 24*36000;
	private $auth_code_lifetime = 30;
		
	public function __construct(){
		$this->inputs();
		$this->dbConnect();
	}
		
	public function __destruct(){
		//$this->db->close();
		//mysqli_close($this->db);
		$this->db=null;
	}

	public function prefix(){
		return self::PREFIX;
	}

	public function site_url(){
		return self::SITEURL;
	}

	public function dbConnect() {
		$host = self::DB_SERVER;
		$db   = self::DB;
		$user = self::DB_USER;
		$pass = self::DB_PASSWORD;

		$this->db = new mysqli($host, $user, $pass, $db);
		if ($this->db->connect_error) {
			die("Connection failed: " . $this->db->connect_error);
		}
	}
	
	public function store_arraydata($table_name, $data_array) {
        $fld_str = '';
        $val_str = '';
        if ($table_name && is_array($data_array)) {
            $sqltable = "SHOW COLUMNS FROM `$table_name`";
            $smt = $this->db->query($sqltable);
            while ($coloumn_data = $smt->fetch_assoc()) {
                $column_name[] = $coloumn_data['Field'];
            }
            $i=0;
            foreach ($data_array as $rows) {
				$val_st_all='';
				foreach($rows as $key=>$val ){
                	if (in_array($key, $column_name) && $i==0 ) {
                    	$fld_str .= "`".$key."`".",";
                	}
					if (in_array($key, $column_name)  ) {
                    	$val_str .= "'" . $val . "',";
                	}
				}
			
				$val_str1 = substr($val_str, 0, -1);
				$val_str ='';
				$val_str_all[]="($val_str1)";
            
				$i++;	
            }

			$str_all_val = implode(",",$val_str_all);
            $fld_str = substr($fld_str, 0, -1);
            
            $sql = "INSERT INTO $table_name ($fld_str) VALUES $str_all_val";
            $this->db->query($sql);
			// $id = $this->db->insert_id;
			// $this->db->close();
            // return $id; 
        }
    }

	public function store_data($table_name, $data_array) {
        $fld_str = '';
        $val_str = '';
		$fld_mark = '';
        if ($table_name && is_array($data_array)) {
            $sqltable = "SHOW COLUMNS FROM `$table_name`";
            $smt = $this->db->query($sqltable);
            while ($coloumn_data = $smt->fetch_assoc()) {
                $column_name[] = $coloumn_data['Field'];
            }
             // print_r($column_name);
			 // die;
            foreach ($data_array as $key => $val) {
                if (in_array($key, $column_name)) {
                    $fld_str .= $key.",";
                    $fld_mark .= "?,";
                    $val_str .= "'" . $val . "',";
                }
            }

            $fld_str = substr($fld_str, 0, -1);
            $fld_mark = substr($fld_mark, 0, -1);
            $val_str = substr($val_str, 0, -1);
				
			$sql = "INSERT INTO $table_name ($fld_str) VALUES($val_str)";
			
			
			//echo $val_str;
			//$stmt = $this->db->prepare($sql);
			
			
			//$stmt->bind_param($val_str);
			
			
			//die();
			
			//if ($this->db->execute()) {
			//	$success = $this->db->insert_id;
			//} else {
			//	$success = FALSE;
			//}
			
			
			
        //    echo $sql;
           // die;
            $this->db->query($sql);
			if($this->db->insert_id){
				return $this->db->insert_id;
			} else {
				return $sql;
			}	
        }
    }
	
	public function set_mail($email_id, $subject, $content, $tbl_list=array()) {
		$ctable = '';
		if(count($tbl_list)>0){
			$ctable = '<table class="table" style="border: 0; border-collapse: collapse; width: 100%; margin: 0 0 10px;font-size:14px; color: #000;"><tbody style="border: 0 solid #fff;">';
			foreach($tbl_list as $k=>$v){ 
				$ctable .= '<tr> <td style="padding: 3px 0px;border: 1px solid #fff;">• '.$k.'</td><td style="padding: 3px 0px;border: 1px solid #fff;">'.$v.'</td></tr>';
			} 
			$ctable .= '</tbody></table>'; 
		}
		
		$contentbody = '<!DOCTYPE html>
		<html xmlns:v="urn:schemas-microsoft-com:vml" lang="vi">
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
			<meta http-equiv="X-UA-Compatible" content="IE=edge" />
			<base href="" />
			<title>Xác nhận đăng ký gian hàng trên Shop VnExpress</title>
			<meta name="robots" content="index, follow">
			<meta name="description" content="">
		</head>
		<body class="" style="box-sizing: border-box; font-size: 14px; font-family: Arial,Tahoma,sans-serif; width: 100%!important; height: 100%!important; line-height: 1.3; color: #242424; background: #fff; margin: 0; padding: 0;">
			<div class="wrapper" style="box-sizing:border-box;width:930px;min-width:520px;display:block;margin:0 auto;padding:0">
				<table border="0" cellpadding="0" cellspacing="0" width="100%" style="width: 100%; max-width: 100%; margin: 0 auto;background: #fff; color: #242424;font-size:14px;">
					<tbody>
						<tr>
							<td style="padding: 15px 6px;">
								<div class="content-table" style="width:810px;max-width:810px;padding: 0;">
									<div class="content">
										<br style="box-sizing:border-box;margin:0;padding:0">
										<p style="box-sizing:border-box;font-weight:normal;line-height:1.4;font-size:14px;color:#242424;margin:0 0 5px;padding:0; width: 100%; float:left;">'.$content.'</p>
										<div style="box-sizing:border-box;margin:0 0 15px;padding:0;clear: both;"></div>
										'.$ctable.'
										<div style="box-sizing:border-box;margin:0 0 15px;padding:0;clear: both;"></div>
									</div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</body>
		</html>';
			
		$this->store_data("ts_emails", array('email_id'=>$email_id, 'subject'=>$subject, 'contentbody'=>$contentbody, 'status'=>0, 'created'=>date("Y-m-d H:i:s")));
    }


	public function getUserinfo($token) {

        // $table='users';
        $result = $this->getRecord($token, 'authToken');
        //print_r($result);
        return $result;
    }
		
	public function delete_data($table, $where=array()) {

        if (count($where) > 0) {
            $str = '';
            foreach ($where as $key => $val) {
                $str .= $key . " = '" . $val . "' AND ";
            }
            $andWhere = substr($str, 0, -5);
        }

        $sql = "DELETE from $table where $andWhere";
		// echo  $sql ;
		// die;
        $this->db->query($sql);
	}

	public function update_data($table_name, $where, $setarray) {
        $whr_str = '';
        $val_str = '';
        //print_r($data_array);
        if ($table_name && is_array($setarray)) {
			foreach($where as $key=>$val){
				$whr_str .= $key." = '".$val."' AND ";
			}
			// $whr_str = substr($whr_str, 0, -1);
			$whr_str = rtrim($whr_str, " AND ");
			foreach($setarray as $key=>$val){
				$val_str .= $key." = '".$val."' , ";
			}
			$val_str = rtrim($val_str, " , ");
           	$sql = "UPDATE $table_name SET $val_str WHERE $whr_str";
			
			if($this->db->query($sql)){
				return true ;
			}else {
				return false ;
			}
        //     die($this->getQuery());
        //    return mysql_affected_rows();
        }
    }

	public function update_data_1($table_name, $match_fld, $data_array, $rec_id, $extr_whr='') {
        $fld_str = '';
        $val_str = '';
        //print_r($data_array);
        if ($table_name && is_array($data_array)) {
            $sql = "SHOW COLUMNS FROM `$table_name`";
            $smt = $this->db->query($sql);
            while ($coloumn_data=$smt->fetch_assoc())
                $column_name[] = $coloumn_data['Field'];
            foreach ($data_array as $key => $val) {
                if (in_array($key, $column_name)) {
                    $fld_str .= "$key,";
                    if ($val == 'now()')
                        $val_str .= "$key=" . trim($val) . ",";
                    else
                        $val_str .= "$key='" . trim($val) . "',";
                }
            }
            $val_str = substr($val_str, 0, -1);
            if($extr_whr!=""){
                $sql = "UPDATE `$table_name` SET $val_str WHERE $match_fld ='$rec_id' $extr_whr";
            }else{
                $sql = "UPDATE `$table_name` SET $val_str WHERE $match_fld ='$rec_id'";
            }            
           // $this->setQuery($sql, $this->connection);
			if($this->db->query($sql)){
				
				return true ;
			}else {
				return false ;
			}
            //die($this->getQuery());
           // return mysql_affected_rows();
        }
    }
	
	public function run_query($sql="") {
		if($sql!=""){
			$smt = $this->db->query($sql);
			if($smt->num_rows==0){
				return array(array());
			} else {
				while($result = $smt->fetch_assoc()){
					$row[]=$result;
				}
				return $row;
			}
		} else {
			return array(array());
		}
	}

	public function getAllRecord($table, $selectfield=[], $where=[]) {
		$andWhere = "";
        if (count($where) > 0) {
            $str = '';
            foreach ($where as $key => $val) {
				if(strpos($val, '!')!==false){
					$str .= $key . " != '" . str_replace('!', '', $val) . "' AND ";
				} else {
					$str .= $key . " = '" . $val . "' AND ";
				}
            }
            $andWhere = substr($str, 0, -5);
        }
		$andWhere = $andWhere!=""?" where ".$andWhere:'';
		$select = count($selectfield)>0?implode( ' , ', $selectfield):" * " ;
        $sql = "select $select  from $table $andWhere ";

        $smt = $this->db->query($sql);
		if($smt->num_rows==0){
			return array();
		}
        while($result = $smt->fetch_assoc()){
			$row[]=$result;
		}

        return $row;
    }
	
	public function getRecord($table, $selectfield=[], $where=[]) {
		$andWhere = "";
        if (count($where) > 0) {
            $str = '';
            foreach ($where as $key => $val) {
				if(strpos($val, '!')!==false){
					$str .= $key . " != '" . $val . "' AND ";
				} else {
					$str .= $key . " = '" . $val . "' AND ";
				}
            }
            $andWhere = substr($str, 0, -5);
        }
		$andWhere = $andWhere!=""?" where ".$andWhere:'';
		$select = count($selectfield)>0?implode( ' , ', $selectfield):" * " ;
        $sql = "select $select  from $table $andWhere ";
		// echo  $sql ;
		// die;
        $smt = $this->db->query($sql);
        $result = $smt->fetch_assoc();
		 
        return $result;
        // }
	}

	// DB end
	
	public function create_access_token($client_id, $scope) {
        $token = array(
            "access_token" => $this->gen_access_token(),
            "expires_in" => $this->access_token_lifetime,
            "scope" => $scope
        );
    	return $token;
    }

	public function json($data) {
        if (is_array($data)) {
            return json_encode($data);
        } else {
            return json_decode($data);
        }
    }      

	public function secured_encrypt($data) {
		$first_key = base64_decode(self::FIRSTKEY);
		$second_key = base64_decode(self::SECONDKEY);    
    
		$method = "aes-256-cbc";    
		$iv_length = openssl_cipher_iv_length($method);
		$iv = openssl_random_pseudo_bytes($iv_length);
        
		$first_encrypted = openssl_encrypt($data,$method,$first_key, OPENSSL_RAW_DATA ,$iv);    
		$second_encrypted = hash_hmac('sha256', $first_encrypted, $second_key, TRUE);
            
		$output = base64_encode($iv.$second_encrypted.$first_encrypted);    
		return $output;        
	}

	public function secured_decrypt($input) {
		$first_key = base64_decode(self::FIRSTKEY);
		$second_key = base64_decode(self::SECONDKEY);            
		$mix = base64_decode($input);
        
		$method = "aes-256-cbc";    
		$iv_length = openssl_cipher_iv_length($method);
            
		$iv = substr($mix,0,$iv_length);
		$second_encrypted = substr($mix,$iv_length,64);
		$first_encrypted = substr($mix,$iv_length+64);
            
		$data = openssl_decrypt($first_encrypted,$method,$first_key,OPENSSL_RAW_DATA,$iv);
		$second_encrypted_new = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);
    
		if (hash_equals($second_encrypted,$second_encrypted_new))
			return $data;
    
		return false;
	}

// 	private function varifyToken($token) {

//         $table = 'authToken';
//         $result = $this->getRecord($token, $table);
        
//         if (count($result) > 0) {
//             if ($result['expires_in'] < time()) {
//                 $errorMsg = array('error' => 'Your Access Token has been expired', 'status' => 'failure','status_code'=>209);
//             } else if ($result['expires_in'] >= time()) {
//                 $errorMsg = array('success' => 'Your have successfully authenticate.', 'status' => 'success');
//             }
//         } else {
//             $errorMsg = array('error' => 'Your Access Token is invalid Or Incorrect', 'status' => 'failure','status_code'=>209);
//         }
//         if ($errorMsg['status'] !== 'success') {
//             $this->response($this->json($errorMsg), 200);
//         }
//     }

	
	
	public function encode($value) {
        if (!$value) {
		   return false;
	   	}
	  
		$encrypt_method = "AES-256-CBC";
		$secret_key = self::FIRSTKEY;
		$secret_iv = self::SECONDKEY;

		// hash
		$key = hash('sha256', $secret_key);
		
		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);

		// if ( $action == 'encrypt' ) {
	   	$output = openssl_encrypt($value, $encrypt_method, $key, 0, $iv);
	   	$output = base64_encode($output);
	   
	   	return $output ;
   	}
   
	public function decode($value) {
	   	if (!$value) {
			return false;
	   	}
	   
		$encrypt_method = "AES-256-CBC";
		$secret_key = self::FIRSTKEY;
		$secret_iv = self::SECONDKEY;
		$key = hash('sha256', $secret_key);
   
   		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
   		$iv = substr(hash('sha256', $secret_iv), 0, 16);
		$output = openssl_decrypt(base64_decode($value), $encrypt_method, $key, 0, $iv);
		return $output;
   	}
   
	public function upload_image($file, $n='') {

		$errors= array();
		$file_name = $file[$n]['name'];
		$temp = explode(".", $file_name);
		$newfilename = round(microtime(true)) . '.' . end($temp);
		$file_size = $file[$n]['size'];
		$file_tmp = $file[$n]['tmp_name'];
		$file_type = $file[$n]['type'];
		$ext = explode('.',$file_name);
		$file_ext = strtolower(end($ext));
		
		$expensions = array("jpeg","jpg","png");
		
		if(in_array($file_ext,$expensions)=== false){
		   $errors[]="extension not allowed, please choose a JPEG or PNG file.";
		}
		
		if($file_size > 2097152) {
		   $errors[]='File size must be excately 2 MB';
		}
		
		if(empty($errors)==true) {
		   move_uploaded_file($file_tmp,"system/uploads/upload_image/".$newfilename);
		   return $newfilename;
		} else {
		   return($errors);
		}
		
	}

	public function get_request_data(){        
    	$post = file_get_contents('php://input')!=""?json_decode(stripslashes(file_get_contents('php://input')), true):array();
    	$data = array_merge($post, $_POST, $_GET);
		$return_data = $this->cleanInputs($data);
    
    	return $return_data;
	}
	
	public function cleanInputs($data){
		$clean_input = array();
		if(is_array($data)){
			foreach($data as $k => $v){
				$clean_input[$k] = $this->cleanInputs($v);
			}
		} else {
			$data = strip_tags(trim(stripslashes($data)));
			$clean_input = trim($data);
		}
		return $clean_input;
	}

    private function gen_access_token() {
        return base64_encode(pack('N6', mt_rand(), mt_rand(), mt_rand(), mt_rand(), mt_rand(), mt_rand()));
    }

    private function gen_auth_code() {
        return base64_encode(pack('N6', mt_rand(), mt_rand(), mt_rand(), mt_rand(), mt_rand(), mt_rand()));
    }

    
    function flash_encode($string)
   {
       $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
    $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
    return str_replace($entities, $replacements, urlencode($string));
   }
                
                
		public function get_referer(){
			return $_SERVER['HTTP_REFERER'];
		}
    
    
    
    function _is_curl_installed() {
    if  (in_array  ('curl', get_loaded_extensions())) {
        return true;
    }
    else {
        return false;
    }
}

// Ouput text to user based on test

		
		function Call_Method_API($json_request,$path,$APIPATH='')
{
	
	// if($APIPATH==''){$APIPATH=APIPATH;}
	
   	 $service_url=$APIPATH."/".$path;
      //// echo $service_url ;
      //  print_r($json_request);
     // die;
        
       

// I added this 
//echo $html; 
 //die;       
        
   
	$curl = curl_init($service_url);
        
	#curl_setopt($curl, CURLOPT_URL, $service_url);
	curl_setopt($curl, CURLOPT_POST, 1);
    
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
	//curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($curl, CURLOPT_POSTFIELDS, $json_request);
        
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_TIMEOUT, 1000);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($json_request))                                                                       
); 
        
	$curl_response = curl_exec($curl);
	$responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
       //// $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
	//print_r($responseCode);
	///exit();
	print_r($curl_response);
	
	///die;
	
	curl_close($curl);
   
   
	/*
	if($responseCode!=200)
	{
		echo "Retrying for correct response.";
	}else{
		return $curl_response;
	}
	*/
	
	//return $curl_response;
}  
	
	public function responsecurl($data,$status){
		$this->_code = ($status)?$status:200;
		$this->set_headers();
		echo $data;
		///exit;
	}	
                
	public function response($data,$status){
		$this->_code = ($status)?$status:200;
		$this->set_headers();
		echo $data;
		unset($data);
		exit;
	}
		
		private function get_status_message(){
			$status = array(
						100 => 'Continue',  
						101 => 'Switching Protocols',  
						200 => 'OK',
						201 => 'Created',  
						202 => 'Accepted',  
						203 => 'Non-Authoritative Information',  
						204 => 'No Content',  
						205 => 'Reset Content',  
						206 => 'Partial Content',  
						300 => 'Multiple Choices',  
						301 => 'Moved Permanently',  
						302 => 'Found',  
						303 => 'See Other',  
						304 => 'Not Modified',  
						305 => 'Use Proxy',  
						306 => '(Unused)',  
						307 => 'Temporary Redirect',  
						400 => 'Bad Request',  
						401 => 'Unauthorized',  
						402 => 'Payment Required',  
						403 => 'Forbidden',  
						404 => 'Not Found',  
						405 => 'Method Not Allowed',  
						406 => 'Not Acceptable',  
						407 => 'Proxy Authentication Required',  
						408 => 'Request Timeout',  
						409 => 'Conflict',  
						410 => 'Gone',  
						411 => 'Length Required',  
						412 => 'Precondition Failed',  
						413 => 'Request Entity Too Large',  
						414 => 'Request-URI Too Long',  
						415 => 'Unsupported Media Type',  
						416 => 'Requested Range Not Satisfiable',  
						417 => 'Expectation Failed',  
						500 => 'Internal Server Error',  
						501 => 'Not Implemented',  
						502 => 'Bad Gateway',  
						503 => 'Service Unavailable',  
						504 => 'Gateway Timeout',  
						505 => 'HTTP Version Not Supported');
			return ($status[$this->_code])?$status[$this->_code]:$status[500];
		}
		
	public function get_request_method(){
		return $_SERVER['REQUEST_METHOD'];
	}
		
	private function inputs(){
		switch($this->get_request_method()){
			case "POST":
				$this->_request = $this->cleanInputs($_POST);
				break;
			case "GET":
			case "DELETE":
				$this->_request = $this->cleanInputs($_GET);
				break;
			case "PUT":
				parse_str(file_get_contents("php://input"),$this->_request);
				$this->_request = $this->cleanInputs($this->_request);
				break;
			default:
				$this->response('',406);
				break;
		}
	}		
		
	
		
		private function set_headers(){
			header("HTTP/1.1 ".$this->_code." ".$this->get_status_message());
			header("Content-Type:".$this->_content_type);
		}
}