<?php
//set up mysql connection
mysql_connect("localhost", "root", "") or die(mysql_error());
//select database
mysql_select_db("snappydb") or die(mysql_error());

//get the value from the posted data and store it to a respected variable
$fName     = $_POST['fName'];
$lName     = $_POST['lName'];
$email     = $_POST['email'];
$reemail   = $_POST['reemail'];
$password  = sha1($_POST['password']);
$month     = $_POST['month'];
$day       = $_POST['day'];
$year      = $_POST['year'];
$gender    = $_POST['optionsRadios'];
$birthdate = $year . '-' . $month . '-' . $day;

//insert data using insert into statement
$query = "INSERT INTO tblmember(id, fName, lName, email, password, birthdate, gender) 
                    VALUES (NULL, '{$fName}', '{$lName}', '{$email}', '{$password}', '{$birthdate}', '{$gender}')";
//execute the query
if (mysql_query($query)) {
    //dislay a message box that the saving is successfully save
    echo "<script type=\"text/javascript\">
                alert(\"New member added successfully.\");
                window.location = \"registration.php\"
            </script>";
    
} else
    die("Failed: " . mysql_error());
?>