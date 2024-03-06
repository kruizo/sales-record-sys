<?php

namespace App\Observers;

use App\Models\Delivery;
use App\Models\Orderline;
use App\Models\Order;

class DeliveryObserver
{
    /**
     * Handle the Delivery "created" event.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return void
     */
    public function created(Delivery $delivery)
    {
        //
    }

    /**
     * Handle the Delivery "updated" event.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return void
     */
    public function updated(Delivery $delivery)
    {
        if ($delivery->delivery_status == 3) {
            $orderlines = Orderline::where('delivery_id', $delivery->id)->get();
            $orderIds = $orderlines->pluck('order_id')->unique();
            
            foreach ($orderIds as $orderId) {
                $order = Order::findOrFail($orderId);
                $subtotal = Orderline::where('order_id', $orderId)
                                     ->where('delivery_status', '!=', 3)
                                     ->sum('subtotal');
                $deliveryFee = $order->delivery_fee;
                $order->total = $subtotal + $deliveryFee;
                $order->save();
            }
        }
    }

    /**
     * Handle the Delivery "deleted" event.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return void
     */
    public function deleted(Delivery $delivery)
    {
        //
    }

    /**
     * Handle the Delivery "restored" event.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return void
     */
    public function restored(Delivery $delivery)
    {
        //
    }

    /**
     * Handle the Delivery "force deleted" event.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return void
     */
    public function forceDeleted(Delivery $delivery)
    {
        //
    }
}
