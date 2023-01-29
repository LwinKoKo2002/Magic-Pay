<?php
namespace App\Helpers;

use App\Models\Wallet;
use App\Models\Transaction;

class Generator
{
    public static function account_number()
    {
        $number = mt_rand(1000000000000000, 9999999999999999);
        if (Wallet::where('account_number', $number)->exists()) {
            selft::account_number();
        }
        return $number;
    }

    public static function ref_number()
    {
        $number = mt_rand(100000000000, 999999999999);
        if (Transaction::where('ref_no', $number)->exists()) {
            self::ref_number();
        }
        return $number;
    }

    public static function trx_id()
    {
        $number = mt_rand(100000000000, 999999999999);
        if (Transaction::where('trx_id', $number)->exists()) {
            self::trx_id();
        }
        return $number;
    }
}
