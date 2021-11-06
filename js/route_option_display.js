console.log("test");

$.get("../../Controller/RouteController.php", { option: 'option' },
    function(data, result) {
        if (result == "success") {
            $("#route_id").html(data);
        }
    }
);