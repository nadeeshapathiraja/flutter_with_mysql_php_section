<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "flutter_mysql";
$table = "users";

//Actions for app operaters
$action = $_POST['action'];

//start connection
$con = new mysqli($host,$username,$password,$db);

if($con -> connect_error){
    die("Connection Error".$con->connect_error);
    return;
}


//If connection is Ok....
//app send this action Create Table
if("CREATE_TABLE" == $action){
    $sql= "CREATE TABLEIF NOT EXISTS $table(
        id INT UNSIGNED AUTO_INCREMENT PRIMARY kEY,
        first_name VARCHAR(255) NOT NULL,
        lase_name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
    )";

    if($con->query($sql)==TRUE){
        echo "SUCCESS";
    }
    else{
        echo "Error";
    }
    $con->close();
    return;
}


//Get all records from database
if("GET_ALL" ==$action){
    $db_data = array();
    $sql = "SELECT * FROM $table ORDER BY id DESC";
    $result = $con ->query($sql);
    if($result->num_rows >0){
        while($row = $result->fetch_assoc()){
            $db_data[]=$row;
        }
        echo json_encode($db_data);
    }
    else{
        echo "Error";
    }
    $con->close();
    return;


}

//Add users
if("ADD_EMP" == $action){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $sql = "INSERT INTO $table(first_name,last_name,email) VALUES ('$first_name','$last_name','$email')";
    $result =$con->query($sql);
    echo "Success";
    $con->close();
    return;
}

//Update user
if("UPDATE_EMP" == $action){
    $emp_id = $_POST['_emp_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $sql = "UPDATE$table SET first_name= '$first_name', last_name='$last_name', email ='$email' WHERE id = '$email_id'";
    if($con->query($sql)==TRUE){
        echo "SUCCESS";
    }
    else{
        echo "Error";
    }
    $con->close();
    return;

}

//Delete user
if('DELETE_EMP' ==$action){
    $emp_id = $_POST['emp_id'];
    $sql = "DELETE FROM $table WHERE id = $emp_id";
    if($con->query($sql)==TRUE){
        echo "SUCCESS";
    }
    else{
        echo "Error";
    }
    $con->close();
    return;
}


?>