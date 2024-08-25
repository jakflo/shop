<?php

namespace app\pages\order;

use \app\pages\order\OrderEntity;
use \app\pages\order\ItemEntity;

class OrderModel extends \app\conf\BaseModel
{
    public function printOrder(int $id)
    {
        $order = $this->env->db->queryRow(
                "SELECT o.*, dc.name AS currency, ds.name AS state 
                FROM `order` o 
                JOIN dial_currency dc ON o.dial_currency_id = dc.id 
                JOIN dial_state ds ON o.dial_state_id = ds.id 
                WHERE o.id = :oid", 
                ['oid' => $id]
        );
        
        if (!$order) {
            throw new OrderNotFoundException('Objednavka nenalezena');
        }
        
        $order_entity = new OrderEntity($order['id'],
                $order['user_id'],
                $order['price'],
                $order['created'],
                $order['note'],
                $order['currency'],
                $order['state']);
        
        $order_entity->setItems($this->printOrderItems($id));
        return $order_entity;
    }
    
    protected function printOrderItems(int $order_id)
    {
        $items = $this->env->db->queryAll(
                "SELECT i.*, ohi.item_amount AS amount, dc.name AS currency  
                FROM order_has_item ohi 
                JOIN item i ON ohi.item_id = i.id 
                JOIN dial_currency dc ON i.dial_currency_id = dc.id 
                WHERE ohi.order_id = :oid", 
                ['oid' => $order_id]
        );
        
        $return = [];
        foreach ($items as $item) {
            $return[] = (new ItemEntity(
                            $item['id'],
                            $item['name'],
                            $item['price'],
                            $item['currency'],
                            $item['description'],
                            $item['amount']
            ));
        }
        
        return $return;
    }
    
}
