<?php

namespace App\Http\Controllers\Admin\website;

use App\Http\Controllers\Controller;
use App\Models\AboutusHeader;
use App\Models\AboutusShortcut;
use App\Models\ContactUsManage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactUsManageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $details=ContactUsManage::first();
        return view('admin.website.contactusmanage.index',compact(['details']));
    }

    public function edit(){

        $details=ContactUsManage::first();
        {
            return view('admin.website.contactusmanage.edit',compact(['details']));
        }
    }

    public function update(Request $request)
    {

        $details = ContactUsManage::first();

            try {
                DB::beginTransaction();
                $details->update([
                    'address' => $request->address,
                    'mobile' => $request->mobile,
                    'email' => $request->email,
                ]);
                DB::commit();
                return redirect()->route('admin.contactusmanage.index')->with(['success' => 'The Details Updated Successfully', 'bg' => 'bg-green', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
            } catch (\Exception $e) {

                DB::rollBack();
                return redirect()->route('admin.contactusmanage.index')->with(['success' => 'The Details Not Updated Please Try Again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
            }

    }

    public function changeStatus(Request $request){

        $details=ContactUsManage::first();
        try {
            if($details->form_status==0){$details->update(['form_status'=>1]);
                return response()->json([
                    'show'=>true,
                    'message' => 'The Details Activated Successfully',
                    'bg' => 'bg-green',
                    'fa' => 'fa-check',
                    'color' => 'whitesmoke',
                    'action'=>'Deactivate',
                    'btn'=>'danger',
                    'id'=>$request->id,
                    'status'=>'Active',
                    'statuscolor'=>'green'
                ]);} elseif ($details->form_status==1){$details->update(['form_status'=>0]);
                return response()->json([
                    'show'=>true,
                    'message' => 'The Details Deactivated Successfully',
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
                'message' => 'The Details Status Not Changed Please Try Again',
                'bg' => 'bg-dark',
                'color' => 'whitesmoke',
            ]);
        }
    }

}
