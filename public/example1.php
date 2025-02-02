<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table with Pagination, Search, and Date Filter</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Search and Date Filter -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="d-flex">
                <input type="text" id="searchInput" class="form-control me-2" placeholder="Search by Name or Email">
                <input type="date" id="dateFrom" class="form-control me-2">
                <input type="date" id="dateTo" class="form-control">
            </div>
        </div>

        <!-- Table -->
        <div class="table-container">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID <button onclick="sortTable(0)">Sort</button></th>
                        <th>Name <button onclick="sortTable(1)">Sort</button></th>
                        <th>Email <button onclick="sortTable(2)">Sort</button></th>
                        <th>Message</th>
                        <th>Created At <button onclick="sortTable(4)">Sort</button></th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- Table Rows Will Go Here -->
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <button class="page-link" id="prevBtn">Previous</button>
                </li>
                <li class="page-item">
                    <button class="page-link" id="nextBtn">Next</button>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        const data = [
            { id: 1, name: 'John Doe', email: 'john@example.com', message: 'Hello', createdAt: '2025-01-01' },
            { id: 2, name: 'Jane Smith', email: 'jane@example.com', message: 'Hi', createdAt: '2025-01-02' },
            { id: 3, name: 'Alice Brown', email: 'alice@example.com', message: 'Good Morning', createdAt: '2025-01-03' },
            { id: 4, name: 'Bob White', email: 'bob@example.com', message: 'Test', createdAt: '2025-01-04' },
            { id: 5, name: 'Charlie Black', email: 'charlie@example.com', message: 'Important', createdAt: '2025-01-05' },
            // Add more data as needed
        ];

        let currentPage = 1;
        const rowsPerPage = 2;

        function renderTable() {
            const filteredData = filterData();
            const paginatedData = paginateData(filteredData);
            const tableBody = document.getElementById('tableBody');
            tableBody.innerHTML = '';
            paginatedData.forEach(item => {
                const row = `
                    <tr>
                        <td>${item.id}</td>
                        <td>${item.name}</td>
                        <td>${item.email}</td>
                        <td>${item.message}</td>
                        <td>${item.createdAt}</td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });
        }

        function paginateData(data) {
            const startIndex = (currentPage - 1) * rowsPerPage;
            const endIndex = startIndex + rowsPerPage;
            return data.slice(startIndex, endIndex);
        }

        function filterData() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const dateFrom = document.getElementById('dateFrom').value;
            const dateTo = document.getElementById('dateTo').value;
            return data.filter(item => {
                const matchesSearch = item.name.toLowerCase().includes(searchInput) || item.email.toLowerCase().includes(searchInput);
                const matchesDate = (!dateFrom || item.createdAt >= dateFrom) && (!dateTo || item.createdAt <= dateTo);
                return matchesSearch && matchesDate;
            });
        }

        function sortTable(columnIndex) {
            data.sort((a, b) => {
                const valA = Object.values(a)[columnIndex];
                const valB = Object.values(b)[columnIndex];
                if (valA < valB) return -1;
                if (valA > valB) return 1;
                return 0;
            });
            renderTable();
        }

        document.getElementById('searchInput').addEventListener('input', renderTable);
        document.getElementById('dateFrom').addEventListener('input', renderTable);
        document.getElementById('dateTo').addEventListener('input', renderTable);

        document.getElementById('prevBtn').addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                renderTable();
            }
        });

        document.getElementById('nextBtn').addEventListener('click', () => {
            if (currentPage < Math.ceil(data.length / rowsPerPage)) {
                currentPage++;
                renderTable();
            }
        });

        renderTable(); // Initial render
    </script>
</body>
</html>
