$(document).ready(function() {

    $("#btn-submit").click(function() {
        console.log("test for ship");

        var name = $("#name").val().trim();
        var speed_class = $("#speed_class").val().trim();
        var route_id = $("#route_id").val().trim();
        var price = $("#price").val().trim();


        if (name == "" || speed_class == "" || route_id == "" || price == "") {
            Swal.fire({
                icon: 'error',
                title: 'Please enter all the required fields.'
            })
        } else {

            var distance = 0; //default
            var eta = 0;
            var knots = 0;

            console.log(" route id is " + route_id);

            $.get("../../Controller/RouteController.php", {
                    route_id: route_id,
                    distance: 'distance'
                },
                function(data, result) {
                    if (result == "success") {
                        distance = data;
                        console.log("distance: " + data);
                    }
                }
            );

            switch (speed_class) {
                case 1:
                    knots = 23;
                    break;

                case 2:
                    knots = 19;
                    break;

                case 3:
                    knots = 16.5;
                    break;

                case 4:
                    knots = 13.5
                    break;

                default:
                    0;
            }

            eta = knots / distance;
            eta = 0; //ito muna

            console.log("ETA " + eta);

            $.post("../../Controller/ShipController.php", {
                    name: name,
                    speed_class: speed_class,
                    price: price,
                    eta: eta,
                    route_id: route_id,
                    add: 'add'
                },
                function(data, result) {
                    if (result == "success") {


                        if (data == "ok") {
                            Swal.fire({
                                icon: 'success',
                                title: 'The ship has been added successfully!'
                            }).then(() => {
                                window.location = "index.html";
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Sorry, it cannot be saved as of the moment. Error: ' + data
                            })

                            console.log("ano ang error mga bessy: " + data);
                        }
                    }
                }
            );
        }
    });

});