<?php 
if(isset($_GET['id']) && $_GET['id']){
    $id= $_GET['id'];
    $conn = mysqli_connect("localhost", "root", "", "bkap");
if (mysqli_connect_errno()) {
    echo 'loi : ' . mysqli_connect_error();
}
$sql = "delete from sinh_vien where id= '$id'";
$remove = mysqli_query($conn,"select avatar from sinh_vien where id = $id");
$src = mysqli_fetch_assoc($remove);
if(file_exists($src['avatar'])){
    $status = unlink($src['avatar']);
    $query= mysqli_query($conn,$sql);
    if($query && $status){
        header("location:list.php");
        
    }else{
        echo 'loi';
    }
}
}
