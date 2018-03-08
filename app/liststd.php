<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT=NO-CACHE"">
</head>
</head>
<body>
<?php
    require 'plugin.php'; 
    GetAdmin();
?>
<?php require 'cover.php'; ?>
<div id="contain">
<div id="app">
<legend><div class="header">จัดการนักเรียน</div></legend>
<div class="alert alert-info"><b>วิธีใช้งาน</b> โปรดเลือกแค่ตัวเลือกเดียวเท่านั้น เลือก All เพื่อดูรายชื่อนักเรียนทั้งหมด</div><br />
<form method="post" class="form-horizontal">
	<label class="control-label" for="room">ห้องเรียน : </label>
    <div class="controls">
    <select name="room">
        <option></option>
        <option>All</option><option>1/1</option><option>1/2</option><option>1/3</option><option>1/4</option><option>2/1</option>
        <option>2/2</option><option>2/3</option><option>2/4</option><option>3/1</option><option>3/2</option><option>3/3</option>
        <option>3/4</option><option>4/1</option><option>4/2</option><option>4/3</option><option>4/4</option>
        <option>4/5</option><option>4/6</option><option>5/1</option><option>5/2</option><option>5/3</option>
        <option>5/4</option><option>5/5</option><option>5/6</option><option>6/1</option><option>6/2</option>
        <option>6/3</option><option>6/4</option><option>6/5</option><option>6/6</option>
    </select>
    </div>
    <div class="form-actions">
      <button type="submit" class="btn btn-primary">ตกลง</button>
    </div>
</form><br />

<!-- database section -->
<?php
$room = $_POST['room'];
$text1 = "คุณต้องการแก้ไขข้อมูลนักเรียนใช่หรือไม่";
$text2 = "คุณต้องการลบข้อมูลนักเรียนใช่หรือไม่";
if(!empty($room)){
    if($room == 'All') $queue = "select * from data_std order by class,number_class";
    else $queue = "select * from data_std where class = '".$room."' order by number_class";
    $sql = mysqli_query($status,$queue);
    $sql_class_null = mysqli_query($status,$queue);
    $data_class_null = mysqli_fetch_array($sql_class_null);
    echo '<legend><div class="header">ห้อง '.$room.'</div></legend>';
    if(!empty($data_class_null)){ ?>
        <br>
        <table class="table table-bordered">
        <tr><td width="10px"></td><th>ชื่อ-นามสกุล</th><th width="150px">ชื่อเล่น</th><th width="70px">ชั้น</th><th width="30%">ชมรม</th></tr>
        <?php
        while($data = mysqli_fetch_array($sql)){
            echo '  
                <form method="post" class="form-horizontal" onsubmit="return confirm("'.$text1.'");">
                <div id="'.$data['user'].'" class="modal hide fade in" style="display: none; ">  
                <div class="modal-header"><a class="close" data-dismiss="modal">×</a>
                <h3>ข้อมูลนักเรียน</h3>
                </div>  
                <div class="modal-body">  
                <p> 
             ';
            echo '  <input name="ID_std" type="hidden" value="'.$data['user'].'">';
            echo '  <p>คำนำหน้า : 
                    <select name="title"> ';
                        if(!isset($data['title']))
                            echo '<option></option>';
                        else
                            echo '<option>'.$data['title'].'</option>';
            echo '      <option>เด็กชาย</option><option>เด็กหญิง</option>
                        <option>นาย</option><option>นางสาว</option>
                    </select></p>';
            echo '  <p>ชื่อจริง : <input type="text" name="name" required value="'.$data['name'].'"></p>';
            echo '  <p>นามสกุล : <input type="text" name="surname" value="'.$data['surname'].'" required ></p>';
            echo '  <p>ชื่อเล่น : <input type="text" name="nickname" required value="'.$data['nickname'].'"></p>';
            echo '  <p>เพศ : 
                    <select name="sex"> ';
                        if(!isset($data['sex']))
                            echo '<option></option>';
                        else
                            echo '<option>'.$data['sex'].'</option>';
            echo '  <option>ชาย</option><option>หญิง</option>
                    </select>
                    </p>';
            echo '  <p>ชั้น : 
                    <select name="class" required> ';
                        if(!isset($data['class']))
                            echo '<option></option>';
                        else
                            echo '<option>'.$data['class'].'</option>';
            echo '      <option>1/1</option><option>1/2</option><option>1/3</option><option>1/4</option><option>2/1</option>
                        <option>2/2</option><option>2/3</option><option>2/4</option><option>3/1</option><option>3/2</option><option>3/3</option>
                        <option>3/4</option><option>3/5</option><option>4/1</option><option>4/2</option><option>4/3</option><option>4/4</option>
                        <option>4/5</option><option>4/6</option><option>4/7</option><option>5/1</option><option>5/2</option><option>5/3</option>
                        <option>5/4</option><option>5/5</option><option>5/6</option><option>5/7</option><option>6/1</option><option>6/2</option>
                        <option>6/3</option><option>6/4</option><option>6/5</option><option>6/6</option>
                    </select></p>';
            echo '  <p>เลขที่(ในห้องเรียน) : <input type="text" name="number_class" required onkeyup="checkNumber(this)" value="'.$data['number_class'].'"></p>';
            echo '  <p>เลขประจำตัวนักเรียน : <input type="text" name="number" onkeyup="checkNumber(this)" value="'.$data['number'].'"></p>';
            echo '  <p>วันเกิด : <input type="date" name="birthday" value="yyyy-mm-dd" value="'.$data['birthday'].'"></p>';
            echo '  <p>ที่อยู่ : <textarea rows="10" cols="10" name="address">'.$data['address'].'</textarea></p>';
            echo '  <p>E-mail : <input  type="email" name="mail" value="'.$data['email'].'"></p>';
            echo '  <p>เบอร์โทรติดต่อ : <input type="text" name="phone" value="'.$data['phone'].'"></p>';
            echo '  <a href="regis_club_staff.php?value='.$data['user'].'">สมัครชมรมให้นักเรียน</a>';
            echo '  </p>
                    </div>  
                    <div class="modal-footer">  
                    <button class="btn btn-primary" type="submit">ตกลง</button>
                    <button class="btn" type="reset" data-dismiss="modal" aria-hidden="true">ยกเลิก</button>
                    </div>      
                    </div>
                    </form>
                    ';
            echo '  <form method="post" class="form-horizontal" onsubmit="return confirm("'.$text2.'");">
                        <tr><td><center><button class="btn btn-danger" type="submit" name="remove" value="'.$data['user'].'">ลบ</button></center></td>
                    </form>';
            echo '<td><a href="#'.$data['user'].'" data-toggle="modal">'.$data['title'].' '.$data['name'].' '.$data['surname'].'</a></td>';
            echo '<td>'.$data['nickname'].'</td>';
            echo '<td>'.$data['class'].'</td>'; ?>
            <td><?php
                $id = $data['user'];
                $sql_link = mysqli_query($status,"select * from clubenrollment where idUser = '$id'");
                while ($data = mysqli_fetch_array($sql_link)) {
                    $temp = $data['club'];
                    $input_make_link = mysqli_query($status,"select * from data_club where ID = '$temp'");
                    $make_link = mysqli_fetch_array($input_make_link);
                    $condition_m = explode(",", $make_link['condition_m']);
                    echo '  
                        <div id="club'.$make_link['ID'].'" class="modal hide fade in" style="display: none; ">  
                        <div class="modal-header"><a class="close" data-dismiss="modal">×</a>
                        <h3>'.$make_link['club'].'</h3>
                        </div>  
                        <div class="modal-body">  
                        <h4>ครูที่ปรึกษา</h4>
                        <p>'.$make_link['teacher'].'</p>
                        <h4>สมาชิกปัจจุบัน/สมาชิก</h4>
                        <p>'.$make_link['member'].'/'.$make_link['limit_member'].'</p>
                        <h4>คำอธิบาย</h4>
                        <p>'.$make_link['des'].'</p>
                        ';
                        if($make_link['condition_m'] != null || $make_link['condition_s_m'] != 0 || $make_link['condition_s_fm'] != 0){
                            echo '<h4>เงื่อนไขการรับสมัคร</h4>';
                        }
                        if($make_link['condition_m'] != null){
                            echo  '   
                                    <p>รับเฉพาะชั้นมัธยมศึกษาปีที่ '.$condition_m[0].' '.$condition_m[1].' '.$condition_m[2].' '.$condition_m[3].' '.$condition_m[4].' '.$condition_m[5].' '.$condition_m[6].'</p>
                                  ';
                        }
                        if($make_link['condition_s_m'] != 0 || $make_link['condition_s_fm'] != 0){
                            echo  ' <p>รับสมาชิกนักเรียนชาย : '.$make_link['condition_s_m'].'<br>รับสมาชิกนักเรียนหญิง : '.$make_link['condition_s_fm'].'</p>
                                  ';
                        }
                    echo '
                        </div>  
                        <div class="modal-footer">  
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                        </div>  
                        </div>
                    ';
                    echo '<a href="#club'.$make_link['ID'].'" data-toggle="modal">'.$make_link['club'].'</a> | ';
                }
              ?></td></tr>
     <?php } ?>
        </table>
        <?php
    }
    else{ ?>
        <div class="alert alert-block">ยังไม่มีนักเรียนลงทะเบียนในขณะนี้</div> <?php
    }
}
?>
</div>
<?php require 'footer.php';  ?>
</div>
<?php
    require 'header.php'; 

$id = $_POST['ID_std'];
$sql = mysqli_query($status,"select * from data_std where user = '$id'");
$data = mysqli_fetch_array($sql);
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
    if(empty($data['user'])){
        $query = ("insert into data_std(title,user,name,surname,nickname,sex,birthday,address,email,phone,mobile,class,number,number_class) values('$title','$id','$name','$surname','$nickname','$sex','$birthday','$address','$mail','$phone','$mobile','$class','$number','$number_class')");
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
}

$remove = $_POST['remove'];

    if(!empty($remove)){
        $sql = mysqli_query($status,"select * from clubenrollment where idUser='$remove'");
        while($data = mysqli_fetch_array($sql)){
            $club_name = $data['club'];
            $sql_club = mysqli_query($status,"select * from data_club where ID = '$club_name'");
            $data_club_name = mysqli_fetch_array($sql_club);
            $member = $data_club_name['member'] - 1;
            mysqli_query($status,"update data_club set member = '$member' where ID = '$club_name'");
        }
        $sql = ("delete from data_std where user='$remove'");
        mysqli_query($status,$sql) or die("Error Sql Database!" . mysqli_error());
        $sql = ("delete from clubenrollment where idUser='$remove'");
        mysqli_query($status,$sql) or die("Error Sql Database!" . mysqli_error());
        echo '<script>alert("ลบสมาชิกสำเร็จแล้ว");</script>';
        echo '<script>window.location.href="liststd.php"</script>';
    }
    mysqli_close($status);
?>
</body>
</html>