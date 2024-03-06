document.addEventListener("DOMContentLoaded", function () {
    SetInitialUIState();

    const sidebarLinks = document.querySelectorAll(".sidebar-link");
    const currentUrl = window.location.href;
    sidebarLinks.forEach((link) => {
        if (link.href === currentUrl) {
            link.classList.add("active");
        }
        link.addEventListener("click", function (event) {
            sidebarLinks.forEach(function (innerLink) {
                innerLink.classList.remove("active");
            });
            return true;
        });
    });

    const checkboxAll = document.getElementById("checkbox-all-search");
    const checkboxes = document.querySelectorAll(".checkbox");

    checkboxAll.addEventListener("change", function () {
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = checkboxAll.checked;
        });
    });

    const orderMarkButtons = document.querySelectorAll(".order-mark-btn");
    const actionInput = document.getElementById("actionInput");
    const statusInput = document.getElementById("statusInput");
    const confirmButton = document.getElementById("confirm-button");
    const orderIdInput = document.getElementById("orderIdInput");
    const completeAllBtn = document.getElementById("markAllCompleteBtn");
    const archiveAllBtn = document.getElementById("markAllArchive");

    orderMarkButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const orderId = this.dataset.id;
            const status = this.dataset.status;
            const action = this.dataset.action;

            orderIdInput.value = orderId;
            actionInput.value = action;
            statusInput.value = status;

            confirmButton.addEventListener("click", function () {
                const form = document.getElementById("mark-orders-form");
                form.submit();
            });
        });
    });

    completeAllBtn.addEventListener("click", handleBulkAction);
    archiveAllBtn.addEventListener("click", handleBulkAction);

    function handleBulkAction() {
        const action = this.getAttribute("data-action");
        const status = this.getAttribute("data-status");
        const actionInput = document.getElementById("actionInput");
        const statusInput = document.getElementById("statusInput");
        actionInput.value = action;
        statusInput.value = status;

        confirmButton.addEventListener("click", function () {
            const form = document.getElementById("mark-orders-form");
            form.submit();
        });
    }

    const saveBtn = document.querySelector("#save-btn");
    const removeBtns = document.querySelectorAll(".remove-btn");
    const completeBtns = document.querySelectorAll(".complete-btn");
    const cancelBtn = document.querySelector("#cancel-btn");
    const orderlineItems = document.querySelectorAll(".orderline-item");

    let selectedOrderlineIdsToComplete = [];
    let selectedOrderlineIdsToRemove = [];

    completeBtns.forEach(function (completeBtn) {
        completeBtn.addEventListener("click", function () {
            const orderlineId = this.dataset.id;
            const orderlineItem = document.getElementById(
                `orderline-item-${orderlineId}`
            );

            if (orderlineItem.classList.contains("bg-green-400")) {
                orderlineItem.classList.remove("bg-green-400");
                this.innerText = "Complete";
                const index =
                    selectedOrderlineIdsToComplete.indexOf(orderlineId);
                if (index !== -1) {
                    selectedOrderlineIdsToComplete.splice(index, 1); // Remove unmarked orderline ID
                }
            } else {
                orderlineItem.classList.add("bg-green-400");
                this.innerText = "Marked";
                selectedOrderlineIdsToComplete.push(orderlineId); // Add marked orderline ID
            }
        });
    });
    saveBtn.addEventListener("click", async function () {
        try {
            const promises = [];

            if (selectedOrderlineIdsToComplete) {
                console.log(
                    "Selected orderline ID:",
                    selectedOrderlineIdsToComplete
                );
                promises.push(
                    completeOrderline(selectedOrderlineIdsToComplete)
                );
            }
            if (selectedOrderlineIdsToRemove) {
                promises.push(removeOrderline(selectedOrderlineIdsToRemove));
            }

            await Promise.all(promises);
            location.reload();
        } catch (error) {
            console.error("Error:", error);
        }
    });

    cancelBtn.addEventListener("click", function () {
        console.log("executed");
        orderlineItems.forEach(function (orderlineItem) {
            orderlineItem.classList.remove("bg-green-400");
            orderlineItem.classList.remove("hidden");
        });
        completeBtns.forEach(function (completeBtn) {
            completeBtn.innerText = "Complete";
        });
    });

    async function completeOrderline(orderlineIds) {
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

        if (!Array.isArray(orderlineIds)) {
            orderlineIds = [orderlineIds];
        }

        console.log(orderlineIds);

        const responses = await Promise.all(
            orderlineIds.map(async (orderlineId) => {
                const response = await fetch(
                    `/update-orderline/${orderlineId}/2`,
                    {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": csrfToken,
                        },
                    }
                );

                if (!response.ok) {
                    throw new Error(
                        `Failed to complete orderline ${orderlineId}`
                    );
                }

                return response;
            })
        );

        console.log("All orderlines completed successfully");
        return responses;
    }

    removeBtns.forEach(function (removeBtn) {
        removeBtn.addEventListener("click", function () {
            const orderlineId = this.dataset.id;
            const orderlineItem = document.querySelector(
                `#orderline-item-${orderlineId}`
            );
            orderlineItem.classList.add("hidden");
            selectedOrderlineIdsToRemove.push(orderlineId);
        });
    });

    async function removeOrderline(orderlineIds) {
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

        if (!Array.isArray(orderlineIds)) {
            orderlineIds = [orderlineIds];
        }

        try {
            const fetchPromises = orderlineIds.map((orderlineId) => {
                return fetch(`/remove-orderline/${orderlineId}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                }).then((response) => {
                    if (response.ok) {
                        console.log(
                            `Orderline ${orderlineId} removed successfully`
                        );
                    } else {
                        console.error(
                            `Failed to remove orderline ${orderlineId} `
                        );
                    }
                });
            });
            await Promise.all(fetchPromises);
        } catch (error) {
            console.error("Error:", error);
        }
    }

    // function markOrdersArchive(orderIds) {
    //     const status = 1;
    //     const csrfToken = document
    //         .querySelector('meta[name="csrf-token"]')
    //         .getAttribute("content");

    //     orderIds.forEach((orderId) => {
    //         console.log(orderId);
    //         fetch(`/set-archive/${orderId}/${status}`, {
    //             method: "POST",
    //             headers: {
    //                 "Content-Type": "application/json",
    //                 "X-CSRF-TOKEN": csrfToken,
    //             },
    //         })
    //             .then((response) => {
    //                 if (response.ok) {
    //                     console.log(`Order ${orderId} archived successfully`);
    //                 } else {
    //                     console.error(
    //                         `Failed to mark order ${orderId} as complete`
    //                     );
    //                 }
    //             })
    //             .catch((error) => {
    //                 console.error("Error:", error);
    //             });
    //     });
    // }

    var mapButtons = document.querySelectorAll("[id^='table-map-']");
    mapButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            var mapReference = this.getAttribute("data-loc");

            var matches = mapReference.match(
                /Lat:\s*([-+]?\d*\.\d+)\s*Lgn:\s*([-+]?\d*\.\d+)/
            );
            var lat = parseFloat(matches[1]);
            var lng = parseFloat(matches[2]);

            var modal = document.getElementById(
                this.getAttribute("data-modal-target")
            );

            var mapIframe = modal.querySelector("iframe#map");

            mapIframe.contentWindow.postMessage(
                { lat, lng, action: "view" },
                "*"
            );

            modal.classList.remove("hidden");
        });
    });

    var button = document.getElementById("table-map");
    if (button) {
        button.addEventListener("click", handleClick);
    }

    const rowRange = document.getElementById("minmax-range");
    const maxRow = document.getElementById("maxrow");

    rowRange.addEventListener("input", function () {
        maxRow.textContent = rowRange.value;
    });

    var searchInput = document.querySelector("#table-search");

    searchInput.addEventListener("input", function (event) {
        var searchTerm = searchInput.value.trim().toLowerCase();
        var rows = document.querySelectorAll("tbody tr");
        rows.forEach(function (row) {
            var textContent = row.textContent.toLowerCase();
            if (textContent.includes(searchTerm)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
});

function SetInitialUIState() {
    const urlParams = new URLSearchParams(window.location.search);

    if (urlParams.has("delivery[]")) {
        const deliveryValues = urlParams.getAll("delivery[]");
        console.log(deliveryValues);
        deliveryValues.forEach(function (value) {
            const decodedValue = decodeURIComponent(value);
            console.log(`decoded ${decodedValue}`);
            document.getElementById(decodedValue).checked = true;
        });
    }

    if (urlParams.has("status[]")) {
        const statusValues = urlParams.getAll("status[]");
        statusValues.forEach(function (value) {
            const decodedValue = decodeURIComponent(value);
            document.getElementById(decodedValue).checked = true;
        });
    }

    const rowSize = urlParams.get("rowSize");
    if (rowSize) {
        document.getElementById("minmax-range").value = rowSize;
        document.getElementById("maxrow").textContent = rowSize;
    }
}
