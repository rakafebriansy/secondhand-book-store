<?php

namespace App\Services;
use App\Models\Transaction;
interface PaymentService {
    function beforePayment(array $data, int $total_price): array;
    function orderConfirmation(string $transaction_id): Transaction;
}

?>