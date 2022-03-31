<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AvailableTableRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\TableResource;
use App\Models\Table;
use App\Services\GetAvailableTableService;
use Illuminate\Http\Request;

class AvailableTableController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(AvailableTableRequest $request,GetAvailableTableService $getAvailableTableService)
    {
        $tables = $getAvailableTableService->execute($request->validated());
        return new SuccessResource(TableResource::collection($tables));
    }
}
