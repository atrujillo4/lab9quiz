<?php
session_start();

include 'connect.php';
$connect = getDBConnection();

//Checking credentials in database
// print_r($_POST);
$sql = "SELECT * FROM users WHERE username = :username
        and password = :password";
$stmt = $connect->prepare($sql);
$data = array(":username"=>$_POST['username'], ":password"=>sha1($_POST['password']));
$stmt->execute($data);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
//redirecting user to quiz if credentials are valid
print_r($user);
if(isset($user['username'])){
    $_SESSION['username'] = $user['username'];
    header('Location: index.php');
    
} else {
    echo "The values you entered were incorrect.
    <a href='login.php' >Retry</a>";
    
}
?>