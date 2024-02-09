function formatDate(date) {
    const dateObject = new Date(date);
    return dateObject.toLocaleDateString("en-US", {
        month: "2-digit",
        day: "2-digit",
        year: "2-digit",
    });
}

let recent = "";
function handleOrderLineClick(orderline) {
    if (recent !== "" && orderline !== recent) {
        document.getElementById(`item-${recent}`).style.border = "none";
    }
    document.getElementById(`item-${orderline}`).classList.toggle("h-28");

    document.getElementById(`item-${orderline}`).style.boxShadow =
        "2px  #1e40af";
    recent = orderline;
}
