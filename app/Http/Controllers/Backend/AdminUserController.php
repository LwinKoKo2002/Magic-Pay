<?php

namespace App\Http\Controllers\Backend;

use datatables;
use App\Models\AdminUser;
use Jenssegers\Agent\Agent;
use App\Http\Controllers\Controller;
use App\Http\Requests\storeAdminUser;
use App\Http\Requests\updateAdminUser;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('backend.admin.index');
    }

    public function ssd()
    {
        $data = AdminUser::query();
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
            $edit_icon = '<a class="btn btn-warning mr-2 my-2" href="'.route('admin.admin-user.edit', $each->id).'">Edit</a>';
            $delete_icon = '<a class="btn btn-danger my-2" href="#" id="delete_btn" data-id="'.$each->id.'">Delete</a>';
            return '<div class="icon-box">' . $edit_icon . $delete_icon . '</div>';
        })
        ->rawColumns(['user_agent','action'])
        ->toJson();
    }

    public function create()
    {
        return view('backend.admin.create');
    }

  
    public function store(storeAdminUser $request)
    {
        $validated = $request->validated();
        AdminUser::create($validated);
        return redirect()->route('admin.admin-user.index')->with('success', 'Successfully created');
    }


    public function edit(AdminUser $admin_user)
    {
        return view('backend.admin.edit', [
            'admin_user'=>$admin_user
        ]);
    }

    public function update(updateAdminUser $request, AdminUser $admin_user)
    {
        $validated = $request->validated();
        $admin_user->update($validated);
        return redirect()->route('admin.admin-user.index')->with('success', 'Successfully updated.');
    }

    public function destroy(AdminUser $admin_user)
    {
        $admin_user->delete();
        return "success";
    }
}
