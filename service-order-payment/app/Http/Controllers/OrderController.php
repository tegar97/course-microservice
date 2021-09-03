<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use illuminate\support\Str;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $userId = $request->input('user_id');
        $order = Order::query();

        $order->when($userId, function ($query) use ($userId) {
            return $query->where('user_id', '=', $userId);
        });


        return response()->json([
            'status' => 'success',
            'data' => $order->get()
        ]);
    }

    public function create(Request $request)
    {
        $user = $request->input('user');
        $course = $request->input('course');

        $order = Order::create([
            'user_id' => $user['id'],
            'course_id' => $course['id']
        ]);

        $transactionDetails = [
            'order_id' => $order->id . '-' . Str::random(5),
            'gross_amount' => $course['price']
        ];

        $itemDetails = [
            [
                'id' => $course['id'],
                'price' => $course['price'],
                'quantity' => 1,
                'name' => $course['name'],
                'brand' => 'BuildWithAngga',
                'category' => 'online Course'
            ]
        ];
        $custumerDetails = [
            'first_name' => $user['name'],
            'email' => $user['email']
        ];
        $midTransParams = [
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => $custumerDetails,
        ];

        $midtransSnapUrl =  $this->getMidtransSnapUrl($midTransParams);

        $order->snap_url = $midtransSnapUrl;
        $order->meta_data = [
            'course_id' => $course['id'],
            'course_price' => $course['price'],
            'course_name' => $course['name'],
            'course_thumbnail' => $course['thumbnail'],
            'course_level' => $course['level']
        ];

        $order->save();
        return response()->json([
            'status' => 'success',
            'data' => $order
        ]);
        // return response()->json($order);
    }
    private function getMidtransSnapUrl($params)
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = (bool) env('MIDTRANS_PRODUCTION');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = (bool) env('MIDTRANS_3DS');


        $snapUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;
        return $snapUrl;
    }
}
