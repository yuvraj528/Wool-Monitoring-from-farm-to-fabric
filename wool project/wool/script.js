async function trackWool() {
    const trackingNumber = document.getElementById('trackingNumber').value;

    try {
        const response = await fetch(`server.php?trackingNumber=${trackingNumber}`);
        const data = await response.json();

        if (response.ok) {
            displayMap(data.coordinates);
            openGPSPage(data.trackingLink);
        } else {
            console.error(data.error);
        }
    } catch (error) {
        console.error('Error fetching tracking data:', error);
    }
}

function openGPSPage(trackingLink) {
    window.open(trackingLink, '_blank');
}

function displayMap(coordinates) {
    // Implement your map display logic here
    console.log('Displaying Map:', coordinates);
}
