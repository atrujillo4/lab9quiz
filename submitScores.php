<?php
session_start();

include 'connect.php';
$connect = getDBConnection();

$score = $_GET['score'];
// echo $score;
$sql = "INSERT INTO scores (username, score) VALUES (:username, :score)";
$data = array(
    ":username"=>$_SESSION['username'],
    ":score"=>$score
    
);

$stmt = $connect->prepare($sql);
$stmt->execute($data);
// echo 123;
$sql = "SELECT count(1) times, avg(score) average
        FROM scores WHERE username = :username";
$stmt = $connect->prepare($sql);
$data = array(
    ":username"=> $_SESSION['username']
);
$stmt->execute($data);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($result);

//Adding new score to database

//Retrieving total times quiz has been submitted and average score for this user

//Encoding data using JSON

?>