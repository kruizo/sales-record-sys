<?php

namespace App\Observers;

use App\Models\Orderline;
use App\Models\Order;
use App\Models\DeliveryFee;

class OrderlineObserver
{
    /**
     * Handle the Orderline "created" event.
     *
     * @param  \App\Models\Orderline  $orderline
     * @return void
     */
    public function created(Orderline $orderline)
    {
        //
    }

    /**
     * Handle the Orderline "updated" event.
     *
     * @param  \App\Models\Orderline  $orderline
     * @return void
     */
    public function updated(Orderline $orderline)
    {
        //
    }

    /**
     * Handle the Orderline "deleted" event.
     *
     * @param  \App\Models\Orderline  $orderline
     * @return void
     */

    public function deleted(Orderline $orderline)
    {
        $order = Order::findOrFail($orderline->order_id);

         $orderlineCount = $order->orderline->count();
        dd($orderlineCount);
        if ($orderlineCount === 0) {
        $order->delete();
    } else {

            $deliveryFee = DeliveryFee::find(1)->fee;
            $subtotal = $order->orderline->sum('subtotal');
            $order->total = $subtotal + $deliveryFee;
            $order->save();
        }
    }

    /**
     * Handle the Orderline "restored" event.
     *
     * @param  \App\Models\Orderline  $orderline
     * @return void
     */
    public function restored(Orderline $orderline)
    {
        //
    }

    /**
     * Handle the Orderline "force deleted" event.
     *
     * @param  \App\Models\Orderline  $orderline
     * @return void
     */
    public function forceDeleted(Orderline $orderline)
    {
        //
    }
}
