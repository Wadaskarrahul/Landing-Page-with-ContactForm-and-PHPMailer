<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rahul";

try {
    // Create a PDO connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Fetch data from the database
$requestData = $_REQUEST;

$columns = array(
    0 => 'id',
    1 => 'name',
    2 => 'position',
    3 => 'office',
    4 => 'age',
    5 => 'start_date',
    6 => 'salary'
);

// Base query
$sql = "SELECT id, name, position, office, age, start_date, salary FROM employees";

// Execute the base query to get total records
$stmt = $conn->query($sql);
$totalData = $stmt->rowCount();
$totalFiltered = $totalData;

// Pagination
if (!empty($requestData['start']) && !empty($requestData['length'])) {
    $sql .= " LIMIT " . intval($requestData['start']) . " , " . intval($requestData['length']);
}

// Execute the paginated query
$stmt = $conn->query($sql);

$data = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $nestedData = array();
    $nestedData['id'] = $row['id'];          // Ensure keys match DataTables columns
    $nestedData['name'] = $row['name'];
    $nestedData['position'] = $row['position'];
    $nestedData['office'] = $row['office'];
    $nestedData['age'] = $row['age'];
    $nestedData['start_date'] = $row['start_date'];
    $nestedData['salary'] = $row['salary'];
    $data[] = $nestedData;
}

$json_data = array(
    "draw" => intval($requestData['draw']), // Draw counter for DataTables
    "recordsTotal" => intval($totalData),   // Total records in the database
    "recordsFiltered" => intval($totalFiltered), // Total records after filtering (if any)
    "data" => $data                         // Array of data objects
);

echo json_encode($json_data);

// Close the connection
$conn = null;
?>