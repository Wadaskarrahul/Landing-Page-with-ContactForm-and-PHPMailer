<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/datatables.css">
    <title>Hello, world!</title>
</head>

<body>
    <h1>Hello, world!</h1>
    <div class="container">

        <table class="table table-hover" id="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">office</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script src="assets/js/datatables.js"></script>
    <script>
        $(document).ready(function() {
            $('table').DataTable({
                "processing": true,
                "serverSide": false,
                "ajax": {
                    "url": "../app/fetchTableData.php",
                    "type": "GET",
                    "dataSrc": "" // Ensures DataTables correctly reads the JSON array
                },
                "columns": [{
                        "data": "id"
                    }, // Must match JSON key "id"
                    {
                        "data": "first_name"
                    }, // Must match JSON key "name"
                    {
                        "data": "last_name"
                    }, // Must match JSON key "client"
                    {
                        "data": "office"
                    } // Must match JSON key "status"
                ]
            });
        });
    </script>
    <script>
      /*  $(document).ready(function() {
            // Fetch data when the page loads
            fetchProjects();

            function fetchProjects() {
                $.ajax({
                    url: '/app/fetchTableData.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        let rows = "";
                        $.each(response, function(index, project) {
                            rows += `<tr>
                                        <td>${project.id}</td>
                                        <td>${project.name}</td>
                                        <td>${project.client}</td>
                                        <td><span class="badge bg-${getStatusColor(project.status)}">${project.status}</span></td>
                                    </tr>`;
                        });
                        $('#projectTable').html(rows);
                    },
                    error: function() {
                        $('#projectTable').html('<tr><td colspan="4" class="text-center text-danger">Failed to load data.</td></tr>');
                    }
                });
            }

            // Function to set color for status badge
            function getStatusColor(status) {
                if (status === 'Active') return 'primary';
                if (status === 'Completed') return 'success';
                if (status === 'Pending') return 'warning';
                return 'secondary';
            }
        });*/
    </script>

</body>

</html>