<?php
require_once "../app/config.php"; // Database connection

// Get request parameters from DataTables
$draw = $_POST['draw'] ?? 1;
$start = $_POST['start'] ?? 0;
$length = $_POST['length'] ?? 10;
$searchValue = $_POST['search']['value'] ?? '';
$fromDate = $_POST['fromDate'] ?? '';
$toDate = $_POST['toDate'] ?? '';

// Base SQL query
$sql = "SELECT * FROM schedule_visit WHERE 1";

// Apply date filter
if (!empty($fromDate) && !empty($toDate)) {
    $sql .= " AND DATE(created_at) BETWEEN :fromDate AND :toDate";
}

// Apply search filter
if (!empty($searchValue)) {
    $sql .= " AND (name LIKE :search OR email LIKE :search OR message LIKE :search)";
}

// Get total records count
$totalQuery = $pdo->query("SELECT COUNT(*) FROM schedule_visit");
$totalData = $totalQuery->fetchColumn();

// Get filtered records count
$totalFilteredQuery = $pdo->prepare($sql);
if (!empty($fromDate) && !empty($toDate)) {
    $totalFilteredQuery->bindValue(':fromDate', $fromDate);
    $totalFilteredQuery->bindValue(':toDate', $toDate);
}
if (!empty($searchValue)) {
    $totalFilteredQuery->bindValue(':search', "%$searchValue%");
}
$totalFilteredQuery->execute();
$totalFiltered = $totalFilteredQuery->rowCount();

// Apply pagination and ordering
$sql .= " ORDER BY created_at DESC LIMIT :start, :length";
$dataQuery = $pdo->prepare($sql);
if (!empty($fromDate) && !empty($toDate)) {
    $dataQuery->bindValue(':fromDate', $fromDate);
    $dataQuery->bindValue(':toDate', $toDate);
}
if (!empty($searchValue)) {
    $dataQuery->bindValue(':search', "%$searchValue%");
}
$dataQuery->bindValue(':start', (int)$start, PDO::PARAM_INT);
$dataQuery->bindValue(':length', (int)$length, PDO::PARAM_INT);
$dataQuery->execute();
$data = $dataQuery->fetchAll(PDO::FETCH_ASSOC);

// Prepare response for DataTables
$response = [
    "draw" => intval($draw),
    "recordsTotal" => $totalData,
    "recordsFiltered" => $totalFiltered,
    "data" => []
];

foreach ($data as $row) {
    $response["data"][] = [
        $row["id"],
        $row["username"],
        $row["email"],
        $row["message"],
        $row["created_at"]
    ];
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);