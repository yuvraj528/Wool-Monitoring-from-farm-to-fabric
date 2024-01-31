<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Coordinates on Map</title>
    <!-- Include the Google Maps JavaScript API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtuc9fQjZRNd1lJdmBeFi06rvMI6Qhf7I&callback=initMap" async defer></script>
</head>
<body>
    <!-- Create a div to hold the map -->
    <div id="map" style="height: 600px; width: 100%;"></div>
    

<script>
        // Initialize the map
        function initMap() {
            // Create a map object centered at a specific location
            const map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 0, lng: 0 }, // Default coordinates
                zoom: 2,
            });
            
            

            // Fetch coordinates dynamically based on tracking number from the database
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "wool_monitoring";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if (isset($_GET['trackingNumber'])) {
                $trackingNumber = $_GET['trackingNumber'];

                $sql = "SELECT * FROM tracking_data WHERE tracking_number = '$trackingNumber'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $latitude = $row['latitude'];
                    $longitude = $row['longitude'];

                    echo "setMapCenter(map, $latitude, $longitude);\n";
                } else {
                    echo "alert('Tracking number not found.');\n";
                }
            }
                echo "setMapCenter(map, $latitude, $longitude);\n";
                echo "addMarker(map, $latitude, $longitude);\n";


            $conn->close();
            ?>

            // Function to set map center dynamically
            function setMapCenter(map, latitude, longitude) {
                map.setCenter({ lat: latitude, lng: longitude });
                map.setZoom(12); // Adjust the zoom level as needed
            }
        }
        function addMarker(map, latitude, longitude) {
        new google.maps.Marker({
        position: { lat: latitude, lng: longitude },
        map: map,
        title: 'Tracking Location',
        });
    }
    </script>
</body>
</html>
