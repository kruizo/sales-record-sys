<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <title>MAP</title>
</head>
<style>
    #map {
        height: 570px;
        width: 100%;
    }
</style>

<body>
    <div id="map"></div>
    <script>
        function sendMarkerLocation(lat, lng) {
            const location = {
                lat,
                lng
            };
            window.parent.postMessage(location, '*');
        }

        window.addEventListener('message', function(event) {
            if (event.data && event.data.action === 'resetMarker') {
                if (currentMarker) {
                    map.removeLayer(currentMarker);
                    currentMarker = null;
                }
            } else if (event.data && event.data.action === 'view') {
                const lat = event.data.lat;
                const lng = event.data.lng;
                map.doubleClickZoom.disable();

                map.setView([lat, lng], 15);
                currentMarker = L.marker([lat, lng]).addTo(map);
                map.options.interactive = false;

            }
        });

        let map = L.map('map').setView([7.06805668232607, 125.59504224069889], 18); // Default view at (0, 0) with zoom level 13

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        let currentMarker = null;

        map.on('click', (event) => {
            if (map.doubleClickZoom.enabled()) {
                if (currentMarker) {
                    map.removeLayer(currentMarker);
                }

                const lat = event.latlng.lat;
                const lng = event.latlng.lng;

                const marker = L.marker([lat, lng]).addTo(map).bindPopup(`Lat: ${lat}, Lng: ${lng}`);

                currentMarker = marker;

                sendMarkerLocation(lat, lng);
            }

        });
    </script>

</body>

</html>