document.addEventListener("DOMContentLoaded", function () {
    const receipt = document.getElementById("receipt-container");
    const generateBtn = document.getElementById("generate-receipt");
    const closeBtn = document.getElementById("close-receipt");

    // Show the receipt when clicking "Generate Receipt"
    generateBtn.addEventListener("click", function () {
        receipt.style.display = "block";
    });

    // Hide the receipt when clicking the close button
    closeBtn.addEventListener("click", function () {
        receipt.style.display = "none";
    });

    // Hide the receipt when clicking outside of it
    document.addEventListener("click", function (event) {
        if (!receipt.contains(event.target) && event.target !== generateBtn) {
            receipt.style.display = "none";
        }
    });

    document.querySelectorAll(".cancel-order-btn").forEach((button) => {
        button.addEventListener("click", function () {
            let orderId = this.getAttribute("data-id");

            fetch(`/cancel-order/${orderId}`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ id: orderId }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        document.querySelector(`#order-${orderId}`).remove();
                    } else {
                        alert("Failed to cancel order.");
                    }
                })
                .catch((error) => console.error("Error:", error));
        });
    });

    const cancelBtn = document.getElementById("cancel-order-btn"); // Adjust the ID

    if (cancelBtn) {
        cancelBtn.addEventListener("click", function (event) {
            event.preventDefault(); // Prevent any default behavior
            window.location.href = "/"; // Change to your main page URL
        });
    }
});
