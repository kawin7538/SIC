<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT=NO-CACHE"">
<?php
	require 'plugin.php'; 
	GetAdmin();
	$sql = mysqli_query($status,"select * from data_sbj order by sbj") or die("Error Sql Database!" . mysqli_error());
	$check_sbj_null = mysqli_query($status,"select * from data_sbj") or die("Error Sql Database!" . mysqli_error());
	$data_sbj_null = mysqli_fetch_array($check_sbj_null);
?>
</head>
<body>
<?php require 'cover.php'; ?>	
<div id="contain">
<div id="app">	
	<legend><div class="header">จัดการวิชาเสริม</div></legend>
	<?php if(!empty($data_sbj_null)){ ?>
	<br>
	<table class="table table-bordered">
	<tr><td style="width:20px"></td><th>วิชาเสริม</th><th style="width:150px">สมาชิกปัจจุบัน</th><th style="width:150px">สมาชิก</th><th>อาจารย์ที่ปรึกษา</th></tr>
	<?php
	$text1 = "'คุณต้องการที่จะแก้ไขวิชาเสริมหรือไม่'";
	$text2 = "'คุณต้องการที่จะลบวิชาเสริมหรือไม่'";
	while($data = mysqli_fetch_array($sql)){
	echo '	
			<form method="post" class="form-horizontal" onsubmit="confirm('.$text1.');">
			<div id="'.$data['ID'].'" class="modal hide fade in" style="display: none; ">  
				<div class="modal-header"><a class="close" data-dismiss="modal">×</a>
					ชื่อวิชาเสริม : <input name="title" type="text" value="'.$data['sbj'].'"></input>
				</div>  
				<div class="modal-body">
					<input type="hidden" name="id" value="'.$data['ID'].'"></input>
					<p>ครูที่ปรึกษา : <input type="text" name="teacher" value="'.$data['teacher'].'"></input></p>
					<p>สมาชิกปัจจุบัน/สมาชิก : '.$data['member'].' / <input type="text" class="input-mini" name="member" value="'.$data['limit_member'].'"></input></p>
					<p>คำอธิบาย : <textarea type="text" name="des" style="width: 97%; height: 125px;">'.$data['des'].'</textarea></p>
					<p>เงื่อนไขพิเศษ (ไม่ต้องติ้กถ้าไม่ต้องการแก้ไข) :  <br>
										<input type="checkbox" name="1" value="1"> มัธยมศึกษาปีที่ 1</input><br>
    									<input type="checkbox" name="2" value="2"> มัธยมศึกษาปีที่ 2</input><br>
									    <input type="checkbox" name="3" value="3"> มัธยมศึกษาปีที่ 3</input><br>
									    <input type="checkbox" name="4" value="4"> มัธยมศึกษาปีที่ 4</input><br>
									    <input type="checkbox" name="5" value="5"> มัธยมศึกษาปีที่ 5</input><br>
									    <input type="checkbox" name="6" value="6"> มัธยมศึกษาปีที่ 6</input><br>
									    <input type="checkbox" name="0" value="0"> ไม่มีเงื่อนไขชั้นเรียน</input><br>
					</p>
					<p>
						สมาชิกชาย : <input class="input-mini" type="text" name="male" value='.$data["condition_s_m"].' onkeyup="MaxValue(this.form)"></input>
			    		สมาชิกหญิง : <input class="input-mini" type="text" name="female" value='.$data["condition_s_fm"].' onkeyup="MaxValue(this.form)"></input>
			    	</p>
				</div>  
				<div class="modal-footer">  
					<button type="submit" class="btn btn-primary">บันทึก</button>
					<button class="btn" data-dismiss="modal" aria-hidden="true">ยกเลิก</button>
				</div>
				</form>
			</div>
			';
	echo '<form method="post" onsubmit="return confirm('.$text2.');">';
	echo '<tr><td><center><button class="btn btn-danger" type="submit" name="regis" value='.$data['ID'].'>ลบ</button></center></td>';
	echo '</form><td><a href="#'.$data['ID'].'" data-toggle="modal">'.$data['sbj'].'</a></td>';
	echo '<td>'.$data['member'].'</td>';
	echo '<td>'.$data['limit_member'].'</td>';
	echo '<td>'.$data['teacher'].'</td></tr>';
	}
	?>
</table>
<?php }else{ ?>
	<div class="alert alert-block">
  		ยังไม่มีวิชาเสริมถูกเพิ่มเข้ามา โปรดเพิ่มวิชาเสริมก่อน <a href="add_sbj.php">เพิ่มวิชาเสริม</a>
	</div>
<?php } ?>
</div>
<?php require 'footer.php';  ?>
</div>
<!-- database section -->
<?php require 'header.php'; ?>
<?php
$id = htmlspecialchars($_POST['id'] ,ENT_QUOTES);
$title = htmlspecialchars($_POST['title'] ,ENT_QUOTES);
$teacher = htmlspecialchars($_POST['teacher'] ,ENT_QUOTES);
$member = htmlspecialchars($_POST['member'] ,ENT_QUOTES);
$des = htmlspecialchars($_POST['des'] ,ENT_QUOTES);
$sbj = htmlspecialchars($_POST['regis'] ,ENT_QUOTES);
$m1 = htmlspecialchars($_POST['1'] ,ENT_QUOTES);
$m2 = htmlspecialchars($_POST['2'] ,ENT_QUOTES);
$m3 = htmlspecialchars($_POST['3'] ,ENT_QUOTES);
$m4 = htmlspecialchars($_POST['4'] ,ENT_QUOTES);
$m5 = htmlspecialchars($_POST['5'] ,ENT_QUOTES);
$m6 = htmlspecialchars($_POST['6'] ,ENT_QUOTES);
$m0 = htmlspecialchars($_POST['0'] ,ENT_QUOTES);
$male = htmlspecialchars($_POST['male'] ,ENT_QUOTES);
$female = htmlspecialchars($_POST['female'] ,ENT_QUOTES);

if($id!=NULL){
	
	/* Create string for condition checkbox */
	if(!(empty($m1) && empty($m2) && empty($m3) && empty($m4) && empty($m5) && empty($m6)))
		$string_condition_m = $m1.','.$m2.','.$m3.','.$m4.','.$m5.','.$m6.',';

	$query = ("update data_sbj set ");
    if(isset($title)) $query = $query."sbj='".$title."' ";
    if(!empty($teacher)) $query = $query.",teacher='".$teacher."' ";
    if(!empty($member)) $query = $query.",limit_member='".$member."' ";
    if(!empty($des)) $query = $query.",des='".$des."' ";
    if(!empty($string_condition_m)) $query = $query.",condition_m='".$string_condition_m."' ";
    if(!empty($male)) $query = $query.",condition_s_m='".$male."' ";
    else $query = $query.",condition_s_m='0' ";
    if(!empty($female)) $query = $query.",condition_s_fm='".$female."' ";
    else $query = $query.",condition_s_fm='0' ";
    $query = ($query."where ID='".$id."'");
    mysqli_query($status,$query) or die("Error Sql Database!" . mysqli_error());
	echo '<script>alert("แก้ไขข้อมูลวิชาเสริมสำเร็จแล้ว");</script>';
	echo '<script>window.location.href="manage_sbj.php"</script>';
}
if($sbj!=NULL){
	$sql = ("delete from sbjenrollment where sbj='$sbj'");
	mysqli_query($status,$sql) or die("Error Sql Database!" . mysqli_error());
	$sql = ("delete from data_sbj where ID='$sbj'");
	mysqli_query($status,$sql) or die("Error Sql Database!" . mysqli_error());
	echo '<script>alert("ลบวิชาเสริมสำเร็จแล้ว");</script>';
	echo '<script>window.location.href="manage_sbj.php"</script>';
}
?>
</body>
</html>