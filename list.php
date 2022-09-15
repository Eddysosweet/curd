<?php
$conn = mysqli_connect("localhost", "root", "", "bkap");
if (mysqli_connect_errno()) {
    echo 'loi : ' . mysqli_connect_error();
}
$sql="select *,sinh_vien.id as sinh_vien_id, lop_hoc.name as lop_hoc_name, sinh_vien.name as sinh_vien_name from sinh_vien inner join lop_hoc on sinh_vien.lop_hoc_id = lop_hoc.id ";

$query = mysqli_query($conn,$sql);
echo mysqli_error($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List-Product</title>
</head>

<body>
    <table border="1" cellpadding="20" cellspacing="0">
        <thead>
            <tr>
                <th>#</th>
                <th>name</th>
                <th>lop hoc</th>
                <th>avatar</th>
                <th>birthday</th>
                <th>gender</th>
                <th>about</th>
                <th colspan="2">action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = 0;
            while($row = mysqli_fetch_assoc($query)){
                $i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['sinh_vien_name'] ?></td>
                <td><?php echo $row['lop_hoc_name'] ?></td>
                <td><img src="<?php echo $row['avatar'] ?>" alt="#" width="50"></td>
                <td><?php echo $row['birthday'] ?></td>
                <td><?php if($row['gender'] ==1) {echo "Nam";} else { echo "Nữ";} ?></td>
                <td><?php echo $row['about'] ?></td>
                <td><a onclick="return confirm('bạn có chắc chắn muốn xoá học sinh này không?')" href="delete.php?id=<?php echo $row['sinh_vien_id'] ?>">Xoá</a></td>
                <td><a  href="edit.php?id=<?php echo $row['sinh_vien_id'] ?>">Edit</a></td>
            </tr>
           
            <?php
             } 
            ?>
        </tbody>
    </table>
    <a href="add.php"> Add học sinh</a>
</body>


</html>