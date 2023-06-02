<?php

namespace App\Http\Controllers;

use App\Models\LiqPayService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PayController extends Controller
{

    public function index(LiqPayService $service)
    {
        return view('pages.pay.index', [
            'data' => $service->getFormData(
                $service
                    ->generatePayParams(2, 9999.95, "Some product")
            ),
        ]);
    }


    public function paymentResult(Request $request): JsonResponse {
        //TODO save to db
        //TODO Migration
        //TODO Model
        //

        return response()->json(['ok' => true]);
    }

}
