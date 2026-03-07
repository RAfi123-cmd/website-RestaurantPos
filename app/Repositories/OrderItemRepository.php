<?php

namespace App\Repositories;

use App\Models\OrderItem;
use Illuminate\Validation\ValidationException;

class OrderItemRepository {
    // Implement methods for order item data access

    public function getByOrderAndMenu(int $orderId, int $menuId){
        return OrderItem::where('order_id', $orderId)->where('menu_id', $menuId)->first();
    }

    public function updateQty(int $orderId, int $menuId, int $qty){
        $orderItem = $this->getByOrderAndMenu($orderId, $menuId);
        if(!$orderItem){
            throw ValidationException::withMessages(['order_item' => 'Order item not found']);
        }

        $orderItem->update([
            'quantity' => $qty,
            'subtotal' => $qty * $orderItem->price
        ]);

        return $orderItem;
    }
}