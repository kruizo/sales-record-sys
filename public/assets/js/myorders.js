

function formatDate(date){
    const dateObject = new Date(date);
    return dateObject.toLocaleDateString('en-US', {
        month: '2-digit',
        day: '2-digit',
        year: '2-digit'
    });
}

let recent="";
function handleOrderLineClick(order, orderline) {
    if (recent !== "" && orderline.id !== recent) {
        // If recent is not empty and orderline.id is different from recent
        document.getElementById(`item-${recent}`).classList.remove("border-blue-800", "border-2");
    }
    document.getElementById(`item-${orderline.id}`).classList.add("border-blue-800","border-2");
    recent=orderline.id;
  
    document.getElementById('order-number').innerText = order.id;
    document.getElementById('date-ordered').innerText =formatDate(order.created_at);
    document.getElementById('delivery-date').innerText = order.delivery ? formatDate(order.delivery.delivery_date) : '';
    document.getElementById('delivery-address').innerText = order.delivery ? order.delivery.delivery_address : '';
    document.getElementById('delivery-status').innerText = order.delivery ? order.delivery.delivery_status : '';
    document.getElementById('payment-type').innerText = order.payment_type;

    document.getElementById('order-information').classList.remove('hidden');

}
