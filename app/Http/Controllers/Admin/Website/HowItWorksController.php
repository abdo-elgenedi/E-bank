<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Models\Header;
use App\Models\HowItWorksCard;
use App\Models\HowItWorksHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HowItWorksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){

        $works=HowItWorksCard::all();
        return view('admin.website.howitworks.index',compact('works'));
    }


    public function create(){
        return view('admin.website.howitworks.create');
    }

    public function store(Request $request){

        try{
            $validator=Validator::make($request->only('head','paragraph','status','image'),$this->rules(),$this->messages());
            if ($validator->fails()){
                return redirect()->back()->withErrors($validator->errors())->withInput();
            }
            if (isset($request->image)) {
                $imagename = $request->id .time().$request->image->hashName();
            }else{
                $imagename = 'howitworks.jpg';
            }
            DB::beginTransaction();
            HowItWorksCard::create([
                'head'=>$request->head,
                'paragraph'=>$request->paragraph,
                'status'=>'1',
                'image'=>$imagename,
            ]);
            DB::commit();
            return redirect()->route('admin.howitworks.index')->with(['success' => 'The Card Added Successfully', 'bg' => 'bg-green', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('admin.howitworks.index')->with(['success' => 'The Card Not Added Please Try Again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
        }
    }


    public function edit($id){

        $works=HowItWorksCard::find($id);
        if (!$works){
            return redirect()->route('admin.howitworks.index')->with(['success' => 'The Card Not Found', 'bg' => 'bg-cyan', 'fa' => 'fa-check', 'color' => 'whitesmoke']);

        }
        else{
            return view('admin.website.howitworks.edit',compact(['works']));
        }
    }

    public function update(Request $request)
    {

        $works = HowItWorksCard::find($request->id);
        if (!$works) {
            return redirect()->route('admin.howitworks.index')->with(['success' => 'The Card Not Found', 'bg' => 'bg-cyan', 'fa' => 'fa-check', 'color' => 'whitesmoke']);

        } else {
            try {
                $validator=Validator::make($request->only('head','paragraph','image'),$this->rules(),$this->messages());
                if ($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors());
                }
                $oldimage=$works->image;
                if (isset($request->image)) {
                    $imagename = $request->id . time() . $request->image->hashName();
                } else {
                    $imagename = $works->image;
                }
                DB::beginTransaction();
                $works->update([
                    'head' => $request->head,
                    'paragraph' => $request->paragraph,
                    'image' => $imagename,
                ]);
                if (isset($request->image)) {
                    $request->image->move(base_path().DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'howitworks'.DIRECTORY_SEPARATOR, $imagename);
                    try {
                        if (!$oldimage=='howitworks.jpg')
                            unlink(base_path() .DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'howitworks'.DIRECTORY_SEPARATOR. $oldimage);
                    }catch (\Exception $e){}
                }
                DB::commit();
                return redirect()->route('admin.howitworks.index')->with(['success' => 'The Card Updated Successfully', 'bg' => 'bg-green', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
            } catch (\Exception $e) {

                DB::rollBack();
                return redirect()->route('admin.howitworks.index')->with(['success' => 'The card Not Updated Please Try Again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
            }
        }
    }




    public function delete(Request $request)
    {
        $id=$request->id;
        $works = HowItWorksCard::find($id);
        if (!$works) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'Card Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke'
            ]);
        }
        try {
            $oldimage=$works->image;
            $works->delete();
            try {
                if (!$oldimage=='howitworks.jpg')
                    unlink(base_path('public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'howitworks' . DIRECTORY_SEPARATOR . $oldimage));
            }catch (\Exception $e){}
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'The Card Deleted Successfully',
                'bg' => 'bg-red',
                'color' => 'whitesmoke',
                'deleted'=>true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'The Card Not Deleted Please Try Again',
                'bg' => 'bg-dark',
                'color' => 'whitesmoke'
            ]);
        }
    }


    public function changeStatus(Request $request){

        $id=$request->id;
        $works=HowItWorksCard::find($id);
        if (!$works) {
            return response()->json([
                'show'=>true,
                'message' => 'Card Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke',
            ]);        }
        try {
            if($works->status==0){$works->update(['status'=>1]);
                return response()->json([
                    'show'=>true,
                    'message' => 'The Card Activated Successfully',
                    'bg' => 'bg-green',
                    'fa' => 'fa-check',
                    'color' => 'whitesmoke',
                    'action'=>'Deactivate',
                    'btn'=>'danger',
                    'id'=>$request->id,
                    'status'=>'Active',
                    'statuscolor'=>'green'
                ]);} elseif ($works->status==1){$works->update(['status'=>0]);
                return response()->json([
                    'show'=>true,
                    'message' => 'The Card Deactivated Successfully',
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
                'message' => 'The Card Status Not Changed Please Try Again',
                'bg' => 'bg-dark',
                'color' => 'whitesmoke',
            ]);
        }
    }




    public function rules(){
        return[
            'head'=>['required','max:20','string'],
            'paragraph'=>['required','max:255'.'string'],
            'image'=>['image'],
            'status'=>['in:0,1']
        ];
    }

    public function messages(){
        return[
            'required'=>'this field is required',
            'string'=>'this field must be string',
            'head.max'=>'the head must be less than 20',
            'paragraph.max'=>'the paragraph must be less than 255',
            'image'=>'this filed must be an image',
            'in'=>'the status must be only 0 or 1'
        ];
    }

}
