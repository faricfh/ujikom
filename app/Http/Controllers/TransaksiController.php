<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order;
use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;
use DB;
use Auth;

class TransaksiController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;

        // Set midtrans configuration
        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');
    }

    private function getCarts()
    {
        $carts = json_decode(request()->cookie('dw-carts'), true);
        $carts = $carts != '' ? $carts : [];
        return $carts;
    }

    public function submitOrder()
    {
        \DB::transaction(function () {
            //get data cart
            $carts = $this->getCarts();

            foreach ($carts as $data) {
                $qty = $data['qty'];
                $produk = $data['nama_produk'];
            }
            
            // Save order ke database
            $order = Order::create([
                'nama_customer' => $this->request->nama_customer,
                'phone_customer' => $this->request->phone_customer,
                'alamat_customer' => $this->request->alamat_customer,
                'subtotal' => floatval($this->request->subtotal),
            ]);

            // Buat transaksi ke midtrans kemudian save snap tokennya.
            $payload = [
                'transaction_details' => [
                    'order_id'      => $order->id,
                    'gross_amount'  => $order->subtotal,
                ],
                'customer_details' => [
                    'first_name'    => $order->nama_customer,
                    'email'         => $this->request->email_customer,
                    // 'phone'         => '08888888888',
                    // 'address'       => '',
                ],
                'item_details' => [
                    [
                        'id'       => $order->id,
                        'price'    => $order->subtotal,
                        'quantity' => $qty,
                        'name'     => ucwords(str_replace('_', ' ', $produk))
                    ]
                ]
            ];
            $snapToken = Veritrans_Snap::getSnapToken($payload);
            $order->snap_token = $snapToken;
            $order->save();

            // Beri response snap token
            $this->response['snap_token'] = $snapToken;
        });

        return response()->json($this->response);
    }

    /**
     * Midtrans notification handler.
     *
     * @param Request $request
     *
     * @return void
     */
    public function notificationHandler(Request $request)
    {
        $notif = new Veritrans_Notification();
        \DB::transaction(function () use ($notif) {

            $transaction = $notif->transaction_status;
            $type = $notif->payment_type;
            $orderId = $notif->order_id;
            $fraud = $notif->fraud_status;
            $order = Order::findOrFail($orderId);

            if ($transaction == 'capture') {

                // For credit card transaction, we need to check whether transaction is challenge by FDS or not
                if ($type == 'credit_card') {

                    if ($fraud == 'challenge') {
                        // TODO set payment status in merchant's database to 'Challenge by FDS'
                        // TODO merchant should decide whether this transaction is authorized or not in MAP
                        // $donation->addUpdate("Transaction order_id: " . $orderId ." is challenged by FDS");
                        $order->setPending();
                    } else {
                        // TODO set payment status in merchant's database to 'Success'
                        // $donation->addUpdate("Transaction order_id: " . $orderId ." successfully captured using " . $type);
                        $order->setSuccess();
                    }
                }
            } elseif ($transaction == 'settlement') {

                // TODO set payment status in merchant's database to 'Settlement'
                // $donation->addUpdate("Transaction order_id: " . $orderId ." successfully transfered using " . $type);
                $order->setSuccess();
            } elseif ($transaction == 'pending') {

                // TODO set payment status in merchant's database to 'Pending'
                // $donation->addUpdate("Waiting customer to finish transaction order_id: " . $orderId . " using " . $type);
                $order->setPending();
            } elseif ($transaction == 'deny') {

                // TODO set payment status in merchant's database to 'Failed'
                // $donation->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is Failed.");
                $order->setFailed();
            } elseif ($transaction == 'expire') {

                // TODO set payment status in merchant's database to 'expire'
                // $donation->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is expired.");
                $order->setExpired();
            } elseif ($transaction == 'cancel') {

                // TODO set payment status in merchant's database to 'Failed'
                // $donation->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is canceled.");
                $order->setFailed();
            }
        });

        return;
    }
}
