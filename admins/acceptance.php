<?php
require_once "config.php";

$id = $_POST['id'];
$data = [];
$acceptance = "";


$sql = "SELECT * FROM applications_tbl WHERE `Application no`='$id'";
$query = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($query)) {
    $acceptance = $row['acceptance'];
}

if($acceptance)
$acceptance=0;
else
$acceptance=1;

$sql="UPDATE applications_tbl SET `acceptance`='$acceptance' WHERE `Application no`='$id'";
$query = mysqli_query($conn,$sql);

if($query){
    $data['success']=true;
    $data['message']="Successfully updated";
}
else{
    $data['message']="Updated unsuccessfull";
    $data['success']=false;
}

echo json_encode($data);
