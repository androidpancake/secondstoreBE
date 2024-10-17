<?php

namespace App\Http\Controllers\api;

use App\Classes\ApiResponseClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Models\Bookings;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function index()
    {
        $data = Bookings::paginate(10);
        return ApiResponseClass::sendResponse($data, 'success', 200);
    }

    public function cust_booking(BookingRequest $request)
    {
        // code for check updated stock

        $data = $request->all();

        $product = Products::find($data['product_id']);

        if ($data['amount'] < $product->stock)
        {
            
        }
        
        $productData = Products::find($data['product_id']);

        if ($productData) {
            if ($data['cust_price'] < $productData->price * $data['amount']) {
                // ApiResponseClass::throw($productData, '')
            }
        }
    }

    public function approve_booking() {}

    public function show(Bookings $booking) {}
}
