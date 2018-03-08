<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT=NO-CACHE"">
<?php require 'plugin.php'; ?>
</head>
<body>
<?php require 'cover.php'; ?>
<div id="contain">
<div id="app">
<legend><div class="header">ลงทะเบียนนักเรียน</div></legend>
<?php
    $id = GetIdUser();
    $sql = mysqli_query($status,"select * from data_std where user = '$id'");
    $data = mysqli_fetch_array($sql);
    if(isset($data['user'])){
        echo '
            <div class="alert alert-block">
                <strong>คำเตือน!</strong> โปรดแก้ไขเฉพาะช่องที่ต้องการเปลี่ยนข้อมูลเท่านั้น
            </div>
        ';
    }
?>
<div class="alert alert-info">
    โปรดกรอกข้อมูลให้ครบในช่องที่มีเครื่องหมาย <font color="red">*</font> นำหน้า
</div>
<br /><br />
<form method="post" class="form-horizontal">
    <label class="control-label" for="title">คำนำหน้า : </label>
    <div class="controls">
    <select name="title">
        <?php
        if(!isset($data['title']))
            echo "<option></option>";
        else
            echo "<option>".$data['title']."</option>";
        ?>
        <option>เด็กชาย</option><option>เด็กหญิง</option>
        <option>นาย</option><option>นางสาว</option>
    </select>
    </div><br>
	<label class="control-label" for="name"><font color="red">*</font> ชื่อ(ภาษาไทย) : </label>
    <div class="controls"><input type="text" name="name" value="<?php echo $data['name']; ?>" required ></div><br>
   	<label class="control-label" for="surname"><font color="red">*</font> นามสกุล(ภาษาไทย) : </label>
    <div class="controls"><input type="text" name="surname" value="<?php echo $data['surname']; ?>" required ></div><br>
   	<label class="control-label" for="nickname"><font color="red">*</font> ชื่อเล่น(ภาษาไทย) : </label>
    <div class="controls"><input type="text" name="nickname" required value="<?php echo $data['nickname']; ?>"></div><br>
    <label class="control-label" for="sex">เพศ : </label>
    <div class="controls">
    <select name="sex">
        <?php
        if(!isset($data['sex']))
            echo "<option></option>";
        else
            echo "<option>".$data['sex']."</option>";
        ?>
        <option>ชาย</option><option>หญิง</option>
    </select>
    </div><br>
    <label class="control-label" for="class"><font color="red">*</font> ชั้น : </label>
    <div class="controls">
    <select name="class" required>
        <?php
        if(!isset($data['class']))
            echo "<option></option>";
        else
            echo "<option>".$data['class']."</option>";
        ?>
        <option>1/1</option><option>1/2</option><option>1/3</option><option>1/4</option><option>2/1</option>
        <option>2/2</option><option>2/3</option><option>2/4</option><option>3/1</option><option>3/2</option><option>3/3</option>
        <option>3/4</option><option>3/5</option><option>4/1</option><option>4/2</option><option>4/3</option><option>4/4</option>
        <option>4/5</option><option>4/6</option><option>4/7</option><option>5/1</option><option>5/2</option><option>5/3</option>
        <option>5/4</option><option>5/5</option><option>5/6</option><option>5/7</option><option>6/1</option><option>6/2</option>
        <option>6/3</option><option>6/4</option><option>6/5</option><option>6/6</option>
    </select>
    </div><br>
    <label class="control-label" for="number_class"><font color="red">*</font> เลขที่(ในห้องเรียน) : </label>
    <div class="controls"><input type="text" name="number_class" onkeyup='checkNumber(this)' value="<?php echo $data['number_class']; ?>" required ></div><br>
    <label class="control-label" for="number">เลขประจำตัวนักเรียน : </label>
    <div class="controls"><input type="text" name="number" onkeyup='checkNumber(this)' value="<?php echo $data['number']; ?>"></div><br>
    <label class="control-label" for="birthday">วันเกิด(ปีค.ศ.) : </label>
    <div class="controls"><input type="date" name="birthday" value="yyyy-mm-dd" value="<?php echo $data['birthday']; ?>"></div><br>
   	<label class="control-label" for="address">ที่อยู่ : </label>
    <div class="controls"><textarea rows="10" cols="10" name="address"><?php echo $data['address']; ?></textarea></div><br>
   	<label class="control-label" for="mail">E-Mail : </label>
    <div class="controls"><input  type="email" name="mail" value="<?php echo $data['email']; ?>"></div><br>
   	<label class="control-label" for="phone"><font color="red">*</font> เบอร์โทรติดต่อ : </label>
    <div class="controls"><input type="text" name="phone" onkeyup='checkNumber(this)' value="<?php echo $data['phone'] ; ?>" maxlength="10" required></div><br>
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
$id = GetIdUser();
$title = htmlspecialchars($_POST["title"] ,ENT_QUOTES);
$name = htmlspecialchars($_POST["name"] ,ENT_QUOTES);
$surname = htmlspecialchars($_POST["surname"] ,ENT_QUOTES);
$nickname = htmlspecialchars($_POST["nickname"] ,ENT_QUOTES);
$sex = htmlspecialchars($_POST['sex'],ENT_QUOTES);
$birthday = htmlspecialchars($_POST["birthday"] ,ENT_QUOTES);
$address = htmlspecialchars($_POST["address"] ,ENT_QUOTES);
$mail = htmlspecialchars($_POST["mail"] ,ENT_QUOTES);
$phone = htmlspecialchars($_POST["phone"] ,ENT_QUOTES);
$class = htmlspecialchars($_POST["class"] ,ENT_QUOTES);
$number = htmlspecialchars($_POST["number"] ,ENT_QUOTES);
$number_class = htmlspecialchars($_POST["number_class"] ,ENT_QUOTES);

if($name != NULL || $name != $name)
{
    if(preg_match('/^[^a-zA-Z0-9,.?;:\'"!$%()]+$/', $name) && preg_match('/^[^a-zA-Z0-9,.?;:\'"!$%()]+$/', $surname) && preg_match('/^[^a-zA-Z0-9,.?;:\'"!$%()]+$/', $nickname)){
        if(empty($data['user'])){
            $query = ("insert into data_std(title,user,name,surname,nickname,sex,birthday,address,email,phone,class,number,number_class) values('$title','$id','$name','$surname','$nickname','$sex','$birthday','$address','$mail','$phone','$class','$number','$number_class')");
            echo '<script>alert("ลงทะเบียนสำเร็จ");</script>';
        }
        else if(isset($data['user'])){
            $query = ("update data_std set ");
            if(isset($name)) $query = $query."name='".$name."' ";
            if(!empty($title)) $query = $query.",title='".$title."' ";
            if(!empty($surname)) $query = $query.",surname='".$surname."' ";
            if(!empty($nickname)) $query = $query.",nickname='".$nickname."' ";
            if(!empty($sex)) $query = $query.",sex='".$sex."' ";
            if(!empty($birthday)) $query = $query.",birthday='".$birthday."' ";
            if(!empty($address)) $query = $query.",address='".$address."' ";
            if(!empty($mail)) $query = $query.",email='".$mail."' ";
            if(!empty($phone)) $query = $query.",phone='".$phone."' ";
            if(!empty($class)) $query = $query.",class='".$class."' ";
            if(!empty($number)) $query = $query.",number='".$number."' ";
            if(!empty($number_class)) $query = $query.",number_class='".$number_class."' ";
            $query = ($query."where user=".$id);
            echo '<script>alert("อัพเดตสำเร็จ");</script>';
        }
        else{
            echo '<script>alert("มีข้อผิดพลาด โปรดติดต่อผู้ดูแลระบบ");</script>';
        }
    	mysqli_query($status,$query) or die("Error Sql Database!");
    	echo '<script>window.location.href="index.php"</script>';
    }
    else echo '<script>alert("กรุณาใช้ภาษาไทย");</script>';
}
mysqli_close($status);
?>

</body>
</html>