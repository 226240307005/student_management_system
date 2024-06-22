<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="css//bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">

    <style>
      #dataform{
        border: 2px solid red;
        width: 1000px;
        height: 230px;
        
        align-content: center;
        align-self: center;
        padding-left: 55px;
      
      }
      table{
       margin-top: 50px;
       

      }
      tr,th,td{
      
        text-align: center;

       
      }

    </style>

</head>
<body class="container bg-white"><br><br>
<center>
  <form class="row g-3 text-dark bg-light" method="POST" action="" id="dataform">
  <div class="col-auto">
  </div>
  <div class="col-auto">
   
    <input type="number" class="form-control"  placeholder="Student Enrollment" name="enrollment" required>
  </div>
   <div class="col-auto">
   
    <input type="text" class="form-control"  placeholder="Student Name" name="name" required>
  </div>
   

   <div class="col-auto">
    <input type="text" class="form-control"  placeholder="Student Collage" name="collage" required>
  </div>
   <div class="col-auto">
   
    <input type="number" class="form-control"  placeholder="Institute code" name="code" required>
  </div>
  <div class="col-auto">
   
    <input type="text" class="form-control"  placeholder="Enter CGPA" name="cgpa" required>
  </div>
<div class="col-auto">
   <select class="form-select" aria-label="Sem" name="sem" required>
     <option >Select Sem</option>
     <option value="1">SEM 1</option>
     <option value="2">SEM 2</option>
     <option value="3">SEM 3</option>
     <option value="4">SEM 4</option>
     <option value="5">SEM 5</option>
     <option value="6">SEM 6</option>
     <option value="7">SEM 7</option>
     <option value="8">SEM 8</option>  
      </select>
    
  </div>

  <div class="col-auto">
   <select class="form-select" aria-label="Branch" name="branch" required>
  <option >Select Branch</option>
  <option value="AUTOMOBILE ENGINEERING">AUTOMOBILE ENGINEERING</option>
  <option value="BIOMEDICAL ENGINEERING">BIOMEDICAL ENGINEERING</option>
  <option value="COMPUTER ENGINEERING">COMPUTER ENGINEERING</option>
 <option value="CIVIL ENGINEERING">CIVIL ENGINEERING</option>
<option value="CHEMICAL ENGINEERING">CHEMICAL ENGINEERING</option>
<option value="COMPUTER AIDED COSTUME DESIGN & DRESS MAKING">COMPUTER AIDED COSTUME DESIGN & DRESS MAKING</option>
<option value="ELECTRONICS AND COMMUNICATION ENGINEERING">ELECTRONICS AND COMMUNICATION ENGINEERING</option>
<option value="ELECTRICAL ENGINEERING">ELECTRICAL ENGINEERING</option>
  <option value="INFORMATION TECHNOLOGY">INFORMATION TECHNOLOGY</option>
 <option value="MECHANICAL ENGINEERING">MECHANICAL ENGINEERING</option>
  
  
</select>
  </div>

  <div class="col-auto">
   <select class="form-select" aria-label="Gender" name="gender" required>
     <option >Select gender</option>
     <option value="male">MALE</option>
     <option value="female">FEMALE</option>
     <option value="other">OTHER</option>
      </select>
    
  </div>



  <div class="row" style="padding-top: 20px;">
    <div class="col-12 d-flex justify-content-center">
      <button type="submit" class="btn btn-primary mb-3 mx-2" name="submit">Add Student</button>
      <button type="reset" class="btn btn-primary mb-3 mx-2">Reset</button>
    </div>
  </div>



</form>

<form action="" method="POST" id="searchform">
  <div class="container mt-4">
  <div class="row">
    <div class="col-lg-6 col-md-8 col-sm-10 col-12 mx-auto">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search..." name="searchdata">
        <button class="btn btn-outline-success" type="submit" name="search">Search</button>
      </div>
    </div>
  </div>
</div>
</form>  
<h2 style="color: black;">OR</h2>
<form action="" method="POST" id="displayalldata">
<button type="submit" class="btn btn-dark" name="displayalldata">Display All Data</button>
</form>
</center>
 
  <?php

  
   //php for data input form 
$host="localhost";
$username="root";
$pass="";
$db="student_management";

    $conn=mysqli_connect($host,$username,$pass,$db);

 if(isset($_POST['submit']))
 {
      $enrollment=$_SESSION['enrollment']=$_POST['enrollment'];
      $name=$_SESSION['name']=strtolower($_POST['name']);
      $branch=$_SESSION['branch']=strtolower($_POST['branch']);
      $collage=$_SESSION['collage']=strtolower($_POST['collage']); 
      $code=$_SESSION['code']=strtolower($_POST['code']);
      $cgpa=$_SESSION['cgpa']=$_POST['cgpa'];
      $sem=$_SESSION['sem']=$_POST['sem'];
      $gender=$_SESSION['gender']=$_POST['gender'];


      if ($conn) 
      {
         $i=true;
         $select="SELECT *FROM students";
         $select_query=mysqli_query($conn,$select);
        if($i)
        {
          $alter="ALTER TABLE students AUTO_INCREMENT = 1";
          $alter_query=mysqli_query($conn,$alter);
          $i=false;
        }
        if($i==false)
        {
         $check="SELECT enrollment FROM students WHERE enrollment=$enrollment";
         $check_query=mysqli_query($conn,$check);

         if(mysqli_num_rows($check_query) == 0)
         {
        $sql="INSERT INTO students VALUES('','$enrollment','$name','$branch','$collage','$code','$cgpa','$sem','$gender')";
        $query=mysqli_query($conn,$sql);
        echo "<br><center><div class='alert alert-success' role='alert' style='width:500px';>Student added successfully!!</div></center>";
          }
          else
          {
            echo "<br><center><div class='alert alert-danger' role='alert' style='width:500px';>Student already exsist!!</div></center>";
          }  
         
      
        exit();

         }
      }
      else
      {
          echo '<script>';
          echo "alert('Connection Failed!!')";
         echo '</script>';
      }    
      
 }

mysqli_close($conn);  

?>


<?php

//php for search data

$host="localhost";
$username="root";
$pass="";
$db="student_management";

    $conn=mysqli_connect($host,$username,$pass,$db);

if(isset($_POST['search']))
    {


      $search=$_POST['searchdata'];
      if(empty($search))
      {
         echo "<br><center><div class='alert alert-danger' role='alert' style='width:500px';>Please! search somthng!</div></center>";
      }
      elseif(isset($search))
      {


        $sql="SELECT *FROM students WHERE enrollment='$search' ";
        $query=mysqli_query($conn,$sql);

        if(mysqli_num_rows($query) > 0 )
        {
          
           echo "<center>";
              echo "<div class='table-responsive-md container'>";
   echo "<table class='table table-hover table-responsive-xl table-bordered border-dark'>";
   echo " <tr class='table-dark'> <th>Sr.no</th> <th>Enrollment</th> <th>Name</th> <th>Branch</th> <th>College</th> <th>College Code</th> <th>CGPA</th> <th>Semester</th> <th>Gender</th> ";
    while ($row = mysqli_fetch_assoc($query)) {

        echo "<tr >";
        echo "<td>".ucwords($row["id"]) . "</td>"; 

         echo  "<td>".ucwords($row["enrollment"]) . "</td>"; 

          echo "<td>".ucwords($row["name"]) . "</td>"; 

           echo "<td>".ucwords($row["branch"]) . "</td>"; 

            echo "<td>".ucwords($row["college"]) . "</td>"; 

             echo "<td>".ucwords($row["code"]) . "</td>";

              echo "<td>".$row["cgpa"] . "</td>";

              echo "<td>".$row["sem"]. "</td>";

               echo "<td>".ucwords($row["gender"]). "</td>";
             echo "</tr>"; 
    }
           
    echo "</table>";
    echo "</div>";
    echo "</center>";
    mysqli_close($conn);
    exit();
   
        }
        else
        {
          echo "<br><center><div class='alert alert-danger' role='alert' style='width:500px';>Sorry!! data not found?</div></center>";
        }

      }
      
    }



    // php for display all data

$host="localhost";
$username="root";
$pass="";
$db="student_management";

    $conn=mysqli_connect($host,$username,$pass,$db);

    $select_all = "SELECT  *FROM students ORDER BY id";
$select_all_query = mysqli_query($conn, $select_all);


if (mysqli_num_rows($select_all_query) == 0 ) {

              echo "<br><center><div class='alert alert-warning' role='alert' style='width:500px';>No any entries are available to display</div></center>";
        
  }
  else{
    if( isset($_POST['displayalldata']))
    {

     echo "<h5 style='float:right';>Total Entries: ".mysqli_num_rows($select_all_query)."</h5>";
   echo "<center>";
   echo "<div class='table-responsive-md container'>";
   echo "<table class='table table-hover table-responsive-xl table-bordered border-dark'>";
   echo "<tr class='table-dark'> <th>Sr.no</th> <th>Enrollment</th> <th>Name</th> <th>Branch</th> <th>College</th> <th>College Code</th> <th>CGPA</th> <th>Semester</th> <th>Gender</th><th> Remove Student Data</th>";
    while ($row = mysqli_fetch_assoc($select_all_query)) {

        echo "<tr >";

        echo "<td>".$row["id"] . "</td>"; 

         echo  "<td>".ucwords($row["enrollment"]) . "</td>"; 

          echo "<td>".ucwords($row["name"]) . "</td>"; 

           echo "<td>".ucwords($row["branch"]) . "</td>"; 

            echo "<td>".ucwords($row["college"]) . "</td>"; 

             echo "<td>".ucwords($row["code"]) . "</td>";

             echo "<td>".$row["cgpa"] . "</td>";

              echo "<td>".$row["sem"]. "</td>";

               echo "<td>".ucwords($row["gender"]). "</td>";

             echo "<td>"."<form action='' method='POST'><button type='submit' class='btn btn-danger' name='remove' value='$row[id]'>Remove</button> </form> "."</td>";
             echo "</tr>"; 
    }
  }

    echo "</table>";
    echo "</div>";
    echo "</center>";

    if(isset($_POST['remove']))
    {
      echo "<script>window.confirm('Do you want to delete data??')</script>";
      $stud_id =$_POST['remove'];
        
        $remove="DELETE FROM students WHERE id=$stud_id";
        $remove_query=mysqli_query($conn,$remove);
           echo "<br><center><div class='alert alert-success' role='alert' style='width:500px';>Serial number $stud_id Removed successfully!!</div></center>";



    }
    mysqli_close($conn);
    exit();
}






?>





<script src="js//bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">

</script>

</body>
</html>
