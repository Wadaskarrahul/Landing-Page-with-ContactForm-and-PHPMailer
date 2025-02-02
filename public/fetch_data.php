<?php
require_once "../app/config.php"; // Database connection

$fromDate = $_POST["fromDate"] ?? "";
$toDate = $_POST["toDate"] ?? "";
$searchValue = $_POST["search"]["value"] ?? "";
$start = $_POST["start"] ?? 0;
$length = $_POST["length"] ?? 10;

$sql = "SELECT * FROM contact_form WHERE 1";

// Apply Date Filter
if (!empty($fromDate) && !empty($toDate)) {
    $sql .= " AND DATE(created_at) BETWEEN '$fromDate' AND '$toDate'";
}

// Apply Search Filter
if (!empty($searchValue)) {
    $sql .= " AND (name LIKE '%$searchValue%' OR email LIKE '%$searchValue%' OR message LIKE '%$searchValue%')";
}

// Get Total Records
$totalQuery = $pdo->query("SELECT COUNT(*) FROM contact_form");
$totalData = $totalQuery->fetchColumn();

// Get Filtered Records
$totalFilteredQuery = $pdo->query($sql);
$totalFiltered = $totalFilteredQuery->rowCount();

// Apply Limit & Order By
$sql .= " ORDER BY created_at DESC LIMIT $start, $length";
$dataQuery = $pdo->query($sql);
$data = $dataQuery->fetchAll(PDO::FETCH_ASSOC);

// Format Data for DataTables
$response = [
    "draw" => intval($_POST["draw"]),
    "recordsTotal" => $totalData,
    "recordsFiltered" => $totalFiltered,
    "data" => []
];

foreach ($data as $row) {
    $response["data"][] = [
        $row["id"],
        $row["name"],
        $row["email"],
        $row["message"],
        $row["created_at"]
    ];
}

echo json_encode($response);
?>
