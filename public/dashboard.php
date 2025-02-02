<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <style>
        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 20px;
        }
        .nav-item .username {
            font-weight: bold;
            color: white;
            margin-right: 15px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="assets/images/logoipsum-349.svg" alt="Company Logo"> Company Name
        </a>
        <div class="ms-auto d-flex align-items-center">
            <span class="username" id="username">Welcome, User</span>
            <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container mt-4">
    <h2 class="text-center">Dashboard</h2>

    <!-- Filter Section -->
    <div class="row mb-3">
        <div class="col-md-3">
            <input type="date" id="fromDate" class="form-control" placeholder="From Date">
        </div>
        <div class="col-md-3">
            <input type="date" id="toDate" class="form-control" placeholder="To Date">
        </div>
        <div class="col-md-6 d-flex">
            <button class="btn btn-primary w-100 me-2" id="filterBtn">Filter</button>
            <button class="btn btn-warning w-100 me-2" id="priceEnquiryBtn">Price Enquiry</button>
            <button class="btn btn-success w-100 me-2" id="siteVisitBtn">Site Visit</button>
            <button class="btn btn-info w-100" id="generalEnquiryBtn">General Enquiry</button>
        </div>
    </div>
    <!-- Download data Buttons in CSV,PDF,EXCEL -->
     <div class="row">
        <div class="col-md-12 text-center">
            <a href="download_data.php?type=csv" class="btn btn-primary me-2">Download CSV</a>
            <a href="download_data.php?type=pdf" class="btn btn-danger me-2">Download PDF</a>
            <a href="download_data.php?type=excel" class="btn btn-success me-2">Download Excel</a>
        </div>
    </div>

    <!-- DataTable -->
    <table id="dataTable" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Created At</th>
            </tr>
        </thead>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function () {
    let filterType = "";

    // Fetch Logged-in Username
    $.ajax({
        url: "get_user.php",
        method: "GET",
        success: function (response) {
            $("#username").text("Welcome, " + response.username);
        }
    });

    // Initialize DataTable with entries selection (5, 10, 20)
    let table = $('#dataTable').DataTable({
        "processing": true,
        "serverSide": true,
        "lengthMenu": [[5, 10, 20], [5, 10, 20]], // Dropdown for entries per page
        "pageLength": 10, // Default to 10 entries per page
        "ajax": {
            "url": "fetch_data.php",
            "type": "POST",
            "data": function (d) {
                d.fromDate = $('#fromDate').val();
                d.toDate = $('#toDate').val();
                d.filterType = filterType;
            }
        }
    });

    // Filter Buttons
    $('#filterBtn').on('click', function () { filterType = ""; table.draw(); });
    $('#priceEnquiryBtn').on('click', function () { filterType = "price"; table.draw(); });
    $('#siteVisitBtn').on('click', function () { filterType = "site"; table.draw(); });
    $('#generalEnquiryBtn').on('click', function () { filterType = "general"; table.draw(); });
});
</script>
</body>
</html>
