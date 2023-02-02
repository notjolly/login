<?php
include "./user.php";
$conn = connect();
$sql = "SELECT id,message FROM message_board ORDER BY id DESC LIMIT 1";
$sqlquery = $conn->query($sql);
$result = $sqlquery->fetch_assoc();
$countsql = "SELECT COUNT(*) FROM message_board";
$countsqlquery = $conn->query($countsql);
$count = $countsqlquery->fetch_assoc();
$id = $result['id'];
$text = $result['message'];
echo json_encode($count['COUNT(*)'].$id.$text);
?>