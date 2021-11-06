$.get("../../Controller/ShipController.php", { table: 'table' },
    function(data, result) {
        if (result == "success") {
            $("#display").html(data);
        }
    }
);