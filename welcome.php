<?php

require_once "config.php";

$name = $dob = $email = $category = $medium = $elective = $exam = $institute = $board = $session = $marks = $division = "";
$error=$data = [];

if($_SERVER["REQUEST_METHOD"]=="POST"){
//name
if (empty(trim($_POST['name']))) {
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
//medium
if (empty(trim($_POST['medium']))) {
    $error['medium'] = "Please enter your medium";
} else {
    $medium = $_POST['medium'];
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
//session
if (empty(trim($_POST['session']))) {
    $error['session'] = "Please enter your session";
} else {
    $session = $_POST['session'];
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

if (empty($error)) {
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
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Application</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" >

        <h3>Application Form</h3>
        <h5 >Personal Details</h5>
        <div class="form-group">
            <label for="exampleInputName">Name</label>
            <input type="text" id="name" class="form-control" id="exampleInputName1" name="name" aria-describedby="nameHelp" placeholder="Enter name">
            <pre class="err" id="name_err"><?php echo $error?$error['name']:"" ?></pre>
        </div>
        <div class="form-group">
            <label for="exampleInputName">DOB:</label>
            <input type="date" id="dob" class="form-control" id="exampleInputDate1" name="dob" aria-describedby="nameHelp">
            <pre class="err" id="dob_err "><?php echo $error?$error['dob']:"" ?></pre>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" id="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email">
            <pre class="err" id="email_err"><?php echo $error?$error['email']:"" ?></pre>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Choose your category</label>
            <select name="category" id="category" class="form-control" id="exampleFormControlSelect1">
                <option value="">SELECT</option>
                <option value="general">General</option>
                <option value="Anu Jati">Anu. Jati</option>
                <option value="Anu J J">Anu. J. J.</option>
                <option value="Pichdi Jati">Pichdi Jati</option>
                <option value="Atyant Pichdi Jati">Atyant Pichdi Jati</option>
                <option value="Alp Sankhyak">Alp-Sankhyak</option>
                <option value="BPL Card dhari">BPL Card-dhari</option>
            </select>
            <pre class="err" id="category_err"><?php echo $error?$error['category']:"" ?></pre>
        </div>
        <h5 >Language and Subject</h5>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Choose your medium</label>
            <select name="medium" id="medium" class="form-control" id="exampleFormControlSelect1">
                <option value="">SELECT</option>
                <option value="English">English</option>
                <option value="Hindi A">Hindi A</option>
            </select>
            <pre class="err"cid="medium_err"><?php echo $error?$error['medium']:"" ?></pre>
        </div>
        <div class="form-group">
            <label>Elective Language(100 Marks)</label>
            <input type="text" class="form-control" id="elective" name="elective" placeholder="Can't be same as language of medium">
            <pre class="err" id="elective_err"><?php echo $error?$error['elective']:"" ?></pre>
        </div>
        <h5 >Educational qualifications</h5>
        <div class="form-group">
            <label>Name of examination</label>
            <input type="text" id="exam" class="form-control" name="exam" placeholder="Name of the examination">
            <pre class="err" id="exam_err"><?php echo $error?$error['exam']:"" ?></pre>
        </div>
        <div class="form-group">
            <label>Name of Institution</label>
            <input type="text" id="institute" class="form-control" name="institute" placeholder="Name of the institution attended">
            <pre class="err" id="institute_err"><?php echo $error?$error['institute']:"" ?></pre>
        </div>
        <div class="form-group">
            <label>Board</label>
            <input type="text" id="board" class="form-control" name="board" placeholder="Name of the board">
            <pre class="err" id="board_err"><?php echo $error?$error['board']:"" ?></pre>
        </div>
        <div class="form-group">
            <label>Session</label>
            <input type="text" id="session" class="form-control" name="session" placeholder="Academic session">
            <pre class="err" id="session_err"><?php echo $error?$error['session']:"" ?></pre>
        </div>
        <div class="form-group">
            <label>Total Marks</label>
            <input type="number" id="marks" class="form-control" name="marks" placeholder="Percentage of marks obtained">
            <pre class="err" id="marks_err"><?php echo $error?$error['marks']:"" ?></pre>
        </div>
        <div class="form-group">
            <label>Division</label>
            <input type="text" id="division" class="form-control" name="division" placeholder="Division">
            <pre class="err" id="division_err"><?php echo $error?$error['division']:"" ?></pre>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</body>
<script>
    // $(document).ready(function(){

        
    //     $("form").submit(function(event){
            
    //         event.preventDefault();

    //         var formData = {
    //             name:$('name').val(),
    //             dob:$('dob').val(),
    //             email:$('email').val(),
    //             category:$('category').val(),
    //             medium:$('medium').val(),
    //             elective:$('elective').val(),
    //             exam:$('exam').val(),
    //             institute:$('institute').val(),
    //             board:$('board').val(),
    //             session:$('session').val(),
    //             marks:$('marks').val(),
    //             division:$('division').val()
    //         }

    //         $.ajax({
    //             type: "POST",
    //             url: "process_application.php",
    //             data: formData,
    //             dataType: "json",
    //             encode: true
    //         }).done(function(result){
              
    //         })
    //     })
    // })
</script>
</html>