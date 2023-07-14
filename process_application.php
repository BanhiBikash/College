<?php

require_once "config.php";

$name = $dob = $email = $category = $medium = $elective = $exam = $institute = $board = $session = $marks = $division = "";
$error=$data = [];


//name
if (empty(trim($_POST['abc']))) {
    $error['name'] = "Please enter your name";
} else {
    $name = $_POST['name'];
}
//dob
if (empty(trim($_POST['dob']))) {
    $error['dob'] = "Please enter your date of birth";
} else {
    $dob = $_POST['dob'];
}
//email
if (empty(trim($_POST['email']))) {
    $error['email'] = "Please enter your email";
} else {
    $email = $_POST['email'];
}
//category
if (empty(trim($_POST['category']))) {
    $error['category'] = "Please enter your category";
} else {
    $category = $_POST['category'];
}
//elective
if (empty(trim($_POST['elective']))) {
    $error['elective'] = "Please enter your elective";
} else {
    $elective = $_POST['elective'];
}
//exam
if (empty(trim($_POST['exam']))) {
    $error['exam'] = "Please enter the name of the examination";
} else {
    $exam = $_POST['exam'];
}
//institute
if (empty(trim($_POST['institute']))) {
    $error['institute'] = "Please enter the name of the institute attended";
} else {
    $institute = $_POST['institute'];
}
//board
if (empty(trim($_POST['board']))) {
    $error['board'] = "Please enter your board";
} else {
    $board = $_POST['board'];
}
//marks
if (empty(trim($_POST['marks']))) {
    $error['marks'] = "Please enter your percentage";
} else {
    $marks = $_POST['marks'];
}
//division
if (empty(trim($_POST['division']))) {
    $error['division'] = "Please enter your division";
} else {
    $division = $_POST['division'];
}

if (empty($error)) {echo"entered";
    $sql = "SELECT * FROM `applications_tbl` WHERE email=?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "s", $param_email);

    $param_email = $email;

    mysqli_stmt_execute($stmt);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) == 1) {
        $error['email'] = "Email already applied";
    } 
    else {
        $sql="INSERT INTO `applications_tbl`(`name`, `email`, `dob`, `category`, `medium`, `elective`, `exam`, `institution`, `board`, `session`, `marks`, `division`) VALUES ('$name','$email','$dob','$category','$medium','$elective','$exam','$institute','$board','$session','$marks','$division')";

        if(mysqli_query($conn,$sql)){
            $data['message']="You have applied successfully.";
        }else{
            $data['message']="Some error happened.";
        }
    }
}



if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    $data['success'] = true;
    $data['message'] = 'Login successfull! Redirecting';
}

echo json_encode($data);
?>