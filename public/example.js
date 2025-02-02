<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "server_processing.php",
                "type": "POST"
            },
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "position" },
                { "data": "office" },
                { "data": "age" },
                { "data": "start_date" },
                { "data": "salary" }
            ]
        });
    });
</script>