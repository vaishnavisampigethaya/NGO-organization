<?php
session_start();
require('connection.php');
$name=$_POST['name'];
$address=$_POST['address'];
$email=$_POST['email'];
$password=$_POST['password'];
$confirm=$_POST['confirm'];
$phone=$_POST['phone'];
$file=$_FILES['photo'];
$filename=$file['name'];
$fileerror=$file['error'];
$filetemp=$file['tmp_name'];
$fileext=explode('.',$filename);
$filecheck=strtolower(end($fileext));
$fileextstored=array('png','jpg','jpeg','jfif');
$file1=$_FILES['idproof'];
$filename1=$file1['name'];
$fileerror1=$file1['error'];
$filetemp1=$file1['tmp_name'];
$fileext1=explode('.',$filename1);
$filecheck1=strtolower(end($fileext1));
$fileextstored1=array('png','jpg','jpeg');
if($password!=$confirm)
{
	header("location:doneereg.php?reg=fail");
}else{
$newpass=md5($password);
if((in_array($filecheck,$fileextstored))&&((in_array($filecheck1,$fileextstored1)))){
	$photo='upload/'.$filename;
	move_uploaded_file($filetemp,$photo);
	$id_proof='upload/'.$filename1;
	move_uploaded_file($filetemp1,$id_proof);
$sel=mysqli_query($con,"INSERT INTO `donee` (`email`, `username`, `address`, `password`,`phone`,`photo`,`id_proof`) VALUES ('$email', '$name', '$address', '$newpass','$phone','$photo','$id_proof')") or die(mysqli_error($con)); 
header("location:doneereg.php?reg=success");
}
}
?>
