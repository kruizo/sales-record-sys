function formatDate(date) {
    const dateObject = new Date(date);
    return dateObject.toLocaleDateString("en-US", {
        month: "2-digit",
        day: "2-digit",
        year: "2-digit",
    });
}

function handleOrderLineClick(order, orderline) {
    const orderlineElement = document.getElementById(`item-${orderline.id}`);
    const orderElement = document.getElementById(`order-${order.id}`);

    if (orderElement.classList.contains("border-blue")) {
        orderElement.classList.remove("border-blue");
    } else {
        orderElement.classList.add("border-blue");
    }

    if (!event.target.matches("button")) {
        orderlineElement.classList.toggle("h-28");
    }

    document.getElementById("order-number").innerText = order.id;
    document.getElementById("order-total").innerText = "₱" + order.total;

    document.getElementById("date-ordered").innerText = formatDate(
        order.created_at
    );
    document.getElementById("delivery-date").innerText = orderline.delivery
        ? formatDate(orderline.delivery.delivery_date)
        : "";
    document.getElementById("delivery-address").innerText = orderline.delivery
        ? orderline.delivery.delivery_address
        : "";
    // const deliveryStatus = orderline.delivery.deliverystatus.status;

    // // document.getElementById("delivery-status").innerText = orderline.delivery
    // //     ? orderline.delivery.deliverystatus.description
    // //     : "";
    document.getElementById("payment-type").innerText = order.payment_type;
}
