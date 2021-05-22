<?php

namespace App\Http\Controllers\Admin\website;

use App\Http\Controllers\Controller;
use App\Models\AboutusHeader;
use App\Models\AboutusShortcut;
use App\Models\OurServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OurServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $services=OurServices::get();
        return view('admin.website.ourservices.index',compact(['services']));
    }

    public function create(){
        return view('admin.website.ourservices.create');
    }

    public function store(Request $request){

        try{
            $validator=Validator::make($request->only('head','paragraph','status','image'),$this->rules(),$this->messages());
            if ($validator->fails()){
                return redirect()->back()->withErrors($validator->errors());
            }
            if (isset($request->image)) {
                $imagename = $request->id .time().$request->image->hashName();
            }else{
                $imagename = 'services.jpg';
            }
            DB::beginTransaction();
            OurServices::create([
                'head'=>$request->head,
                'paragraph'=>$request->paragraph,
                'status'=>'1',
                'image'=>$imagename,
            ]);
            if (isset($request->image)){
                $request->image->move(base_path().'/public/images/ourservices/',$imagename);
            }
            DB::commit();
            return redirect()->route('admin.ourservices.index')->with(['success' => 'The Services Added Successfully', 'bg' => 'bg-green', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('admin.ourservices.index')->with(['success' => 'The Services Not Added Please Try Again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
        }
    }


    public function edit($id){

        $services=OurServices::find($id);
        if (!$services){
            return redirect()->route('admin.ourservices.index')->with(['success' => 'The Services Not Found', 'bg' => 'bg-cyan', 'fa' => 'fa-check', 'color' => 'whitesmoke']);

        }
        else{
            return view('admin.website.ourservices.edit',compact(['services']));
        }
    }

    public function update(Request $request)
    {

        $services = OurServices::find($request->id);
        if (!$services) {
            return redirect()->route('admin.ourservices.index')->with(['success' => 'The Services Not Found', 'bg' => 'bg-cyan', 'fa' => 'fa-check', 'color' => 'whitesmoke']);

        } else {
            try {
                $validator=Validator::make($request->only('head','paragraph','image'),$this->rules(),$this->messages());
                if ($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors())->withInput();
                }
                $oldimage=$services->image;
                if (isset($request->image)) {
                    $imagename = $request->id . time() . $request->image->hashName();
                } else {
                    $imagename = $services->image;
                }
                DB::beginTransaction();
                $services->update([
                    'head' => $request->head,
                    'paragraph' => $request->paragraph,
                    'image' => $imagename,
                ]);
                if (isset($request->image)) {
                    $request->image->move(base_path().DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'ourservices'.DIRECTORY_SEPARATOR, $imagename);
                    try {
                        if (!$oldimage=='ourservices.jpg')
                            unlink(base_path() .DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'ourservices'.DIRECTORY_SEPARATOR. $oldimage);
                    }catch (\Exception $e){}
                }
                DB::commit();
                return redirect()->route('admin.ourservices.index')->with(['success' => 'The Services Updated Successfully', 'bg' => 'bg-green', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
            } catch (\Exception $e) {

                DB::rollBack();
                return redirect()->route('admin.ourservices.index')->with(['success' => 'The Services Not Updated Please Try Again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
            }
        }
    }




    public function delete(Request $request)
    {
        $id=$request->id;
        $services = OurServices::find($id);
        if (!$services) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'Services Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke'
            ]);
        }
        try {
            $oldimage=$services->image;
            $services->delete();
            try {
                if (!$oldimage=='ourservices.jpg')
                unlink(base_path('public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'ourservices' . DIRECTORY_SEPARATOR . $oldimage));
            }catch (\Exception $e){}
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'The Services Deleted Successfully',
                'bg' => 'bg-red',
                'color' => 'whitesmoke',
                'deleted'=>true
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'The Services Not Deleted Please Try Again',
                'bg' => 'bg-dark',
                'color' => 'whitesmoke'
            ]);
        }
    }


    public function changeStatus(Request $request){

        $id=$request->id;
        $services=OurServices::find($id);
        if (!$services) {
            return response()->json([
                'show'=>true,
                'message' => 'Shortcut Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke',
            ]);        }
        try {
            if($services->status==0){$services->update(['status'=>1]);
                return response()->json([
                    'show'=>true,
                    'message' => 'The Services Activated Successfully',
                    'bg' => 'bg-green',
                    'fa' => 'fa-check',
                    'color' => 'whitesmoke',
                    'action'=>'Deactivate',
                    'btn'=>'danger',
                    'id'=>$request->id,
                    'status'=>'Active',
                    'statuscolor'=>'green'
                ]);} elseif ($services->status==1){$services->update(['status'=>0]);
                return response()->json([
                    'show'=>true,
                    'message' => 'The Services Deactivated Successfully',
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
                'message' => 'The services Status Not Changed Please Try Again',
                'bg' => 'bg-dark',
                'color' => 'whitesmoke',
            ]);
        }
    }



    public function rules(){
        return[
            'head'=>['required','max:50','string'],
            'paragraph'=>['required','max:512'.'string'],
            'image'=>['image'],
            'status'=>['in:0,1']
        ];
    }

    public function messages(){
        return[
            'required'=>'this field is required',
            'string'=>'this field must be string',
            'head.max'=>'the head must be less than 50',
            'paragraph.max'=>'the paragraph must be less than 512',
            'image'=>'this filed must be an image',
            'in'=>'the status must be only 0 or 1'
        ];
    }
}
