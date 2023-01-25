<?php

namespace App\Http\Controllers\Backend;

use datatables;
use App\Models\User;
use App\Models\Wallet;
use App\Helpers\Generator;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Http\Requests\storeUser;
use App\Http\Requests\updateUser;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('backend.user.index');
    }

    public function ssd()
    {
        $data = User::query();
        return datatables()->of($data)
        ->editColumn('user_agent', function ($each) {
            if ($each->user_agent) {
                $agent = new Agent();
                $agent->setUserAgent($each->user_agent);
                $device = $agent->device();
                $platform = $agent->platform();
                $browser = $agent->browser();
                return '<table class="table table-bordered">
                            <tr class="bg-light text-center">
                                <th>Device</th>
                                <th>PlatForm</th>
                                <th>Browser</th>
                            </tr>
                            <tr class="text-center">
                                <td>'. $device .'</td>
                                <td> ' .$platform .'</td>
                                <td> ' .$browser .'</td>
                            </tr>
                        </table>'
                ;
            }
            return "-";
        })
        ->addColumn('action', function ($each) {
            $edit_icon = '<a class="btn btn-warning mr-2 my-2" href="'.route('admin.user.edit', $each->id).'">Edit</a>';
            $delete_icon = '<a class="btn btn-danger my-2" href="#" id="delete_btn" data-id="'.$each->id.'">Delete</a>';
            return '<div class="icon-box">' . $edit_icon . $delete_icon . '</div>';
        })
        ->rawColumns(['user_agent','action'])
        ->toJson();
    }

    
    public function create()
    {
        return view('backend.user.create');
    }

    public function store(storeUser $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $user = User::create($validated);
        
            Wallet::firstOrCreate(
                [
                    'user_id' => $user->id
                ],
                [
                    'account_number' => Generator::account_number(),
                    'amount'=>1000
                ]
            );
            DB::commit();
            return redirect()->route('admin.user.index')->with('success', 'Successfully created');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function edit(User $user)
    {
        return view('backend.user.edit', [
            'user'=>$user
        ]);
    }


    public function update(updateUser $request, User $user)
    {
        $validated = $request->validated();
        $user->update($validated);
        return redirect()->route('admin.user.index')->with('success', 'Successfully Updated');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return "success";
    }
}
