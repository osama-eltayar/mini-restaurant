<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRequest;
use App\Http\Resources\SuccessResource;
use App\Models\Reservation;
use App\Services\StoreReservationService;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(ReservationRequest $request,StoreReservationService $storeReservationService)
    {
        $storeReservationService->execute($request->validated());
        return new SuccessResource([],'reservation created succesful') ;
    }
}
