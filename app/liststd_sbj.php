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
    $sql = mysqli_query($status,"select * from data_sbj")
?>
<?php require 'cover.php'; ?>
<div id="contain">
<div id="app">
<legend><div class="header">รายชื่อนักเรียนของวิชาเสริม</div></legend>
<div class="alert alert-info"><b>วิธีใช้งาน</b> โปรดเลือกแค่ตัวเลือกเดียวเท่านั้น แล้วกดตกลงเพื่อทำการเรียกรายชื่อ</div><br />
<form method="post" class="form-horizontal">
    <label class="control-label" for="sbj">วิชาเสริม : </label>
    <div class="controls">
    <select name="sbj">
        <option></option><?php
        while($data = mysqli_fetch_array($sql)){
            echo '<option value="'.$data['ID'].'">'.$data['sbj'].'</option>';
        }?>
    </select>
    </div>
    <div class="form-actions">
      <button type="submit" class="btn btn-primary">ตกลง</button>
    </div>
</form><br />

<!-- database section -->
<?php
$sbj = $_POST['sbj'];
if(!empty($sbj)){
    $sql = mysqli_query($status,"select * from sbjenrollment where sbj = '".$sbj."'");
    $sql_name = mysqli_query($status,"select data_sbj.sbj from sbjenrollment,data_sbj where sbjenrollment.sbj = '".$sbj."' and data_sbj.ID = '".$sbj."'");
    $data_name = mysqli_fetch_array($sql_name);
    $sbj_name = $data_name['sbj'];
    echo '<legend><div class="header">วิชาเสริม '.$sbj_name;
    echo ' <a href="print_sbj.php?sbj='.$sbj.'" target="blank"><font size="10px">[พิมพ์รายชื่อ]</font></a >';
    echo '</div></legend>';
    ?>
    <br>
    <form method="post" class="form-horizontal" onsubmit="return confirm('คุณต้องการลบสมาชิกใช่หรือไม่');">
    <table class="table table-bordered">
    <tr><td style="width:20px"></td><th width="60%">ชื่อ-นามสกุล</th><th>ชื่อเล่น</th><th>ชั้น</th></tr>
    <?php
    while($data = mysqli_fetch_array($sql)){
        $id = $data['idUser'];
        $sql_std = mysqli_query($status,"select * from data_std where user = '$id'");
        $data_std = mysqli_fetch_array($sql_std);
        echo '  
                <div id="'.$data_std['user'].'" class="modal hide fade in" style="display: none; ">  
                <div class="modal-header"><a class="close" data-dismiss="modal">×</a>
                <h3>'.$data_std['title'].' '.$data_std['name'].' '.$data_std['surname'].'</h3>
                </div>  
                <div class="modal-body">  
                <p> 
                    <b>ชื่อเล่น : </b>'.$data_std['nickname'].'<br>
                    <b>เพศ : </b>'.$data_std['sex'].'<br>
                    <b>ชั้น : </b>'.$data_std['class'].'<br>
                    <b>เลขที่(ในห้องเรียน) : </b>'.$data_std['number_class'].'<br>
                    <b>เลขประจำตัวนักเรียน : </b>'.$data_std['number'].'<br>
                    <b>วันเกิด : </b>'.$data_std['birthday'].'<br>
                    <b>ที่อยู่ : </b>'.$data_std['address'].'<br>
                    <b>E-mail : </b>'.$data_std['email'].'<br>
                    <b>เบอร์โทรติดต่อ : </b>'.$data_std['phone'].'<br>
                </p>
                </div>  
                <div class="modal-footer">  
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                </div>  
                </div>
                ';
        echo '<tr><td><center><input type="radio" name="remove" value='.$data_std['user'].'></input></center></td>';
        echo '<td><a href="#'.$data_std['user'].'" data-toggle="modal">'.$data_std['title'].' '.$data_std['name'].' '.$data_std['surname'].'</a></td>';
        echo '<td>'.$data_std['nickname'].'</td>';
        echo '<td>'.$data_std['class'].'</td>';
          ?></td></tr>
 <?php } ?>
    </table><input type="hidden" name="sbj" value="<?php echo $sbj; ?>">
    <button type="submit" class="btn btn-danger">ลบ</button>
    </form> 
    <?php
}
?>
</div>
<?php require 'footer.php';  ?>
</div>
<?php
    require 'header.php'; 
    $remove = htmlspecialchars($_POST['remove'] ,ENT_QUOTES);
    $sbj = htmlspecialchars($_POST['sbj'] ,ENT_QUOTES);;
    
    if(!empty($remove)){
        echo $sbj;
        mysqli_query($status,"delete from sbjenrollment where idUser='$remove' and sbj = '$sbj'") or die("Error Sql Database!" . mysqli_error());
        $sql = mysqli_query($status,"select * from data_sbj where ID = '$sbj'") or die("Error Sql Database!" . mysqli_error());
        $data = mysqli_fetch_array($sql);
        echo $sbj;
        if($data['member'] > 0){
            $member = $data['member'] - 1;
            mysqli_query($status,"update data_sbj set member='$member' where ID='$sbj'") or die("Error Sql Database!" . mysqli_error());
            echo '<script>alert("ลบสมาชิกสำเร็จแล้ว");</script>';
            echo '<script>window.location.href="liststd_sbj.php"</script>';
        }
        else echo '<script>alert("พบข้อผิดพลาด โปรดติดต่อผู้ดูแล");</script>';
    }
    mysqli_close($status);
?>
</body>
</html>