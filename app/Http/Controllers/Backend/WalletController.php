<?php

namespace App\Http\Controllers\Backend;

use datatables;
use App\Models\Wallet;
use App\Http\Controllers\Controller;

class WalletController extends Controller
{
    public function index()
    {
        return view('backend.wallet');
    }

    public function ssd()
    {
        $data = Wallet::with('user');
        return datatables()->of($data)
        ->addColumn('user', function ($each) {
            if ($each->user) {
                $user = $each->user;
                return '<p>Name : '.$user->name.'</p>
                        <p>Email : '.$user->email.'</p>
                        <p>Phone : '.$user->phone.'</p>';
            }
        })
        ->editColumn('amount', function ($each) {
            return number_format($each->amount, 2);
        })
        ->rawColumns(['user'])
        ->toJson();
    }
}
