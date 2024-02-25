let currentMarker = false;
let latitude = 0;
let longitude = 0;
let activebtn = "";
const firstName = document.getElementById("firstname");
const lastName = document.getElementById("lastname");
const email = document.getElementById("email");
const contactnumber = document.getElementById("contactnumber");
const deliveryaddress = document.getElementById("deliveryaddress");
const date = document.getElementById("date");
const time = document.getElementById("time");
const specialinstruction = document.getElementById("specialinstruction");
const paymentMethodRadios = document.getElementsByName("payment_method");
const reviewOrderContainer = document.getElementById("review-orders");
let selectedPaymentMethod = "";

const productDataElement = document.getElementById("product-data");
const productData = JSON.parse(
    productDataElement.getAttribute("data-products")
);



document.addEventListener("DOMContentLoaded", function () {
    var today = new Date();
    var day = String(today.getDate()).padStart(2, "0");
    var month = String(today.getMonth() + 1).padStart(2, "0"); // January is 0!
    var year = today.getFullYear();
    var defaultDate = month + "-" + day + "-" + year;
    document.getElementById("date").defaultValue = defaultDate;
});

let order = {
    products: {},
    deliveryFee: 10,
    orderCount: 0,
};
productData.forEach((product) => {
    order.products[product.type] = {
        name: product.name,
        price: product.cost,
        quantity: 0,
    };
});

function updateOrder() {
    const orderInformation = document.getElementById("order-information");
    orderInformation.innerHTML = "";
    const totalorderfield = document.querySelector("#total-input");
    totalorderfield.value = order.orderCount;
    const totalOrder = document.createElement("h1");
    totalOrder.id = "total-text";
    totalOrder.innerText = `You have ${order.orderCount} order(s)`;

    orderInformation.appendChild(totalOrder);

    for (const productId in order.products) {
        const product = order.products[productId];

        if (product.quantity > 0) {
            const productName = document.createElement("h1");
            productName.id = `product-${product.name}`;
            productName.innerText = `${product.quantity} ${product.name}`;

            const productSubtotal = document.createElement("h2");
            productSubtotal.id = `product-subtotal-${product.name}`;
            productSubtotal.innerText = `₱${product.price * product.quantity}`;

            const productContainer = document.createElement("div");
            productContainer.id = "product-container";
            productContainer.classList.add("flex", "justify-between");
            productContainer.appendChild(productName);
            productContainer.appendChild(productSubtotal);

            orderInformation.appendChild(productContainer);
        }
    }

    if (order.orderCount > 0) {
        const deliveryText = document.createElement("h1");
        deliveryText.id = "delivery-text";
        deliveryText.innerText = "Delivery Fee";

        const deliveryTotal = document.createElement("h2");
        deliveryTotal.id = "delivery-total";
        deliveryTotal.innerText = `₱${order.deliveryFee}`;

        const deliveryContainer = document.createElement("div");
        deliveryContainer.classList.add("flex", "justify-between");
        deliveryContainer.appendChild(deliveryText);
        deliveryContainer.appendChild(deliveryTotal);

        orderInformation.appendChild(deliveryContainer);

        const totalText = document.createElement("h1");
        totalText.id = "total-text";
        totalText.innerText = "Total";

        const totalAmount = calculateTotal();

        const total = document.createElement("h2");
        total.id = "total";
        total.innerText = `₱${totalAmount}`;

        const totalContainer = document.createElement("div");
        totalContainer.classList.add("flex", "justify-between");
        totalContainer.appendChild(totalText);
        totalContainer.appendChild(total);

        orderInformation.appendChild(totalContainer);
        const clonedOrderInformation = orderInformation.cloneNode(true);
        reviewOrderContainer.innerHTML = "";
        reviewOrderContainer.appendChild(clonedOrderInformation);
    }

    const clonedOrderInformation = orderInformation.cloneNode(true);
    reviewOrderContainer.innerHTML = "";
    reviewOrderContainer.appendChild(clonedOrderInformation);
}

function calculateTotal() {
    let total = 0;
    for (const productId in order.products) {
        const product = order.products[productId];
        total += product.price * product.quantity;
    }
    if (order.orderCount > 0) {
        total += order.deliveryFee;
    }
    return total;
}

function updateSubtotal(id) {
    try {
        const quantityInput = document.getElementById(id);
        order.products[id].quantity = parseInt(quantityInput.value, 10);

        order.orderCount = Object.values(order.products).reduce(
            (acc, product) => acc + product.quantity,
            0
        );

        updateOrder();
    } catch (error) {
        console.error(error);
    }
}

function toggleCard(productId) {
    var hiddenDiv = document.getElementById(productId + "-hidden");
    var card = document.getElementById(productId + "-card");

    hiddenDiv.classList.toggle("hidden");
    card.classList.toggle(
        "shadow-blue-700",
        !hiddenDiv.classList.contains("hidden")
    );
    card.classList.toggle(
        "shadow-2xl",
        !hiddenDiv.classList.contains("hidden")
    );
    var cards = document.querySelectorAll(".card");

    var isAnyCardToggled = Array.from(cards).some((card) =>
        card.querySelector(".hidden")
    );

    if (hiddenDiv.classList.contains("hidden")) {
        document.getElementById(productId).value = 0;
    } else {
        document.getElementById(productId).value = 1;
    }

    updateSubtotal(productId);
}

function incrementInput(productId) {
    var inputElement = document.getElementById(productId);
    inputElement.value = parseInt(inputElement.value) + 1;

    updateSubtotal(productId);
}

function decrementInput(productId) {
    const inputElement = document.getElementById(productId);
    let currentValue = parseInt(inputElement.value);
    if (currentValue == 1) {
        toggleCard(productId);
    }
    if (currentValue > 0) {
        inputElement.value = currentValue - 1;
    }
    updateSubtotal(productId);
}

window.addEventListener("message", handleLocationMessage);

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

function populateReviewModal() {
    for (const radio of paymentMethodRadios) {
        if (radio.checked) {
            selectedPaymentMethod = radio.value;
            break;
        }
    }

    document.getElementById("review-name").textContent =
        firstName.value + " " + lastName.value;
    document.getElementById("review-email").textContent = email.value;
    document.getElementById("review-contactnumber").textContent =
        contactnumber.value;
    document.getElementById("review-deliveryaddress").textContent =
        deliveryaddress.value;
    document.getElementById("review-date").textContent =
        date.value + " " + time.value;
    document.getElementById("review-paymentmethod").textContent =
        selectedPaymentMethod;
    document.getElementById("review-specialinstruction").textContent =
        specialinstruction.value;
}
