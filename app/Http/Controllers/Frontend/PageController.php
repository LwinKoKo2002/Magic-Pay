<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Helpers\Generator;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Notifications\GeneralNotification;
use Illuminate\Support\Facades\Notification;

class PageController extends Controller
{
    public function index()
    {
        $user = auth()->guard('web')->user();
        return view('frontend.home', [
            'user'=>$user
        ]);
    }

    public function profile()
    {
        return view('frontend.profile');
    }

    public function changePassword()
    {
        return view('frontend.change_password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password'=>['required'],
            'new_password'=>['required',Password::min(8)->mixedCase()->numbers()->symbols()]
        ], [
            'old_password.required'=>'Please fill your old password.',
            'new_password.required'=>'Please fill your new Password.'
        ]);
        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $user = auth()->guard('web')->user();
        if (Hash::check($old_password, $user->password)) {
            $user->password = $new_password;
            $user->update();
            $title = 'Change Password';
            $message = 'Your account password is successfully changed.';
            $sourceable_id = $user->id;
            $sourceable_type = User::class;
            $web_link = "/profile";
            Notification::send($user, new GeneralNotification($title, $message, $sourceable_id, $sourceable_type, $web_link));
            
            return redirect()->route('profile')->with('success', 'Successfully updated your password.');
        }
        return back()->withErrors(['old_password'=>'Your old password is not correct'])->withInput();
    }

    public function wallet()
    {
        $user = auth()->guard('web')->user();
        return view('frontend.wallet', [
            'user'=>$user
        ]);
    }

    public function transfer()
    {
        return view('frontend.transfer');
    }

    public function verifyReceiver(Request $request)
    {
        $phone = $request->phone;
        $authUser = auth()->guard('web')->user();
        if ($authUser->phone != $phone) {
            $receiver = User::firstWhere('phone', $phone);
            if ($receiver) {
                return response()->json([
                    'status'=>'success',
                    'message'=>'success',
                    'data'=>$receiver
                ]);
            }
            return response()->json([
                'status'=>'fail',
                'message'=>'Invalid User'
            ]);
        }
        return response()->json([
            'status'=>'fail',
            'message'=>'Invalid User'
        ]);
    }
    
    public function transferConfirm(Request $request)
    {
        $request->validate([
            'receiver'=>['required'],
            'amount'=>['required']
        ]);

        $authUser = auth()->guard('web')->user();
        $receiver = User::firstWhere('phone', $request->receiver);
        $description = $request->description;
        $amount = $request->amount;

        if (!$receiver) {
            return back()->withErrors(['receiver'=>"You don't have an account with this phone number."])->withInput();
        }

        if ($authUser->phone === $receiver->phone) {
            return back()->withErrors(['receiver'=>"Your phone number is invalid."])->withInput();
        }

        if ($amount < 1000) {
            return back()->withErrors(['amount'=>'Your amount must be at least 1000 Kyats.'])->withInput();
        }

        if ($amount > $authUser->wallet->amount) {
            return back()->withErrors(['amount'=>"You don't have enough amount."])->withInput();
        }

        return view('frontend.transfer_confirm', [
            'authUser'=>$authUser,
            'receiver'=>$receiver,
            'description'=>$description,
            'amount'=>$amount
        ]);
    }

    public function transferComplete(Request $request)
    {
        $amount = $request->amount;
        $description = $request->description;
        $receiver = User::firstWhere('phone', $request->receiver);
        $sender = User::firstWhere('phone', $request->sender);
        
        DB::beginTransaction();
        try {
            $sender_wallet = $sender->wallet;
            $sender_wallet->decrement('amount', $amount);
            $sender_wallet->update();
            
            $receiver_wallet = $receiver->wallet;
            $receiver_wallet->increment('amount', $amount);
            $receiver_wallet->update();

            $ref_number = Generator::ref_number();

            $sender_transaction = new Transaction();
            $sender_transaction->trx_id = Generator::trx_id();
            $sender_transaction->ref_no = $ref_number;
            $sender_transaction->user_id = $sender->id;
            $sender_transaction->source_id = $receiver->id;
            $sender_transaction->amount = $amount;
            $sender_transaction->type = 2;
            $sender_transaction->description = $description;
            $sender_transaction->save();

            $receiver_transaction = new Transaction();
            $receiver_transaction->trx_id = Generator::trx_id();
            $receiver_transaction->ref_no = $ref_number;
            $receiver_transaction->user_id = $receiver->id;
            $receiver_transaction->source_id = $sender->id;
            $receiver_transaction->amount = $amount;
            $receiver_transaction->type = 1;
            $receiver_transaction->description = $description;
            $receiver_transaction->save();
            

            $title = 'E-money Transfered';
            $message = 'Your e-money transfered '. number_format($amount, 2) . " Kyats to ". $receiver->phone . "." ;
            $sourceable_id = $sender->id;
            $sourceable_type = Transaction::class;
            $web_link = "/transaction/".$sender_transaction->trx_id;
            Notification::send($sender, new GeneralNotification($title, $message, $sourceable_id, $sourceable_type, $web_link));
            
            $title = 'E-money Received';
            $message = 'Your e-money received '. number_format($amount, 2) . " Kyats from ". $sender->phone . "." ;
            $sourceable_id = $receiver->id;
            $sourceable_type = Transaction::class;
            $web_link = "/transaction/".$receiver_transaction->trx_id;
            Notification::send($receiver, new GeneralNotification($title, $message, $sourceable_id, $sourceable_type, $web_link));

            DB::commit();
            return redirect("/transaction/".$sender_transaction->trx_id)->with('success', 'Successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function passwordCheck(Request $request)
    {
        $password = $request->password;
        $authUser = auth()->guard('web')->user();
        if (!$password) {
            return response()->json([
                'status'=>'fail',
                'message'=>'Please fill your password.'
            ]);
        }

        if (! Hash::check($password, $authUser->password)) {
            return response()->json([
                'status'=>'fail',
                'message'=>'Your password is not correct.'
            ]);
        }

        return response()->json([
            'status'=>'success',
            'message'=>'Success'
        ]);
    }

    public function scanAndPay()
    {
        return view('frontend.scanAndPay');
    }

    public function scanAndPayForm(Request $request)
    {
        $phone = $request->phone;
        $authUser = auth()->guard('web')->user();
        if ($authUser->phone == $phone) {
            return back()->withErrors(['error'=>'Invalid QR'])->withInput();
        }
        $receiver = User::firstWhere('phone', $phone);
        if (!$receiver) {
            return back()->withErrors(['error'=>'Invalid QR'])->withInput();
        }

        return view('frontend.scanAndPayForm', [
            'receiver'=>$receiver
        ]);
    }
    
    public function myReceiveQr()
    {
        $authUser = auth()->guard('web')->user();
        return view('frontend.myReceiveQr', [
            'authUser'=>$authUser
        ]);
    }

    public function transaction()
    {
        $authUser = auth()->guard('web')->user();
        $transactions = Transaction::with('user', 'source')->where('user_id', $authUser->id)->orderBy('id', 'desc');
        if (request()->type) {
            $transactions = $transactions->where('type', request()->type);
        }

        if (request()->date) {
            $transactions = $transactions->whereDate('created_at', request()->date);
        }

        $transactions = $transactions->paginate(6);
        return view('frontend.transaction', [
            'transactions'=>$transactions
        ]);
    }

    public function transactionDetail($trx_id)
    {
        $transaction = Transaction::where('trx_id', $trx_id)->where('user_id', auth()->guard('web')->id())->first();
        return view('frontend.transactionDetail', [
            'transaction'=>$transaction
        ]);
    }
}
