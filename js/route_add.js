$(document).ready(function() {

    $("#btn-submit").click(function() {
        console.log("test for route");

        //location 1
        var location1 = $("#location1").val().trim();
        var lat1 = $("#lat1").val().trim();
        var long1 = $("#long1").val().trim();

        //location 2
        var location2 = $("#location2").val().trim();
        var lat2 = $("#lat2").val().trim();
        var long2 = $("#long2").val().trim();


        if (location1 == "" || lat1 == "" || long2 == "" || location2 == "" || lat2 == "" || long2 == "") {
            Swal.fire({
                icon: 'error',
                title: 'Please enter all the required fields.'
            })
        } else {

            var point1 = { latitude: lat1, longitude: long1 };
            var point2 = { latitude: lat2, longitude: long2 };
            var distance = window.geolib.getDistance(point1, point2);

            console.log("distance = " + distance);


            $.post("../../Controller/RouteController.php", {
                    location1: location1,
                    lat1: lat1,
                    long1: long1,
                    location2: location2,
                    lat2: lat2,
                    long2: long2,
                    distance: distance,
                    add: 'add'
                },
                function(data, result) {
                    if (result == "success") {


                        if (data == "ok") {
                            Swal.fire({
                                icon: 'success',
                                title: 'The route has been added successfully!'
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