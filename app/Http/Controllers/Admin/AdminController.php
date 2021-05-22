<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');

    }

    public function index(){
        if (Auth::check()&&!Auth::user()->super_admin==1){
            return redirect()->route('admin.index');
        }
        $admins=Admin::where('super_admin','=',0)->get();
        return view('admin.admins.index',compact(['admins']));
    }

    public function create(){
        if (Auth::check()&&!Auth::user()->super_admin==1){
            return redirect()->route('admin.index');
        }
        return view('admin.admins.create');
    }

    public function store(AdminRequest $request){

        if (Auth::check()&&!Auth::user()->super_admin==1){
            return redirect()->route('admin.index');
        }
        try{
            DB::beginTransaction();
            Admin::create([
                'id'=>$request->id,
                'name'=>$request->name,
                'username'=>$request->username,
                'mobile'=>$request->mobile,
                'email'=>$request->email,
                'super_admin'=>0,
                'status'=>1,
                'password'=> Hash::make('12345678'),
                'image'=>'admin.jpg',
            ]);
            DB::commit();
            return redirect()->route('admin.admins.index')->with(['success' => 'The Admin Added Successfully', 'bg' => 'bg-green', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('admin.admins.index')->with(['success' => 'Admin Not Added Please Try Again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
        }
    }


    public function delete(Request $request)
    {
        if (Auth::check()&&!Auth::user()->super_admin==1){
            return redirect()->route('admin.index');
        }
        $id=$request->id;
        $admin = Admin::find($id);
        if (!$admin) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'Admin Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke'
            ]);
        }
        if ($admin->super_admin==1) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'You Can not delete the super admin',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke'
            ]);
        }
        try {
            try {
                unlink(base_path('public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'banks' . DIRECTORY_SEPARATOR . $admin->image));
            }catch (\Exception $e){}
            $admin->delete();
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'The Admin Deleted Successfully',
                'bg' => 'bg-red',
                'color' => 'whitesmoke',
                'deleted'=>true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'The Admin Not Deleted Please Try Again',
                'bg' => 'bg-dark',
                'color' => 'whitesmoke'
            ]);
        }
    }


    public function changeStatus(Request $request){
        if (Auth::check()&&!Auth::user()->super_admin==1){
            return redirect()->route('admin.index');
        }

        $id=$request->id;
        $admin=Admin::find($id);
        if (!$admin) {
            return response()->json([
                'show'=>true,
                'message' => 'Admin Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke',
            ]);
        }
        if ($admin->super_admin==1) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'You Can not Deactivate the super admin',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke'
            ]);
        }
        try {
            if($admin->status==0){$admin->update(['status'=>1]);
                return response()->json([
                    'show'=>true,
                    'message' => 'The Admin Activated Successfully',
                    'bg' => 'bg-green',
                    'fa' => 'fa-check',
                    'color' => 'whitesmoke',
                    'action'=>'Deactivate',
                    'btn'=>'danger',
                    'id'=>$request->id,
                    'status'=>'Active',
                    'statuscolor'=>'green'
                ]);} elseif ($admin->status==1){$admin->update(['status'=>0]);
                return response()->json([
                    'show'=>true,
                    'message' => 'The Admin Deactivated Successfully',
                    'bg' => 'bg-red',
                    'fa' => 'fa-check',
                    'color' => 'whitesmoke',
                    'action'=>'Activate',
                    'btn'=>'primary',
                    'id'=>$request->id,
                    'status'=>'Not Active',
                    'statuscolor'=>'red'
                ]);}
        } catch (\Exception $e) {
            return response()->json([
                'show'=>true,
                'message' => 'The Admin Status Not Changed Please Try Again',
                'bg' => 'bg-dark',
                'color' => 'whitesmoke',
            ]);
        }
    }

    public function details(Request $request){

        if (Auth::check()&&!Auth::user()->super_admin==1){
            return redirect()->route('admin.index');
        }
        $id=$request->id;
        $admin=Admin::find($id);
        if (!$admin) {
            return response()->json([
                'show'=>true,
                'message' => 'Admin Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke',
            ]);
        }else{
            return response()->json([
                'show'=>true,
                'cardname' => $admin->name,
                'cardusername' => $admin->username,
                'cardemail' => $admin->email,
                'cardmobile' => $admin->mobile,
                'cardstatus' => $this->detrmineStatus($admin->status),
                'cardstatuscolor' => $this->detrmineStatusColor($admin->status),
                'cardlogo' => $admin->image

            ]);
        }
    }

    private function detrmineStatus($status){
        if($status==0){return 'Blocked';}
        elseif($status==1){return 'Active';}
    }
    private function detrmineStatusColor($status){
        if($status==0){return 'red';}
        elseif($status==1){return 'lightgreen';}
    }
}
