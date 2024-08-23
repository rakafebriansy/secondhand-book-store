<?php
namespace App\Services\Impl;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Services\PaymentService;
use Illuminate\Support\Facades\DB;

class PaymentServiceImpl implements PaymentService {
    public function beforePayment(array $data, int $total_price): array
    {
        try {
            DB::beginTransaction();
            $user = auth()->user();
    
            $transaction = new Transaction();
            $transaction->id = uniqid('rr_',false);
            $transaction->user_id = $user->id;
            $transaction->total_price = $total_price;
            $transaction->save();

            $transactionId = $transaction->id;
            
            foreach ($data as $item) {
                $transaction_detail = new TransactionDetail();
                $transaction_detail->quantity = $item->quantity;
                $transaction_detail->product_id = $item->id;
                $transaction_detail->transaction_id = $transactionId;
                $transaction_detail->save();
            }

            \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
            \Midtrans\Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
            \Midtrans\Config::$is3ds = env('MIDTRANS_IS_3DS');

            $params = array(
                'transaction_details' => array(
                    'order_id' => $transaction->id,
                    'gross_amount' => $total_price,
                ),
                'customer_details' => array(
                    'first_name' => $user->name,
                    'email' => $user->email
                ),
            );
            $snap_token = \Midtrans\Snap::getSnapToken($params);

            DB::commit();
            return [
                'snap_token' => $snap_token,
                'transaction_id' => $transaction->id
            ];
        } catch (\Exception $error) {
            DB::rollBack();
            throw $error;
        }
    }
    public function orderConfirmation(string $transaction_id): Transaction
    {
        $transaction = Transaction::select('transactions.id', 'transactions.payment_method','transactions.created_at', 'users.name', 'users.email', 'users.address')
        ->join('users','transactions.user_id','users.id')
        ->where('transactions.id',$transaction_id)
        ->first();
        return $transaction;
    }
}

?>