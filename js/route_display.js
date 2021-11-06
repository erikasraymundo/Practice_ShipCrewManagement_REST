$.get("../../Controller/RouteController.php", { table: 'table' },
    function(data, result) {
        if (result == "success") {
            $("#display").html(data);
        }
    }
);