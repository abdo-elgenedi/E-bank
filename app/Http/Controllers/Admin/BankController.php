<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BankRequest;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $banks=Bank::get();
        return view('admin.banks.index',compact(['banks']));
    }

    public function create(){
        return view('admin.banks.create');
    }

    public function store(BankRequest $request){

        try{
            if (isset($request->image)) {
                $imagename = $request->id .time().$request->image->hashName();
            }else{
                $imagename = 'bank.jpg';
            }
           DB::beginTransaction();
        Bank::create([
           'id'=>$request->id,
           'name'=>$request->name,
           'website'=>$request->website,
           'mobile'=>$request->mobile,
           'email'=>$request->email,
           'image'=>$imagename,
        ]);
            if (isset($request->image)){
            $request->image->move(base_path().'/public/images/banks/',$imagename);
            }
            DB::commit();
            return redirect()->route('admin.banks.index')->with(['success' => 'The Bank Added Successfully', 'bg' => 'bg-green', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
    }catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('admin.banks.index')->with(['success' => 'Bank Not Added Please Try Again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
        }
    }


    public function edit($id){

        $bank=Bank::find($id);
        if (!$bank){
            return redirect()->route('admin.banks.index')->with(['success' => 'The Bank Not Found', 'bg' => 'bg-cyan', 'fa' => 'fa-check', 'color' => 'whitesmoke']);

        }
        else{
            return view('admin.banks.edit',compact(['bank']));
        }
    }

    public function update(BankRequest $request)
    {

        $bank = Bank::find($request->id);
        if (!$bank) {
            return redirect()->route('admin.banks.index')->with(['success' => 'The Bank Not Found', 'bg' => 'bg-cyan', 'fa' => 'fa-check', 'color' => 'whitesmoke']);

        } else {
            try {
                $oldiamge=$bank->image;
                if (isset($request->image)) {
                    $imagename = $request->id . time() . $request->image->hashName();
                } else {
                    $imagename = $bank->image;
                }
                DB::beginTransaction();
                $bank->update([
                    'id' => $request->id,
                    'name' => $request->name,
                    'website' => $request->website,
                    'mobile' => $request->mobile,
                    'email' => $request->email,
                    'image' => $imagename,
                ]);
                if (isset($request->image)) {
                     $request->image->move(base_path().DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'banks'.DIRECTORY_SEPARATOR, $imagename);
                    try {
                        unlink(base_path() .DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'banks'.DIRECTORY_SEPARATOR. $oldiamge);
                    }catch (\Exception $e){}
                }
                DB::commit();
                return redirect()->route('admin.banks.index')->with(['success' => 'The Bank Updated Successfully', 'bg' => 'bg-green', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
            } catch (\Exception $e) {

                DB::rollBack();
                return $e;
                return redirect()->route('admin.banks.index')->with(['success' => 'Bank Not Updated Please Try Again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
            }
        }
    }




    public function delete(Request $request)
    {
        $id=$request->id;
        $bank = Bank::find($id);
        if (!$bank) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'Bank Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke'
            ]);
        }
        try {
                try {
                    unlink(base_path('public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'banks' . DIRECTORY_SEPARATOR . $bank->image));
                }catch (\Exception $e){}
            $bank->delete();
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'The Bank Deleted Successfully',
                'bg' => 'bg-red',
                'color' => 'whitesmoke',
                'deleted'=>true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'The Bank Not Deleted Please Try Again',
                'bg' => 'bg-dark',
                'color' => 'whitesmoke'
            ]);
        }
    }


    public function changeStatus(Request $request){

        $id=$request->id;
        $bank=Bank::find($id);
        if (!$bank) {
            return response()->json([
                'show'=>true,
                'message' => 'Bank Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke',
            ]);        }
        try {
            if($bank->status==0){$bank->update(['status'=>1]);
                return response()->json([
                    'show'=>true,
                    'message' => 'The Bank Activated Successfully',
                    'bg' => 'bg-green',
                    'fa' => 'fa-check',
                    'color' => 'whitesmoke',
                    'action'=>'Deactivate',
                    'btn'=>'danger',
                    'id'=>$request->id,
                    'status'=>'Active',
                    'statuscolor'=>'green'
                ]);} elseif ($bank->status==1||$bank->status==2){$bank->update(['status'=>0]);
                return response()->json([
                    'show'=>true,
                    'message' => 'The Bank Deactivated Successfully',
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
                'message' => 'The Bank Status Not Changed Please Try Again',
                'bg' => 'bg-dark',
                'color' => 'whitesmoke',
            ]);
        }
    }

    public function details(Request $request){

        $id=$request->id;
        $bank=Bank::find($id);
        if (!$bank) {
            return response()->json([
                'show'=>true,
                'message' => 'Bank Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke',
            ]);
        }else{
            return response()->json([
                'show'=>true,
                'cardname' => $bank->name,
                'cardid' => $bank->id,
                'cardemail' => $bank->email,
                'cardmobile' => $bank->mobile,
                'cardwebsite' => $bank->website,
                'cardstatus' => $this->detrmineStatus($bank->status),
                'cardstatuscolor' => $this->detrmineStatusColor($bank->status),
                'cardlogo' => $bank->image

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
