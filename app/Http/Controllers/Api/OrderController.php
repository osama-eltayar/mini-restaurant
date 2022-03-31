<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\SuccessResource;
use App\Services\StoreOrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(OrderRequest $orderRequest,StoreOrderService $storeOrderService)
    {
        $order = $storeOrderService->execute($orderRequest->validated());
        return new SuccessResource(new OrderResource($order));
    }
}
