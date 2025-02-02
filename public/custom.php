<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Table with AJAX</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .table-container { margin: 20px; }
        .pagination { margin-top: 20px; }
    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="assets/images/logoipsum-349.svg" alt="VBHCLandscape" width="auto" height="50px" > VBHCLandscape
        </a>
        <div class="ms-auto d-flex align-items-center">
          
           
        </div>
    </div>
</nav>
<div class="container table-container">
    <h2 class="text-center">Data Table with AJAX</h2>

    <!-- Filter Section -->
    <div class="row mb-3">
        <div class="col-md-3">
            <input type="text" id="searchInput" class="form-control" placeholder="Search...">
        </div>
        <div class="col-md-3">
            <input type="date" id="fromDate" class="form-control">
        </div>
        <div class="col-md-3">
            <input type="date" id="toDate" class="form-control">
        </div>
        <div class="col-md-3">
            <button class="btn btn-primary w-100" id="filterBtn">Filter</button>
           
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

    <!-- Table -->
    <table class="table table-bordered" id="dataTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            <!-- Rows will be populated dynamically -->
        </tbody>
    </table>

    <!-- Pagination -->
    <nav>
        <ul class="pagination" id="pagination">
            <!-- Pagination links will be populated dynamically -->
        </ul>
    </nav>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    let currentPage = 1;
    const rowsPerPage = 10;

    // Fetch data from the server
    function fetchData(page, searchValue = "", fromDate = "", toDate = "") {
        $.ajax({
            url: "custombackend.php",
            type: "POST",
            data: {
                draw: 1,
                start: (page - 1) * rowsPerPage,
                length: rowsPerPage,
                search: { value: searchValue },
                fromDate: fromDate,
                toDate: toDate
            },
            success: function (response) {
                renderTable(response.data);
                renderPagination(response.recordsTotal, page);
            }
        });
    }

    // Render table rows
    function renderTable(data) {
        const tableBody = $("#tableBody");
        tableBody.empty();

        data.forEach(row => {
            const tr = `<tr>
                <td>${row[0]}</td>
                <td>${row[1]}</td>
                <td>${row[2]}</td>
                <td>${row[3]}</td>
                <td>${row[4]}</td>
            </tr>`;
            tableBody.append(tr);
        });
    }

    // Render pagination links
    function renderPagination(totalRecords, currentPage) {
        const pagination = $("#pagination");
        pagination.empty();

        const totalPages = Math.ceil(totalRecords / rowsPerPage);

        for (let i = 1; i <= totalPages; i++) {
            const li = `<li class="page-item ${i === currentPage ? "active" : ""}">
                <a class="page-link" href="#" onclick="changePage(${i})">${i}</a>
            </li>`;
            pagination.append(li);
        }
    }

    // Change page
    window.changePage = function (page) {
        currentPage = page;
        const searchValue = $("#searchInput").val();
        const fromDate = $("#fromDate").val();
        const toDate = $("#toDate").val();
        fetchData(currentPage, searchValue, fromDate, toDate);
    };

    // Apply filters
    $("#filterBtn").click(function () {
        currentPage = 1;
        const searchValue = $("#searchInput").val();
        const fromDate = $("#fromDate").val();
        const toDate = $("#toDate").val();
        fetchData(currentPage, searchValue, fromDate, toDate);
    });

    // Initial load
    fetchData(currentPage);
});
</script>
</body>
</html>