<title>SIC Project</title>
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT=NO-CACHE"">
<link rel="stylesheet" href="stylesheet/stylesheet.css">
<link rel="stylesheet" href="stylesheet/bootstrap.css">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css">
<script src="js/bootstrap.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/jquery.h5validate.js"></script>
<script src="js/modernizr-2.6.2.min.js"></script>
<script src="js/Chart.js"></script>
<!--[if lte IE 8]><script src="excanvas.js"></script><![endif]-->

<script type='text/javascript'>

function MaxValue(frm){
	var max = parseInt(frm.limit.value);
	var a = parseInt(frm.male.value);
	var b = parseInt(frm.female.value);
	if(a > max-b || b > max-a){
		alert("สมาชิกของชายและหญิงรวมกันมีมากกว่าสมาชิกทั้งหมด! โปรดป้อนข้อมูลใหม่");
		frm.male.value = "";
		frm.female.value = "";
	}
	frm.male.max = max-b;
	frm.female.max = max-a;
}


$(document).ready(function () {
    $('form').h5Validate();
});
function checkNumber(data){
 if(!data.value.match(/^\d*$/)){
    alert('กรอกตัวเลขเท่านั้น');
    data.value='';
 }
 if(!data.match( )){
    alert('กรอกตัวเลขเท่านั้น');
    data.value='';
 }
}
$(function() {
	if (!Modernizr.inputtypes['date']) {
		$('input[type=date]').datepicker({ dateFormat: 'yyyy-mm-dd',changeMonth: true,changeYear: true });
	}
});
$('#invMenu').addClass('active');
$('a[href$="/web/office/inventory/"]').attr('href', '#');
</script>

<?php

/* Connect database */
require 'sic_sql_config.php';


/* get value of student from DB */
$sql_num_student = mysqli_query($GLOBALS['status'],'select * from sic_options');
$sql_fetch_num_student = mysqli_fetch_array($sql_num_student);
$studentAll = $sql_fetch_num_student['num_student'];

/* get Max club, that student register by 1 person from DB */
$sql_max_club = mysqli_query($GLOBALS['status'],'select * from sic_options');
$sql_fetch_max_club = mysqli_fetch_array($sql_max_club);
$max_club = $sql_fetch_num_student['max_club'];

/* get Max subject, that student register by 1 person from DB */
$sql_max_sbj = mysqli_query($GLOBALS['status'],'select * from sic_options');
$sql_fetch_max_sbj = mysqli_fetch_array($sql_max_sbj);
$max_sbj = $sql_fetch_num_student['max_sbj'];

require '../wp-load.php';
function GetIdUser(){
	return get_current_user_id();
}
function GetAdmin(){
	if(GetPermission() == 0){ ?>
		<script>
			alert("คุณไม่มีสิทธิ์เข้าถึงหน้านี้");
			window.location.href="index.php";
		</script> <?php
		exit();
	}
}
function GetRoot(){
	if(GetPermission() != 2){ ?>
		<script>
			alert("คุณไม่มีสิทธิ์เข้าถึงหน้านี้ สำหรับ Root");
			window.location.href="index.php";
		</script>'; <?php
		exit();
	}
}
function GetPermission(){
	$id_header = GetIdUser();
	$sql_header = mysqli_query($GLOBALS['status'],"select permission from wp_users where ID = '$id_header'");
	$permission_header = mysqli_fetch_array($sql_header);
  	return $permission_header['permission'];
}
function checkCondition_M($club_id,$string_condition){
	$id = GetIdUser();
	$sql_checkCondition_M = mysqli_query($GLOBALS['status'],"select * from data_std where user = '$id'");
	$data_checkCondition_M = mysqli_fetch_array($sql_checkCondition_M);
	if(empty($string_condition))
		return true;
	else if(in_array($data_checkCondition_M['class'][0],$string_condition))
		return true;
	else if(in_array($data_checkCondition_M['class'][0], $string_condition) == false)
		return false;
}
function checkCondition_S($club_id){
	$id = GetIdUser();
	$sql = mysqli_query($GLOBALS['status'],"select * from data_club where ID = '$club_id'");
	$data = mysqli_fetch_array($sql);
	$limit_male = $data['condition_s_m'];
	$limit_female = $data['condition_s_fm'];

	$sql = mysqli_query($GLOBALS['status'],"select * from data_std where user = '$id'");
	$data = mysqli_fetch_array($sql);
	$sex = $data['sex'];

	$sql = mysqli_query($GLOBALS['status'],"select count(*) as count from clubenrollment inner join data_std on clubenrollment.idUser = data_std.user and data_std.sex = 'ชาย' where clubenrollment.club = '$club_id'");
	$data = mysqli_fetch_array($sql);
	$male = $data['count'];

	$sql = mysqli_query($GLOBALS['status'],"select count(*) as count from clubenrollment inner join data_std on clubenrollment.idUser = data_std.user and data_std.sex = 'หญิง' where clubenrollment.club = '$club_id'");
	$data = mysqli_fetch_array($sql);
	$female = $data['count'];

	if($limit_male == 0 && $limit_female == 0) return true;

	if($sex == 'ชาย'){
		if($male < $limit_male) return true;
		else return false;
	}
	else if($sex == 'หญิง'){
		if($female < $limit_female) return true;
		else return false;
	}
	else return false;

	/* Thank you Jitrin */
}
function checkRegister(){
	$id = GetIdUser();
	$sql_checkRegister = mysqli_query($GLOBALS['status'],"select * from data_std where user = '$id'");
	$data_checkRegister = mysqli_fetch_array($sql_checkRegister);
	if(empty($data_checkRegister)) return 0;
	else return 1;
}
function checkLimitClubStudent(){
	$limitClub = $GLOBALS['max_club'];

	$id = GetIdUser();
	$sql_checkLimitClub = mysqli_query($GLOBALS['status'],"select count(*) as countCheck from clubenrollment where idUser = '$id'");
	echo $id;
	$data_limitclub = mysqli_fetch_array($sql_checkLimitClub);
	if($data_limitclub['countCheck'] >= $limitClub) return 0;
	else if($data_limitclub['countCheck'] < $limitClub) return 1;
}
function checkLimitSbjStudent(){
	$limitSbj = $GLOBALS['max_sbj'];;
	$id = GetIdUser();
	$sql_checkLimitSbj = mysqli_query($GLOBALS['status'],"select count(*) as countCheck from sbjenrollment where idUser = '$id'");
	echo $id;
	$data_limitSbj = mysqli_fetch_array($sql_checkLimitSbj);
	if($data_limitSbj['countCheck'] >= $limitSbj) return 0;
	else if($data_limitSbj['countCheck'] < $limitSbj) return 1;
}
/* Check is_user_logged_in */
if(!is_user_logged_in()){ ?>
	<script>
		alert("คุณยังไม่ได้เข้าสู่ระบบ");
		window.location.href="../wp-login.php";
	</script> <?php
	exit();
}

/* Keep log file to database , You can view log file by check_log.php*/
$log_file = $_SERVER['REQUEST_URI'];
$id_log_file = GetIdUser();
$sql_log_file = mysqli_query($GLOBALS['status'],"select user_login from wp_users where ID = '$id_log_file'");
$data_log_file = mysqli_fetch_array($sql_log_file);
$user_log_file = $data_log_file['user_login'];
$sql = mysqli_query($GLOBALS['status'],"insert into log_file(ID,user,page,time) values('$id_log_file','$user_log_file','$log_file',Now())");

/* Clear file on database when time in field over 30 days */
mysqli_query($GLOBALS['status'],"delete from log_file where time < now() - INTERVAL 30 DAY");

/* Module enable - disable Maintenance mode */
/* Module Club */
$sql_maintenance = mysqli_query($GLOBALS['status'],'select * from sic_options');
$maintenance = mysqli_fetch_array($sql_maintenance);
$club_maintenance_mode = $maintenance['club_maintenance_mode'];

$id_permission = GetIdUser();

$sql_permission_plugins = mysqli_query($GLOBALS['status'],'select * from wp_users where id = "$id_permission"');
$data_permission_plugins = mysqli_fetch_array($sql_permission_plugins);
$check_permission_function = $data_permission_plugins['permission'];

function use_club_maintenance_mode(){
	if($GLOBALS['club_maintenance_mode'] == 1){
		header("Location: close.php");
	}
}

/* Module Subject */
$subject_maintenance_mode = $maintenance['subject_maintenance_mode'];
function use_subject_maintenance_mode(){
	if($GLOBALS['subject_maintenance_mode'] == 1){
		header("Location: close.php");
	}
}

?>