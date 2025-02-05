<?php 

require_once("../app/config.php");
$limit = 5;
$page = isset($_post['page'])?$_post['page']:1;
$start = ($page - 2) * $limit;

//
$query = "SELECT * FROM employee ORDER BY id DESC LIMIT :start, :limit";
$stmt = $pdo -> prepare($query);
$stmt ->bindParam(':start', $start, PDO::PARAM_INT);
$stmt ->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->execute();
$product = $stmt ->fetchAll();

$stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM employee");
$total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

$totalpage = ceil($total/$limit);



?>