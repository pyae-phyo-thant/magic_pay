<?php

namespace App\Http\Controllers\Backend;

use App\AdminUser;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateAdminUser;
use Carbon\Carbon;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.admin_user.index');
    }

    public function ssd()
    {
        $data = AdminUser::query();

        return Datatables::of($data)
            ->editColumn('user_agent', function($each){
                if ($each->user_agent) {
                    $agent = new Agent();
                    $agent->setUserAgent($each->user_agent);
                    $device = $agent->device();
                    $platform = $agent->platform();
                    $browser = $agent->browser();

                    return '<table class="table table-bordered">
                        <tbody>
                            <tr><td>Device</td><td>'.$device.'</td></tr>
                            <tr><td>Platform</td><td>'.$platform.'</td></tr>
                            <tr><td>Browser</td><td>'.$browser.'</td></tr>
                        </tbody>
                    </table>';
                }

                return '-';
                
            })
            ->editColumn('created_at', function($each){
                return Carbon::parse($each->created_at)->format('Y-m-d');
            })
            ->editColumn('updated_at', function($each){
                return Carbon::parse($each->updated_at)->format('Y-m-d');
            })
            ->addColumn('action', function($each){
                $edit_icon = '<a href="'. route('admin.admin-user.edit' , $each->id) .'" class="text-warning"><i class="fas fa-edit"></i></a>';
                $delete_icon = '<a href="#" class="text-danger delete" data-id="'. $each->id .'"><i class="fas fa-trash"></i></a>';

                return $edit_icon . '  ' . $delete_icon;
            })
            ->rawColumns(['user_agent', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin_user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:admin_users,email',
            'phone' => 'required|unique:admin_users,phone',
            'password' => 'required|min:8',
        ]);
        $data = new AdminUser();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->password = Hash::make($request->password);

        $data->save();
        return redirect()->route('admin.admin-user.index')->with('create', 'Successfuly Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin_user = AdminUser::findOrFail($id);

        return view('backend.admin_user.edit', compact('admin_user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminUser $request, $id)
    {
        $data = AdminUser::findOrFail($id);
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->password = $request->password ? Hash::make($request->password) : $data->password;

        $data->update();
        return redirect()->route('admin.admin-user.index')->with('update', 'Successfuly Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin_user = AdminUser::findOrFail($id);
        $admin_user->delete();

        return redirect()->back();
    }
}
