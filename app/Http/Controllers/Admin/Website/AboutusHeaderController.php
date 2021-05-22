<?php

namespace App\Http\Controllers\Admin\website;

use App\Http\Controllers\Controller;
use App\Models\AboutusHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\This;

class AboutusHeaderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $aboutusHeaders=AboutusHeader::get();
        return view('admin.website.aboutusheader.index',compact(['aboutusHeaders']));
    }

    public function create(){
        return view('admin.website.aboutusheader.create');
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
                $imagename = 'header.jpg';
            }
            DB::beginTransaction();
            AboutusHeader::create([
                'head'=>$request->head,
                'paragraph'=>$request->paragraph,
                'status'=>'1',
                'image'=>$imagename,
            ]);
            if (isset($request->image)){
                $request->image->move(base_path().'/public/images/aboutus/',$imagename);
            }
            DB::commit();
            return redirect()->route('admin.aboutusheader.index')->with(['success' => 'The Header Added Successfully', 'bg' => 'bg-green', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('admin.aboutusheader.index')->with(['success' => 'The Header Not Added Please Try Again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
        }
    }


    public function edit($id){

        $header=AboutusHeader::find($id);
        if (!$header){
            return redirect()->route('admin.aboutusheader.index')->with(['success' => 'The Header Not Found', 'bg' => 'bg-cyan', 'fa' => 'fa-check', 'color' => 'whitesmoke']);

        }
        else{
            return view('admin.website.aboutusheader.edit',compact(['header']));
        }
    }

    public function update(Request $request)
    {


        $header = AboutusHeader::find($request->id);
        if (!$header) {
            return redirect()->route('admin.aboutusheader.index')->with(['success' => 'The Header Not Found', 'bg' => 'bg-cyan', 'fa' => 'fa-check', 'color' => 'whitesmoke']);

        } else {
            try {
                $validator=Validator::make($request->only('head','paragraph','image'),$this->rules(),$this->messages());
                if ($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors());
                }

                $oldimage=$header->image;
                if (isset($request->image)) {
                    $imagename = $request->id . time() . $request->image->hashName();
                } else {
                    $imagename = $header->image;
                }
                DB::beginTransaction();
                $header->update([
                    'head' => $request->head,
                    'paragraph' => $request->paragraph,
                    'image' => $imagename,
                ]);
                if (isset($request->image)) {
                    $request->image->move(base_path().DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'aboutus'.DIRECTORY_SEPARATOR, $imagename);
                    try {
                        if (!($oldimage=='header.jpg'))
                            unlink(base_path() .DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'aboutus'.DIRECTORY_SEPARATOR. $oldimage);
                    }catch (\Exception $e){}
                }
                DB::commit();
                return redirect()->route('admin.aboutusheader.index')->with(['success' => 'The Header Updated Successfully', 'bg' => 'bg-green', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
            } catch (\Exception $e) {

                DB::rollBack();
                return redirect()->route('admin.aboutusheader.index')->with(['success' => 'The Header Not Updated Please Try Again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
            }
        }
    }




    public function delete(Request $request)
    {
        $id=$request->id;
        $header = AboutusHeader::find($id);
        if (!$header) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'Header Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke'
            ]);
        }
        try {
            $oldimage=$header->image;
            $header->delete();
            try {
                if (!$oldimage=='header.jpg')
                unlink(base_path('public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'aboutus' . DIRECTORY_SEPARATOR . $oldimage));
            }catch (\Exception $e){}
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'The Header Deleted Successfully',
                'bg' => 'bg-red',
                'color' => 'whitesmoke',
                'deleted'=>true
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'The Header Not Deleted Please Try Again',
                'bg' => 'bg-dark',
                'color' => 'whitesmoke'
            ]);
        }
    }


    public function changeStatus(Request $request){

        $id=$request->id;
        $header=AboutusHeader::find($id);
        if (!$header) {
            return response()->json([
                'show'=>true,
                'message' => 'Header Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke',
            ]);        }
        try {
            if($header->status==0){$header->update(['status'=>1]);
                return response()->json([
                    'show'=>true,
                    'message' => 'The Header Activated Successfully',
                    'bg' => 'bg-green',
                    'fa' => 'fa-check',
                    'color' => 'whitesmoke',
                    'action'=>'Deactivate',
                    'btn'=>'danger',
                    'id'=>$request->id,
                    'status'=>'Active',
                    'statuscolor'=>'green'
                ]);} elseif ($header->status==1){$header->update(['status'=>0]);
                return response()->json([
                    'show'=>true,
                    'message' => 'The Header Deactivated Successfully',
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
                'message' => 'The Header Status Not Changed Please Try Again',
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
