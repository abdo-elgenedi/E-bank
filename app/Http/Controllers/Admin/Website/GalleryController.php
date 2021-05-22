<?php

namespace App\Http\Controllers\Admin\website;

use App\Http\Controllers\Controller;
use App\Models\AboutusHeader;
use App\Models\AboutusShortcut;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $galleries=Gallery::get();
        return view('admin.website.gallery.index',compact(['galleries']));
    }

    public function create(){
        return view('admin.website.gallery.create');
    }

    public function store(Request $request){

        try{
            $validator=Validator::make($request->only('status','image'),$this->rules(),$this->messages());
            if ($validator->fails()){
                return redirect()->back()->withErrors($validator->errors());
            }
            if (isset($request->image)) {
                $imagename = $request->id .time().$request->image->hashName();
            }else{
                $imagename = 'image.jpg';
            }
            DB::beginTransaction();
            Gallery::create([
                'status'=>'1',
                'image'=>$imagename,
            ]);
            if (isset($request->image)){
                $request->image->move(base_path().'/public/images/gallery/',$imagename);
            }
            DB::commit();
            return redirect()->route('admin.gallery.index')->with(['success' => 'The Image Added Successfully', 'bg' => 'bg-green', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('admin.gallery.index')->with(['success' => 'The Image Not Added Please Try Again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
        }
    }


    public function edit($id){

        $gallery=Gallery::find($id);
        if (!$gallery){
            return redirect()->route('admin.gallery.index')->with(['success' => 'The Image Not Found', 'bg' => 'bg-cyan', 'fa' => 'fa-check', 'color' => 'whitesmoke']);

        }
        else{
            return view('admin.website.gallery.edit',compact(['gallery']));
        }
    }

    public function update(Request $request)
    {

        $gallery = Gallery::find($request->id);
        if (!$gallery) {
            return redirect()->route('admin.gallery.index')->with(['success' => 'The Image Not Found', 'bg' => 'bg-cyan', 'fa' => 'fa-check', 'color' => 'whitesmoke']);

        } else {
            try {
                $validator=Validator::make($request->only('image'),$this->rules(),$this->messages());
                if ($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors());
                }

                $oldiamge=$gallery->image;
                if (isset($request->image)) {
                    $imagename = $request->id . time() . $request->image->hashName();
                } else {
                    $imagename = $gallery->image;
                }
                DB::beginTransaction();
                $gallery->update([
                    'image' => $imagename,
                ]);
                if (isset($request->image)) {
                    $request->image->move(base_path().DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'gallery'.DIRECTORY_SEPARATOR, $imagename);
                    try {
                        unlink(base_path() .DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'gallery'.DIRECTORY_SEPARATOR. $oldiamge);
                    }catch (\Exception $e){}
                }
                DB::commit();
                return redirect()->route('admin.gallery.index')->with(['success' => 'The Image Updated Successfully', 'bg' => 'bg-green', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
            } catch (\Exception $e) {

                DB::rollBack();
                return redirect()->route('admin.aboutusshortcut.index')->with(['success' => 'The Image Not Updated Please Try Again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
            }
        }
    }




    public function delete(Request $request)
    {
        $id=$request->id;
        $gallery = Gallery::find($id);
        if (!$gallery) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'Gallery Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke'
            ]);
        }
        try {
            $oldimage=$gallery->image;
            $gallery->delete();
            try {
                unlink(base_path('public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'gallery' . DIRECTORY_SEPARATOR . $oldimage));
            }catch (\Exception $e){}
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'The Image Deleted Successfully',
                'bg' => 'bg-red',
                'color' => 'whitesmoke',
                'deleted'=>true
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'The Image Not Deleted Please Try Again',
                'bg' => 'bg-dark',
                'color' => 'whitesmoke'
            ]);
        }
    }


    public function changeStatus(Request $request){

        $id=$request->id;
        $gallery=Gallery::find($id);
        if (!$gallery) {
            return response()->json([
                'show'=>true,
                'message' => 'Image Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke',
            ]);        }
        try {
            if($gallery->status==0){$gallery->update(['status'=>1]);
                return response()->json([
                    'show'=>true,
                    'message' => 'The Image Activated Successfully',
                    'bg' => 'bg-green',
                    'fa' => 'fa-check',
                    'color' => 'whitesmoke',
                    'action'=>'Deactivate',
                    'btn'=>'danger',
                    'id'=>$request->id,
                    'status'=>'Active',
                    'statuscolor'=>'green'
                ]);} elseif ($gallery->status==1){$gallery->update(['status'=>0]);
                return response()->json([
                    'show'=>true,
                    'message' => 'The Image Deactivated Successfully',
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
                'message' => 'The Shortcut Status Not Changed Please Try Again',
                'bg' => 'bg-dark',
                'color' => 'whitesmoke',
            ]);
        }
    }




    public function rules(){
        return[
            'image'=>['required','image'],
            'status'=>['in:0,1']
        ];
    }

    public function messages(){
        return[
            'required'=>'this field is required',
            'image'=>'this filed must be an image',
            'in'=>'the status must be only 0 or 1'
        ];
    }

}
