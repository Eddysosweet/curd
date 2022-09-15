<?php
$conn = mysqli_connect("localhost", "root", "", "bkap");
if (mysqli_connect_errno()) {
    echo 'loi : ' . mysqli_connect_error();
}
$list = mysqli_query($conn,"SELECT * FROM lop_hoc");
?>
<?php
if (isset($_FILES['avatar']) && $_FILES['avatar']['name']!== null) {
    $url = 'uploads/'.time().$_FILES['avatar']['name'];
    move_uploaded_file($_FILES['avatar']['tmp_name'],$url);
    if(isset($_POST['name']) && $_POST['name']){
        $name= $_POST['name'];
        $lop_hoc_id= $_POST['lop_hoc'];
        $birthday= $_POST['birthday'];
        $gender= $_POST['gender'];
        $about= $_POST['about'];
        $query = mysqli_query($conn,"INSERT INTO sinh_vien(name, lop_hoc_id,avatar,birthday,gender,about) VALUES('$name',$lop_hoc_id,'$url','$birthday',$gender,'$about')");
        if($query){
            header("location:list.php");
        }else {
            echo 'loi'.mysqli_connect_error($query);
        }
        

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
            <input type="text" name="name">
        </div>
        <div>
            <h2>lớp học</h2>
            <select name="lop_hoc">
                <?php
                while($row = mysqli_fetch_assoc($list)) {
                ?>
                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div>
            <h2>Avatar</h2>
            <input name="avatar" type="file">
        </div>
        <div>
            <h2>Birthday</h2>
            <input name="birthday" type="text">
        </div>

        <div>
            <h2>Gender</h2>
            <input type="radio" name="gender" value="0"> <label for="hide">Nữ</label>
            <input type="radio" name="gender" value="1"> <label for="show">Nam</label>
        </div>
        
        <div>
            <h2>About</h2>
            <textarea name="about" cols="50" rows="4"></textarea>
        </div>
        <input type="submit" value="Thêm">
    </form>
</body>

</html>