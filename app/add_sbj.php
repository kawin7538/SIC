<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT=NO-CACHE"">
<?php
	require 'plugin.php';
	GetAdmin();
?>
</head>
<body>
<?php require 'cover.php'; ?>	
<div id="contain">
<div id="app">
<legend><div class="header">เพิ่มวิชาเสริม</div></legend><br>
<form method="post" class="form-horizontal">
	<label class="control-label" for="sbj">ชื่อวิชาเสริม : </label>
    <div class="controls"><input type="text" name="sbj" required></div><br>
	<label class="control-label" for="name">อาจารย์ที่ปรึกษา : </label>
    <div class="controls"><input type="text" name="name"></div><br>
    <label class="control-label" for="name">จำนวนสมาชิก : </label>
    <div class="controls"><input type="text" name="limit" onkeyup='checkNumber(this)' required></div><br>
   	<label class="control-label" for="describe">คำอธิบายเพิ่มเติม : </label>
    <div class="controls"><textarea rows="10" cols="10" name="describe"></textarea></div><br>
    <div class="well">
		<label class="control-label" for="condition">เงื่อนไขพิเศษ : </label>
	    <div name="condition" class="controls">
	    	<div class="row">
			    <div class="span2">
				    <input type="checkbox" name="1" value="1"> มัธยมศึกษาปีที่ 1</input><br>
				    <input type="checkbox" name="2" value="2"> มัธยมศึกษาปีที่ 2</input><br>
				    <input type="checkbox" name="3" value="3"> มัธยมศึกษาปีที่ 3</input><br>
				    <input type="checkbox" name="4" value="4"> มัธยมศึกษาปีที่ 4</input><br>
				    <input type="checkbox" name="5" value="5"> มัธยมศึกษาปีที่ 5</input><br>
				    <input type="checkbox" name="6" value="6"> มัธยมศึกษาปีที่ 6</input><br>
			    </div>
			    <div class="span4">
			    	<label class="control-label" for="male">สมาชิกชาย : </label>
			    	<div class="controls"><input class="input-mini" type="text" name="male" onkeyup="MaxValue(this.form)"></div><br>
			    	<label class="control-label" for="female">สมาชิกหญิง : </label>
			    	<div class="controls"><input class="input-mini" type="text" name="female" onkeyup="MaxValue(this.form)"></div>
			    </div>
			</div>
	    </div>
	</div>
	<div class="form-actions">
	  <button type="submit" class="btn btn-primary">บันทึก</button>
	  <button type="button" class="btn">ยกเลิก</button>
	</div>
</form>
</div>
<?php require 'footer.php';  ?>
</div>

<!-- database section -->
<?php
require 'header.php';
$sbj = htmlspecialchars($_POST['sbj'] ,ENT_QUOTES);
$name = htmlspecialchars($_POST['name'] ,ENT_QUOTES);
$limit = htmlspecialchars($_POST['limit'] ,ENT_QUOTES);
$describe = htmlspecialchars($_POST['describe'] ,ENT_QUOTES);
$m1 = htmlspecialchars($_POST['1'] ,ENT_QUOTES);
$m2 = htmlspecialchars($_POST['2'] ,ENT_QUOTES);
$m3 = htmlspecialchars($_POST['3'] ,ENT_QUOTES);
$m4 = htmlspecialchars($_POST['4'] ,ENT_QUOTES);
$m5 = htmlspecialchars($_POST['5'] ,ENT_QUOTES);
$m6 = htmlspecialchars($_POST['6'] ,ENT_QUOTES);
$male = htmlspecialchars($_POST['male'] ,ENT_QUOTES);
$female = htmlspecialchars($_POST['female'] ,ENT_QUOTES);

if($sbj != NULL || $sbj != $sbj)
{
	/* Create string for condition checkbox */
	if(empty($m1) && empty($m2) && empty($m3) && empty($m4) && empty($m5) && empty($m6))
		$string_condition_m = null;
	else
		$string_condition_m = $m1.','.$m2.','.$m3.','.$m4.','.$m5.','.$m6.',';

	$sql = mysqli_query($status,"select sbj from data_sbj where sbj = '$sbj'");
	$empty = mysqli_fetch_array($sql);
	if(empty($empty)){
		$sql = mysqli_query($status,"select count(*) from data_sbj");
		$count = mysqli_fetch_array($sql);
		$sql = ("insert into data_sbj(sbj,limit_member,teacher,des,condition_m,condition_s_m,condition_s_fm) values('$sbj','$limit','$name','$describe','$string_condition_m','$male','$female')");
		mysqli_query($status,$sql) or die("Error Sql Database!" . mysqli_error());
		echo '<script>alert("เพิ่มวิชาเสริมสำเร็จ");</script>';
	}
	else{
		echo '<script>alert("ชื่อวิชาเสริมนี้ได้ถูกใช้แล้ว โปรดใช้ชื่อใหม่");</script>';
	}
}
?>
</body>
</html>