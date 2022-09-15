<?php
if(isset($_GET['id']) && is_numeric($_GET['id'])){
    $id = $_GET['id'];
$conn = mysqli_connect("localhost", "root", "", "bkap");
if (mysqli_connect_errno()) {
    echo 'loi : ' . mysqli_connect_error();
}
$list = mysqli_query($conn,"SELECT * FROM lop_hoc");
$query= mysqli_query($conn,"select *,sinh_vien.id as sinh_vien_id, lop_hoc.name as lop_hoc_name, sinh_vien.name as sinh_vien_name from sinh_vien inner join lop_hoc on sinh_vien.lop_hoc_id = lop_hoc.id where sinh_vien.id = $id ") ;
$sv = mysqli_fetch_assoc($query);
}
?>
<?php
$url = "";
if (isset($_FILES['avatar']) && $_FILES['avatar']['name']!== null){
    unlink($sv['avatar']);
    $url = 'uploads/'.time().$_FILES['avatar']['name'];
    move_uploaded_file($_FILES['avatar']['tmp_name'],$url);
}
    if(isset($_POST['name']) && $_POST['name']){
        $name= $_POST['name'];
        $lop_hoc_id= $_POST['lop_hoc'];
        $birthday= $_POST['birthday'];
        $gender= $_POST['gender'];
        $about= $_POST['about'];
        $query = mysqli_query($conn,"update sinh_vien set name='$name',lop_hoc_id= $lop_hoc_id,avatar = '$url',birthday = '$birthday',gender = $gender,about = '$about' where id = $id");
        if($query){
            header("location:list.php");
        }else {
            echo 'loi'.mysqli_connect_error($query);
        }
        

    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD</title>
</head>

<body>
    <form method="post" enctype="multipart/form-data">
        <div>
            <h2>Tên</h2>
            <input type="text" name="name" value="<?php echo $sv['sinh_vien_name'] ?>">
        </div>
        <div>
            <h2>lớp học</h2>
            <select name="lop_hoc">
                <?php
                while($row = mysqli_fetch_assoc($list)) {
                ?>
                <option <?php echo ($row['id'] == $sv['lop_hoc_id']) ? "selected": "" ?> value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div>

            <h2>Avatar</h2>
            <img width="50" src="<?php echo $sv['avatar'] ?>">
            <input id="avatar" name="avatar" type="file" hidden>
            <label for="avatar" style="border: 1px solid ;">Thay đổi</label>
        </div>
        <div>
            <h2>Birthday</h2>
            <input name="birthday" type="text" value="<?php echo $sv['birthday'] ?>">
        </div>

        <div>
            <h2>Gender</h2>
            <input type="radio" name="gender" value="0" <?php echo ($sv['gender'] == 0)? "checked":"" ?>><label for="hide">Nữ</label>
            <input type="radio" name="gender" value="1" <?php echo ($sv['gender'] == 1)? "checked":"" ?>><label for="show">Nam</label>
        </div>
        
        <div>
            <h2>About</h2>
            <textarea name="about" cols="50" rows="4" ><?php echo $sv['about'] ?></textarea>
        </div>
        <input type="submit" value="Cập nhật">
    </form>
</body>

</html>