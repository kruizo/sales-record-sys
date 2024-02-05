function formatDate(date) {
    const dateObject = new Date(date);
    return dateObject.toLocaleDateString("en-US", {
        month: "2-digit",
        day: "2-digit",
        year: "2-digit",
    });
}

let recent = "";
function handleOrderLineClick(order, orderline) {
    if (recent !== "" && orderline.id !== recent) {
        console.log("if executed");
        document.getElementById(`item-${recent}`).style.border = "none";
    }
    document.getElementById(`item-${orderline.id}`).style.border =
        "2px solid #1e40af";
    recent = orderline.id;

    document.getElementById("order-number").innerText = orderline.id;
    document.getElementById("date-ordered").innerText = formatDate(
        order.created_at
    );
    document.getElementById("delivery-date").innerText = orderline.delivery
        ? formatDate(orderline.delivery.delivery_date)
        : "";
    document.getElementById("delivery-address").innerText = orderline.delivery
        ? orderline.delivery.delivery_address
        : "";
    document.getElementById("delivery-status").innerText = orderline.delivery
        ? orderline.delivery.deliverystatus.status
        : "";
    document.getElementById("payment-type").innerText = order.payment_type;

    document.getElementById("order-information").classList.remove("hidden");
}
