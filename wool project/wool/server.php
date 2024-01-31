<?php
header('Content-Type: application/json');

// Set up database connection (replace with your actual database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wool_monitoring";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle API request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $trackingNumber = isset($_GET['trackingNumber']) ? $_GET['trackingNumber'] : null;

    if (!$trackingNumber) {
        echo json_encode(['error' => 'Tracking number not provided']);
        http_response_code(400);
        exit;
    }

    $sql = "SELECT * FROM tracking_data WHERE tracking_number = '$trackingNumber' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $coordinates = ['lat' => $row['latitude'], 'lng' => $row['longitude']];
        $trackingLink = generateTrackingLink($trackingNumber);

        $response = [
            'coordinates' => $coordinates,
            'trackingLink' => $trackingLink,
        ];

        echo json_encode($response);
    } else {
        echo json_encode(['error' => 'Tracking data not found']);
        http_response_code(404);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
    http_response_code(405);
}

// Function to generate the link to the GPS track page
function generateTrackingLink($trackingNumber) {
    return "gps_track_page.php?trackingNumber=$trackingNumber";
}

$conn->close();
?>

