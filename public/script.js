$(document).ready(function() {
    // Initialize DataTable
    $('#dataTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "custombackend.php", // Replace with your backend PHP URL
            "type": "POST",
            "data": function(d) {
                // Add extra filters like fromDate, toDate, and search
                d.fromDate = $('#fromDate').val();
                d.toDate = $('#toDate').val();
                d.search = {
                    "value": $('#searchInput').val()
                };
            },
            "dataSrc": function(json) {
                return json.data; // DataTables expects the data to be under the 'data' key
            }
        },
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "email" },
            { "data": "message" },
            { "data": "created_at" }
        ]
    });
    
    // Implement search and date filter functionality
    $('#filterBtn').click(function() {
        $('#dataTable').DataTable().ajax.reload(); // Reload table with new filter parameters
    });
});
