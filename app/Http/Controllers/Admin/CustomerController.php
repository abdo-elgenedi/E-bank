<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $customers=User::get();
        return view('admin.customers.index',compact(['customers']));
    }


    public function delete(Request $request)
    {
        $id=$request->id;
        $customer = User::find($id);
        if (!$customer) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'Customer Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke'
            ]);
        }
        try {
            if($customer->balance>0){
                return response()->json([
                    'show'=>true,
                    'id'=>$request->id,
                    'message' => 'Customer '.$customer->name.' has balance and you can not remove it',
                    'bg' => 'bg-cyan',
                    'color' => 'whitesmoke'
                ]);
            }
            try {
                unlink(base_path('public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'customers' . DIRECTORY_SEPARATOR . $customer->image));
            }catch (\Exception $e){}
            $customer->delete();
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'The Customer Deleted Successfully',
                'bg' => 'bg-red',
                'color' => 'whitesmoke',
                'deleted'=>true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'The Customer Not Deleted Please Try Again',
                'bg' => 'bg-dark',
                'color' => 'whitesmoke'
            ]);
        }
    }


    public function changeStatus(Request $request){

        $id=$request->id;
        $customer=User::find($id);
        if (!$customer) {
            return response()->json([
                'show'=>true,
                'message' => 'Customer Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke',
            ]);        }
        try {
            if($customer->status==0){$customer->update(['status'=>1]);
                return response()->json([
                    'show'=>true,
                    'message' => 'The Customer Activated Successfully',
                    'bg' => 'bg-green',
                    'fa' => 'fa-check',
                    'color' => 'whitesmoke',
                    'action'=>'Deactivate',
                    'btn'=>'danger',
                    'id'=>$request->id,
                    'status'=>'Active',
                    'statuscolor'=>'green'
                ]);} elseif ($customer->status==1){$customer->update(['status'=>0]);
                return response()->json([
                    'show'=>true,
                    'message' => 'The Customer Deactivated Successfully',
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
                'message' => 'The Customer Status Not Changed Please Try Again',
                'bg' => 'bg-dark',
                'color' => 'whitesmoke',
            ]);
        }
    }


    public function details(Request $request){

        $id=$request->id;
        $customer=User::find($id);
        if (!$customer) {
            return response()->json([
                'show'=>true,
                'message' => 'Customer Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke',
            ]);
        }else{
            return response()->json([
                'show'=>true,
                'cardname' => $customer->name,
                'cardusername' => $customer->username,
                'cardemail' => $customer->email,
                'cardmobile' => $customer->mobile,
                'cardage' => $customer->age,
                'cardbalance' => $customer->balance.' $',
                'cardstatus' => $this->detrmineStatus($customer->status),
                'cardstatuscolor' => $this->detrmineStatusColor($customer->status),
                'cardcreatedat' => $customer->created_at->toFormattedDateString(),
                'cardcreatedfrom' => $customer->created_at->diffForHumans(),
                'cardlogo' => $customer->image

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
