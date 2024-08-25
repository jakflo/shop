<?php

namespace app\pages\order;

use \app\utils\JsonResponse;

class OrderConroller extends \app\conf\BaseController
{
    
    public function render(\stdClass $parameters) {
        $get = $parameters->get;
        $order_id = isset($get['id']) ? (int)$get['id'] : 0;
        
        if ($order_id === 0) {
            JsonResponse::sendClientError(['error' => 'id parameter must be integer']);
        }
        
        try {
            $order_data = $this->getModel()->printOrder($order_id);
            JsonResponse::sendResponse(['order' => $order_data]);
        } catch(OrderNotFoundException $e) {
            JsonResponse::sendNotFound(['error' => 'Order not found']);
        }
        
    }
    
    protected function setModel()
    {
        $this->model = new \app\pages\order\OrderModel($this->env);
    }
    
}
