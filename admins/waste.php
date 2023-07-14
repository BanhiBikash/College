<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <div id="container"></div>
</body>
<script>
    $(document).ready(function(){

      $.ajax({
        type: "POST",
        url: "process.php",
        dataType: "html",
        success: function(data){
            $('#container').html(data)
            console.log(data)
        }
      })

      //handle change
      function handleCheck(id){
      
        $.ajax({
            type: "GET",
            url : "fetch.php",
            data: id,
            dataType:"json",
            encode:true
        }).done(function(row){
        })
      }
    })
</script>
</html>

<!-- process -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<table class="table table-sm">
        <thead>
          <tr>
            <th scope="col">Application No.</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">DOB</th>
            <th scope="col">Category</th>
            <th scope="col">Medium</th>
            <th scope="col">Elective</th>
            <th scope="col">Exam</th>
            <th scope="col">Institution</th>
            <th scope="col">Board</th>
            <th scope="col">Session</th>
            <th scope="col">Marks</th>
            <th scope="col">Division</th>
            <th scope="col">Acceptance</th>
          </tr>
        </thead>
<?php 
require_once "config.php";
$sql="SELECT * FROM applications_tbl";
$query=mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($query)){
?>
<tbody>
<tr>
<th scope="row"><?php echo $row['Application no.'] ?></th>
<td><?php echo $row['name']  ?></td>
<td><?php echo $row['email']  ?></td>
<td><?php echo $row['dob'];  ?></td>
<td><?php echo $row['category']  ?></td>
<td><?php echo $row['medium']  ?></td>
<td><?php echo $row['elective'] ?></td>
<td><?php echo $row['exam']  ?></td>
<td><?php echo $row['institution']  ?></td>
<td><?php echo $row['board']  ?></td>
<td><?php echo $row['session']  ?></td>
<td><?php echo $row['marks']  ?></td>
<td><?php echo $row['division']  ?></td>
<td><input type="checkbox" onchange="handleCheck(<?php $row['Application no.'] ?>)" checked=(<?php echo $row['acceptance'] ?>)></td>
</tr>
</tbody>
<?php }
?>
</table>
</body>
</html>

