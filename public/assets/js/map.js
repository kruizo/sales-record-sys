function showMap() {
    if (currentMarker) {
        const newIframe = document.getElementById("newmap");
        const lat = latitude;
        const lng = longitude;
        resetmarker("newmap");
        document.getElementById("newframe").style.display = "block";

        newIframe.contentWindow.postMessage(
            {
                lat,
                lng,
                action: "view",
            },
            "*"
        );
    } else {
        alert("Please place a marker on the map before confirming.");
    }
}
window.addEventListener("message", handleLocationMessage);

function handleLocationMessage(event) {
    if (
        event.data &&
        typeof event.data === "object" &&
        event.data.lat &&
        event.data.lng
    ) {
        const lat = event.data.lat;
        const lng = event.data.lng;
        latitude = lat;
        longitude = lng;
        currentMarker = true;
        document.getElementById("mapreference").value =
            "Lat: " + latitude + " Lgn: " + longitude;

        document.getElementById("locationtxt").textContent =
            "Lat: " + latitude + " Lgn: " + longitude;
    }
}

function resetmarker(frame) {
    document.getElementById(frame).contentWindow.postMessage(
        {
            action: "resetMarker",
        },
        "*"
    );
}
