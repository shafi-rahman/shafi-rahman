<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
date_default_timezone_set("Asia/kolkata");
ini_set('memory_limit', '10240M');
ini_set('max_input_time', 60000);
ini_set('max_execution_time', 60000);
ini_set('post_max_size', '102400M');
ini_set('upload_max_size', '10240M');

require("inc/Rest.inc.php");
require_once('inc/config.php');



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once('inc/PHPMailer-master/src/Exception.php');
require_once('inc/PHPMailer-master/src/PHPMailer.php');
require_once('inc/PHPMailer-master/src/SMTP.php');



class API extends REST {
    public function __construct() {
        parent::__construct();
        
    	
    }

	public function processApi() {
    	$func = strtolower(trim(str_replace("/", "", $_REQUEST['action'])));
        if ((int) method_exists($this, $func) > 0)
            $this->$func();
        else
            $this->response('', 404);
    }
	
	private function phpinfo() {
    	phpinfo();
    }
	
	public function test_api_call(){

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://dummyjson.com/products',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		));

		$response = curl_exec($curl);

		curl_close($curl);
		echo $response;
		
	}
	
	public function send_mail(){
		echo "<h5>send mail method</h5>";
		
		ini_set("SMTP","172.22.10.60");
		ini_set("smtp_port","25");
   
		ini_set( 'display_errors', 1 );
		error_reporting( E_ALL );
		
		$from = 'no-reply@qrcs.org.qa'; 
		$to = 'h.habeeb@qrcs.org.qa';
		


		//Create an instance; passing `true` enables exceptions
		$mail = new PHPMailer(true);

		//echo "<pre>"; print_r($mail); echo "</pre>";


		try {
			//Server settings
			$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
			$mail->isSMTP();                                            //Send using SMTP
			$mail->Host       = '172.22.10.60';                     //Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			$mail->Username   = 'no-reply@qrcs.org.qa';                     //SMTP username
			//$mail->Password   = 'secret';                               //SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
			$mail->Port       = 25;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`



		/*
		$mail = new PHPMailer;
		$mail->setFrom('xxxx@domainname.com', 'First Last');
		$mail->addAddress("xxxx@domainname.com", "Recepient Name");
		$mail->addReplyTo("xxxx@domainname.com", "Reply");
		$mail->isHTML(true);

		$mail->Subject = "Subject Text";
		$mail->Body = "<i>Mail body in HTML</i>";
		$mail->AltBody = "This is the plain text version of the email content";
		*/

			//Recipients
			$mail->setFrom('no-reply@qrcs.org.qa', 'Mailer');
			$mail->addAddress('h.habeeb@qrcs.org.qa', 'Joe User');     //Add a recipient
			
		/*	
			$mail->addAddress('ellen@example.com');               //Name is optional
			$mail->addReplyTo('info@example.com', 'Information');
			$mail->addCC('cc@example.com');
			$mail->addBCC('bcc@example.com');

			//Attachments
			$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
			$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name


		*/
			//Content
			$mail->isHTML(true);                                  //Set email format to HTML
			$mail->Subject = 'Here is the subject';
			$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			$mail->send();
			echo 'Message has been sent';
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}




	}
	
	public function get_check_existence(){
    	// get data
    	$data = $this->get_request_data();
    	// check access token
    	// $this->varifyToken($data['access_token']);
		

		$val = $data['val'];
        $col = $data['chkfor'];
    	$data = $this->getRecord("ts_user_details", array($col), array($col=>$val));
		
		$qry = "SELECT $col FROM ts_user_details WHERE $col='$val'";
	    $result = $this->run_query($qry)[0];
			
		if(count($result)>=1){
    		echo json_encode(array('status'=>'Success', 'status_code'=>200, 'data'=>false));
    	} else {
    		echo json_encode(array('status'=>'Success', 'status_code'=>201, 'data'=>true));
    	}
    }	
	
	
	public function get_location(){
    	// get data
    	$data = $this->get_request_data();
    	// check access token
    	// $this->varifyToken($data['access_token']);
		

    	$data = $this->getAllRecord("ts_location_n", array('id', 'location_name'), array('pId'=>$data['pid'], 'bolStatus'=>'1'));
    	
    	if(count($data)>=1){
    		echo json_encode(array('status'=>'Success', 'status_code'=>200, 'data'=>$data));
    	} else {
    		echo json_encode(array('status'=>'Success', 'status_code'=>201, 'data'=>array()));
    	}
    }	
	
	public function logout(){
		unset($_SESSION['userdata']);
		session_destroy ();
		echo "1";
	}
	
	

	public function login() {
        if ($this->get_request_method() != "POST") {
            $this->response('', 406);
        }
    
     	$data = $this->get_request_data();
    
		$username	= $data['username'];
        $password 	= $data['password'];
    
        if (!empty($username) && !empty($password)) {
			$qry = "SELECT U.id, U.intUserId, U.intUserRoleId, U.intUserManagerId, U.strUserName, U.strUserNationality, U.strUserCurrentPosition, R.strUserRoleName, U.strUserImage FROM ts_user_details U, ts_user_role R WHERE R.intUserRoleId=U.intUserRoleId AND U.strUserLoginName='$username' AND U.strUserLoginPassword='$password'";
	      	$result = $this->run_query($qry)[0];
        	if(count($result)>0){
				$rtndata = array('status'=>"Success", "msg"=>"Successfull Login", 'status_code'=>200, 'data'=>$result);
			} else {
				$rtndata = array('status'=>"Failure", "msg"=>"Invalid Username and Password", 'status_code'=>201, 'data'=>array());
			}
        } else {
			$rtndata = array('status'=>"Failure", "msg"=>"Username and Password can not be empty", 'status_code'=>201, 'data'=>array());
		}
        $this->response($this->json($rtndata), 200);
    }

	public function check_asset_number(){	
        if ($this->get_request_method() != "POST") {
            $this->response('', 406);
        }
    
     	$data 		= $this->get_request_data();
		$asset_no 	= $data['asset_no'];
		$dtbl 		= $data['type']=="GMR"?"ts_facility_assets":"ts_m_it_assests";
		
		$result = $this->run_query('SELECT * FROM '.$dtbl.' WHERE asset_no="'.$asset_no.'"')[0];
		if(count($result)>0){
			$rtndata = array('status'=>"Success", "msg"=>"Get data", 'status_code'=>200, 'data'=>$result);
		} else {
			$rtndata = array('status'=>"Failure", "msg"=>"No data fount", 'status_code'=>201, 'data'=>array());
		}
	
        $this->response($this->json($rtndata), 200);
	}
	
	public function get_next_list(){	
        if ($this->get_request_method() != "POST") {
            $this->response('', 406);
        }
    
     	$data 	= $this->get_request_data();
		$pid 	= $data['pId'];
		$nid 	= $data['nid'];
		$cid 	= $data['cid'];
		$dtbl 	= $data['type']=="GMR"?"ts_facility_assets":"ts_m_it_assests";
		if (!empty($nid)) {
			switch($nid){
				case 'rooms': $qry = 'SELECT room_no_area as name, room_no_area as id FROM '.$dtbl.' WHERE location="'.$pid.'" GROUP BY room_no_area'; break;
				case 'assests': $qry = 'SELECT title as id, CONCAT(asset_type, " [", title, " | ", asset_no, "]") as name, asset_no, title, room_no_area, model, item_type, status FROM '.$dtbl.' WHERE room_no_area="'.$pid.'"'; break;
			}
			$result = $this->run_query($qry);
			if(count($result[0])>0){
				$rtndata = array('status'=>"Success", "msg"=>"Get data", 'status_code'=>200, 'data'=>$result);
			} else {
				$rtndata = array('status'=>"Failure", "msg"=>"No data fount", 'status_code'=>201, 'data'=>array());
			}
        } else {
			$rtndata = array('status'=>"Failure", "msg"=>"Last location can not be empty", 'status_code'=>201, 'data'=>array());
		}
        $this->response($this->json($rtndata), 200);
	}
	
	
	
	
/*	
	// private function get_review_survey_list(){
    // 	// get data
    // 	$data = $this->get_request_data();
    // 	// check access token
    // 	$this->varifyToken($data['access_token']);
    
    // 	global $wpdb;
    // 	$surveys 	= $wpdb->prefix."survey";
    // 	$scvrtm 	= $wpdb->prefix."survey_community_vote_rights_tracking_matrix";
    // 	$sgu_id 	= $wpdb->prefix."surveyor_group_users";
    // 	$scv 		= $wpdb->prefix."survey_community_voting";
    // 	$asq 		= $wpdb->prefix."ayssurvey_questions";
    // 	$spvq 		= $wpdb->prefix."survey_priority_voting_questions";
    
    // 	$group_id	= $wpdb->get_row("SELECT surveyor_group_id FROM $sgu_id WHERE user_id='".$data['user_id']."' AND status=1 AND is_team_leader=1", ARRAY_A)['surveyor_group_id'];
    
    // 	$survey_data = array();
    // 	if($group_id!==NULL){
               
    //     	$survey_data = $wpdb->get_results("SELECT S.id survey_id, RM.id as rmid, S.problem_statement title, S.survey_address, RM.assign_group_date assigned_date, S.ayssurvey_survey_id, LOWER(Q.question_response) issue FROM $surveys S, $scvrtm RM, $scv CV, $spvq PV, $asq Q WHERE Q.id=PV.question_id AND PV.id=CV.question_id AND CV.id=RM.community_voting_id AND S.id=RM.survey_id AND RM.assign_group=$group_id AND RM.status=0", ARRAY_A);
    // 	}
    	
    // 	if(count($survey_data)>=1){
    // 		echo json_encode(array('status'=>'Success', 'status_code'=>200, 'data'=>$survey_data));
    // 	} else {
    // 		echo json_encode(array('status'=>'Success', 'status_code'=>201, 'data'=>array()));
    // 	}
    // }
	
	// private function submit_review_survey_details(){
    // 	// get data
    // 	$data = $this->get_request_data();
    // 	// check access token
    // 	// $this->varifyToken($data['access_token']);
    	
    // 	global $wpdb; 
    // 	$scvrtm = $wpdb->prefix."survey_community_vote_rights_tracking_matrix";
    // 	$scvrtmr = $wpdb->prefix."survey_community_vote_rights_tracking_matrix_review";
    	
    // 	$jdata = json_decode(stripslashes($data['data']), true);
    // 	$scvrm_id = trim(str_replace('"','',stripslashes($data['rmid'])));
    // 	$user_id = trim(str_replace('"','',stripslashes($data['user_id'])));
        	
    // 	$wpdb->insert('survey_data', array('ddata'=>$data['data'], 'data'=>json_encode(array('post'=>$data, 'file'=>$_FILES))));
    // 	// $wpdb->insert('survey_data', array('ddata'=>$scvrm_id, 'data'=>$jdata['is_the_issue_fixed']));
    
    // 	if($jdata['is_the_issue_fixed']=="Yes"){
    //     	$wpdb->update($scvrtm, array('status'=>1), array('id'=>$scvrm_id));
    //     } 
    
    // 	$wpdb->insert($scvrtmr, array('scvrm_id'=>$scvrm_id, 'comments'=>$jdata['comments'], 'review_date'=>date("Y-m-d H:i:s"), 'longitude'=>$jdata['longitude'], 'latitude'=>$jdata['latitude'], 'is_the_issue_fixed'=>$jdata['is_the_issue_fixed'], 'review_by'=>$user_id, 'photo_1'=>pathinfo($jdata['photo1']['path'])['filename'].".".pathinfo($jdata['photo1']['path'])['extension'], 'photo_2'=>pathinfo($jdata['photo2']['path'])['filename'].".".pathinfo($jdata['photo2']['path'])['extension']));
    // 	$this->submit_survey_images();
    
    // 	echo json_encode(array('status'=>'Success', 'status_code'=>201, 'data'=>array("message"=>"Successfully stored")));
    // }

	private function get_survey_details(){
    	// get data
    	$data = $this->get_request_data();
    	// check access token
    	$this->varifyToken($data['access_token']);
    
    	global $wpdb;
    
    	$survey 	= $wpdb->prefix."ayssurvey_surveys";
    	$section	= $wpdb->prefix."ayssurvey_sections";
    	$question	= $wpdb->prefix."ayssurvey_questions";
    	$answer		= $wpdb->prefix."ayssurvey_answers";
    
    	$section_ids = $wpdb->get_results("SELECT section_ids FROM $survey WHERE id='".$data['ayssurvey_survey_id']."' ORDER BY ordering ASC", ARRAY_A)[0]['section_ids']; 
    	$sectiondata = $wpdb->get_results("SELECT id, title FROM $section WHERE id IN ($section_ids)", ARRAY_A); 
    	
    	if(count($sectiondata)>=1){
        	$survey_details = array();
    		foreach($sectiondata as $i=>$session){
            	$survey_details['session'][$i]['id'] = $session['id'];
            	$survey_details['session'][$i]['title'] = $session['title'];
            	$sectionquestiondata = $wpdb->get_results("SELECT id, question, type, status FROM $question WHERE section_id='".$session['id']."' ORDER BY ordering ASC", ARRAY_A); 
            	if(count($sectionquestiondata)>=1){
                	foreach($sectionquestiondata as $j=>$que){
                		$survey_details['session'][$i]['questions'][$j]['id'] = $que['id'];
                		$survey_details['session'][$i]['questions'][$j]['question'] = $que['question'];
                		$survey_details['session'][$i]['questions'][$j]['type'] = $que['type'];
                		$survey_details['session'][$i]['questions'][$j]['status'] = $que['status'];
                    	$questionanswerdata = $wpdb->get_results("SELECT id, answer FROM $answer WHERE question_id='".$que['id']."' ORDER BY ordering ASC", ARRAY_A);
            			if(count($questionanswerdata)>=1){
                			foreach($questionanswerdata as $k=>$ans){
                    			$survey_details['session'][$i]['questions'][$j]['answer'][$k]['id'] = $ans['id'];
                    			$survey_details['session'][$i]['questions'][$j]['answer'][$k]['answer'] = $ans['answer'];
                        	}
                        } else {
                        	$survey_details['session'][$i]['questions'][$j]['answer'][0]['id'] = $que['id'];
                    		$survey_details['session'][$i]['questions'][$j]['answer'][0]['answer'] = '';
                        }
                    }
                }
            }
        }
    
    	if(count($survey_details)>=1){
    		echo json_encode(array('status'=>'Success', 'status_code'=>200, 'data'=>$survey_details));
    	} else {
    		echo json_encode(array('status'=>'Success', 'status_code'=>201, 'data'=>array()));
    	}
    }	

	private function submit_survey_details(){
    
    	$data = $this->get_request_data();
    	// check access token
    	// $this->varifyToken($data['access_token']);
    
    	global $wpdb;
    	$survey_submit = $wpdb->prefix."ayssurvey_submissions_questions";
    	$survey_rounds = $wpdb->prefix."ayssurvey_submissions_rounds";
    	$survey = $wpdb->prefix."survey";
       	$insertData = array();
    	$cont = 0;
    
    	// save row data
    	$wpdb->insert('survey_data', array('ddata'=>$data['data'], 'data'=>json_encode(array('post'=>$data, 'file'=>$_FILES))));
    
    	$sdata = json_decode(str_replace("\n", " ", stripslashes($data['data'])), true);    
    	$tcount = count($sdata);
    	$r = 1;
    	
    	$survey_id = str_replace('"', "", stripslashes($data['survey_id']));
    	$user_id = str_replace('"', "", stripslashes($data['user_id']));
    	$ayssurvey_survey_id = str_replace('"', "", stripslashes($data['ayssurvey_survey_id']));
    
    	foreach($sdata as $round){
        	$ins_round['survey_id'] = $survey_id;
        	$ins_round['round_no'] = $r;
        	$ins_round['issue_category'] = $round['issuecata'];
        	$ins_round['issue_faced_since'] = $round['issue_faced_since'];
        	$ins_round['authority_approached'] = $round['authority_approached'];
        	$ins_round['latitude'] = $round['latitude'];
        	$ins_round['longitude'] = $round['longitude'];
        	$ins_round['location_title'] = $round['locationtitle'];
        	$ins_round['location_issue_1'] = $round['location_issue_1'];
        	$ins_round['photo1'] = pathinfo($round['photo1']['path'])['filename'].".".pathinfo($round['photo1']['path'])['extension'];
        	$ins_round['photo2'] = pathinfo($round['photo2']['path'])['filename'].".".pathinfo($round['photo2']['path'])['extension'];
        	$ins_round['location_issue_2'] = $round['location_issue_2'];
        	$ins_round['photo3'] = pathinfo($round['photo3']['path'])['filename'].".".pathinfo($round['photo3']['path'])['extension'];
        	$ins_round['photo4'] = pathinfo($round['photo4']['path'])['filename'].".".pathinfo($round['photo4']['path'])['extension'];
        	$ins_round['location_issue_3'] = $round['location_issue_3'];
        	$ins_round['photo5'] = pathinfo($round['photo5']['path'])['filename'].".".pathinfo($round['photo5']['path'])['extension'];
        	$ins_round['photo6'] = pathinfo($round['photo6']['path'])['filename'].".".pathinfo($round['photo6']['path'])['extension'];
        	$ins_round['location_issue_4'] = $round['location_issue_4'];
        	$ins_round['photo7'] = pathinfo($round['photo7']['path'])['filename'].".".pathinfo($round['photo7']['path'])['extension'];
        	$ins_round['photo8'] = pathinfo($round['photo8']['path'])['filename'].".".pathinfo($round['photo8']['path'])['extension'];
        	$ins_round['location_issue_5'] = $round['location_issue_5'];
        	$ins_round['photo9'] = pathinfo($round['photo9']['path'])['filename'].".".pathinfo($round['photo9']['path'])['extension'];
        	$ins_round['photo10'] = pathinfo($round['photo10']['path'])['filename'].".".pathinfo($round['photo10']['path'])['extension'];
        	$ins_round['location_issue_6'] = $round['location_issue_6'];
        	$ins_round['photo11'] = pathinfo($round['photo11']['path'])['filename'].".".pathinfo($round['photo11']['path'])['extension'];
        	$ins_round['photo12'] = pathinfo($round['photo12']['path'])['filename'].".".pathinfo($round['photo12']['path'])['extension'];
        	$ins_round['conclusion'] = $round['conclusion'];
        	$ins_round['current_date_time'] = date("Y-m-d H:i:s", strtotime(str_replace("/","-",$round['current_date_time'])));
        
        	// print_r($ins_round);
        	if($wpdb->insert($survey_rounds, $ins_round)){
           		$ins_data['survey_id'] = $survey_id;
    			$ins_data['user_id'] = $user_id;
    			$ins_data['ayssurvey_survey_id'] = $ayssurvey_survey_id;
            	$ins_data['round_id'] = $wpdb->insert_id;
              	foreach($round['sessions'] as $session){
            		$ins_data['section_id'] = $session['session_id'];
            		foreach($session['questions'] as $question){              
            			$ins_data['question_id'] = $question['questions_id'];
            			$ins_data['type'] = 'radio'; //($question['type']=="yesorno")?"radio":$question['type'];
                		foreach($question['answered'] as $answered){
                			$ins_data['answer_id'] = $answered['id'];
                			$ins_data['answer_text'] = $answered['answer'];
                	    	// print_r($ins_data);
                    		if($wpdb->insert($survey_submit, $ins_data)){
                				$cont++;
                        	}
                		}
                	}
                }
            }
        	$r++;
        }
    
    	if($tcount==($r-1)){
        	$wpdb->update($survey, array('status'=>2, 'rating'=>$data['rating']), array('id'=>$survey_id));
        	$this->submit_survey_images();
        }

    	echo json_encode(array('status'=>'Success', 'status_code'=>200, 'inserted_q'=>$cont, 'inserted_r'=>($r-1)));
    }

	private function submit_survey_images(){
    	$files 	= $_FILES;
    	$fcount = count($files['file']['name']);
    	$icount = 0;
    	for($i=0; $i<$fcount; $i++){
    		$tmp_name 	= $files['file']['tmp_name'][$i];
    		$target 	= "../../uploads/upload_image/".$files['file']['name'][$i];
    		move_uploaded_file($tmp_name, $target);
    	}
    }

	private function get_survey_priority_voting_question_list(){
    	// get data
    	$data = $this->get_request_data();
    	// check access token
    	$this->varifyToken($data['access_token']);
    	if($data['login_for']!="priority_voting"){
        	$errorMsg = array('error' => 'Not Authorized', 'status' => 'failure','status_code'=>209);
        	$this->response($this->json($errorMsg), 200);
        } else {
    		global $wpdb;
    		$surveys_priority_voting_questions 	= $wpdb->prefix."survey_priority_voting_questions";
    		$users 	= $wpdb->prefix."users";
    		$survey = $wpdb->prefix."survey";
        	//echo "SELECT Q.id, Q.survey_id, Q.priority_voting_question FROM $surveys_priority_voting_questions Q, $survey S, $users U WHERE Q.survey_id=S.id AND S.voting_flag=1 AND S.centre_id=U.center_id AND U.ID='".$data['user_id']."'";
    		$priority_voting_question_list	= $wpdb->get_results("SELECT Q.id, Q.survey_id, Q.priority_voting_question FROM $surveys_priority_voting_questions Q, $survey S, $users U WHERE Q.survey_id=S.id AND S.voting_flag=1 AND S.centre_id=U.center_id AND U.ID='".$data['user_id']."'", ARRAY_A);
        	
    		if(count($priority_voting_question_list)>=1){
    			echo json_encode(array('status'=>'Success', 'status_code'=>200, 'main_heading'=>"Each COC has to select only three issues according to the priority of the Issue.", 'data'=>$priority_voting_question_list));
    		} else {
    			echo json_encode(array('status'=>'Success', 'status_code'=>201, 'data'=>array()));
    		}
        }
    }

	private function submit_survey_priority_voting_question_answer(){
    
    	$data = $this->get_request_data();
    	// check access token
    	$this->varifyToken($data['access_token']);
    
    	global $wpdb;
    	$survey_submit = $wpdb->prefix."survey_priority_voting_question_answered";
       	$msg = "";  	
    	$insertData = array();
    	$insertData['survey_id'] = $data['survey_id'];
   		$insertData['user_id'] = $data['user_id'];
    
    	$checkDone = $wpdb->get_row("SELECT count(id) as rcount FROM $survey_submit WHERE survey_id='".$data['survey_id']."' AND user_id='".$data['user_id']."'", ARRAY_A)['rcount'];
    	    
    	if(!$checkDone){
    		if(count($data['answered'])==3){
        		foreach($data['answered'] as $answered){
            		$insertData['question_answered_id'] = $answered['question_id'];
            		$insertData['date_time'] = $answered['date_time'];
            		$wpdb->insert($survey_submit, $insertData);
            	}
            	$msg = "record submited"; 
        	}
    	} else {
        	$msg = "record already submited";
        }
    	$this->response($this->json(array('status'=>'Success', 'status_code'=>200, 'msg'=>$msg)), 200);
    }

	private function get_survey_community_voting(){
    	// get data
    	$data = $this->get_request_data();
    	// check access token
    	$this->varifyToken($data['access_token']);
    
    	if($data['login_for']!="community_voting"){
        	$errorMsg = array('error' => 'Not Authorized', 'status' => 'failure','status_code'=>209);
        	$this->response($this->json($errorMsg), 200);
        } else {
            global $wpdb;
    		$users 	= $wpdb->prefix."users";
    		$surveys 	= $wpdb->prefix."survey";
    		$questions 	= $wpdb->prefix."survey_community_voting";
        
    		$sgu_id 	= $wpdb->prefix."surveyor_group_users";
    		$group_id	= $wpdb->get_row("SELECT surveyor_group_id FROM $sgu_id WHERE user_id='".$data['user_id']."' AND status=1 AND is_team_leader=1", ARRAY_A)['surveyor_group_id'];
    
    		if($group_id!==NULL){
            	$priority_community_voting_list	= $wpdb->get_results("SELECT Q.* FROM $questions Q, $surveys S, $users U WHERE Q.survey_id=S.id AND S.voting_flag=3 AND S.centre_id=U.center_id AND U.ID='".$data['user_id']."'", ARRAY_A);
        		if(count($priority_community_voting_list)>=1){
    				echo json_encode(array('status'=>'Success', 'status_code'=>200, 'main_heading'=>"this is main heading make 2 px exrta from the suestion font, i guss make 14 px font size for heading and  12px for question font size.", 'data'=>$priority_community_voting_list));
    			} else {
    				echo json_encode(array('status'=>'Success', 'status_code'=>201, 'data'=>array()));
    			}
    		} else {
    			echo json_encode(array('status'=>'Error', 'status_code'=>201, 'data'=>array("msg"=>"User must be a team leader.")));
    		}
        }
    }
		
	private function submit_survey_community_voting(){ 
    
    	// $data = $this->get_request_data();
    	$data = json_decode(file_get_contents('php://input'), true, JSON_UNESCAPED_SLASHES);
  
    	$this->varifyToken($data['access_token']);
    
    	global $wpdb;
    	$community_voting = $wpdb->prefix."survey_community_voting";
       	$msg = "";  	
    
    	$wpdb->insert('survey_data', array('ddata'=>$data, 'data'=>json_encode(array('post'=>$data, 'file'=>''))));
    
    	if(count($data['data'])>=1){
        	foreach($data['data'] as $data){
            	$id = $data['id'];
            	$survey_id = $data['survey_id'];
            	unset($data['id']);
            	unset($data['survey_id']);
            	$wpdb->update($community_voting, $data, array('id'=>$id, 'survey_id'=>$survey_id));
            }
        }
    
    	$msg = "record submited";
    	$this->response($this->json(array('status'=>'Success', 'status_code'=>200, 'msg'=>$msg)), 200);
    }


	private function get_center_group_list(){
    	$data = $this->get_request_data();
    	global $wpdb;
    	echo json_encode($wpdb->get_results("SELECT * FROM ".$wpdb->prefix."surveyor_groups WHERE center_id='".$data['center_id']."'", ARRAY_A));
    }

	private function get_question_issues(){
    	$data = $this->get_request_data();
    	$round_id = $data['round_id'];
    	$survey_id = $data['survey_id'];
    	global $wpdb;
    	echo json_encode($wpdb->get_results("select Q.id, LOWER(Q.question_response) as question_response FROM ".$wpdb->prefix."ayssurvey_submissions_questions SQ, ".$wpdb->prefix."ayssurvey_questions Q where Q.id=SQ.question_id AND Q.show_when=SQ.answer_text AND SQ.survey_id=$survey_id AND SQ.round_id=$round_id group By Q.question_response", ARRAY_A));
    }


	function test_submit(){
        // $data = $this->get_request_data();
    	// check access token
    	//$this->varifyToken($data['access_token']);
    
    	// global $wpdb;
    	// $survey_submit = $wpdb->prefix."ayssurvey_submissions_questions";
    	// $insertData = array();
    	// $i = 0;
    	
    	$dt = '{"survey_id":"\\\"112\\\"","rmid":"\\\"39\\\"","access_token":"\\\"JuB5AiALiLJNq3D+MsdSOnDfsxUMdnIY\\\"","user_id":"\\\"614\\\"","data":"{\\\"comments\\\":\\\"jfihjvjc\\\",\\\"is_the_issue_fixed\\\":\\\"Yes\\\",\\\"latitude\\\":\\\"28.6955472\\\",\\\"longitude\\\":\\\"77.2797025\\\",\\\"photo1\\\":{\\\"path\\\":\\\"\/storage\/emulated\/0\/Pictures\/PlanIndia_1648884122905.jpg\\\"},\\\"photo2\\\":{\\\"path\\\":\\\"\/storage\/emulated\/0\/Pictures\/PlanIndia_1648884129052.jpg\\\"}}","action":"submit_review_survey_details"}';
    
    	// var_dump(json_decode($dt, true));
    	// print_r(json_decode(stripslashes($dt)));
    	// echo $dt;
    	print_r(json_decode(stripslashes($dt), true));
    	// echo stripslashes($dt);
    
    
    
// 

    
    }






	// private function varifyToken($token) {
	// 	global $wpdb;
    //     $authTokentbl = $wpdb->prefix.'authToken';
    //     $result = $wpdb->get_results("SELECT * FROM $authTokentbl WHERE token='$token'", ARRAY_A)[0];        
    //     if (count($result) > 0) {
    //         if ($result['expires_in'] < time()) {
    //             $errorMsg = array('error' => 'Your Access Token has been expired', 'status' => 'failure','status_code'=>209);
    //         } else if ($result['expires_in'] >= time()) {
    //             $errorMsg = array('success' => 'Your have successfully authenticate.', 'status' => 'success');
    //         }
    //     } else {
    //         $errorMsg = array('error' => 'Your Access Token is invalid Or Incorrect', 'status' => 'failure','status_code'=>209);
    //     }
    //     if ($errorMsg['status'] !== 'success') {
    //         $this->response($this->json($errorMsg), 200);
    //     } else {
    //     	return 1;
    //     }
    // }

    function getUserIpAddr() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

	public function get_request_method(){
		return $_SERVER['REQUEST_METHOD'];
	}
	

  	private function generate_string($l=5){
    	return substr(str_shuffle("0qw12re34fz56asd7sdf8fs9qw3er234tyu2i4op5lkj5h6gf7ds33a2zxc2v234bn52m5309sdf87sdf6s5s4g3sg21sg0f"), 0, $l);
  	}

	private function gen_uuid() {
    	return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        	// 32 bits for "time_low"
        	mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        	// 16 bits for "time_mid"
        	mt_rand( 0, 0xffff ),
        	// 16 bits for "time_hi_and_version",
        	// four most significant bits holds version number 4
        	mt_rand( 0, 0x0fff ) | 0x4000,
        	// 16 bits, 8 bits for "clk_seq_hi_res",
        	// 8 bits for "clk_seq_low",
        	// two most significant bits holds zero and one for variant DCE1.1
        	mt_rand( 0, 0x3fff ) | 0x8000,
        	// 48 bits for "node"
        	mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    	);
	}
*/

}

$api = new API;
$api->processApi();


