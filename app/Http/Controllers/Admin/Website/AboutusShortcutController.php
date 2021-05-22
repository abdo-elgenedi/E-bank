<?php

namespace App\Http\Controllers\Admin\website;

use App\Http\Controllers\Controller;
use App\Models\AboutusHeader;
use App\Models\AboutusShortcut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AboutusShortcutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $aboutusShortcuts=AboutusShortcut::get();
        return view('admin.website.aboutusshortcut.index',compact(['aboutusShortcuts']));
    }

    public function create(){
        return view('admin.website.aboutusshortcut.create');
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
                $imagename = 'shortcut.jpg';
            }
            DB::beginTransaction();
            AboutusShortcut::create([
                'head'=>$request->head,
                'paragraph'=>$request->paragraph,
                'status'=>'1',
                'image'=>$imagename,
            ]);
            if (isset($request->image)){
                $request->image->move(base_path().'/public/images/aboutus/',$imagename);
            }
            DB::commit();
            return redirect()->route('admin.aboutusshortcut.index')->with(['success' => 'The Shortcut Added Successfully', 'bg' => 'bg-green', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('admin.aboutusshortcut.index')->with(['success' => 'The Shortcut Not Added Please Try Again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
        }
    }


    public function edit($id){

        $shortcut=AboutusShortcut::find($id);
        if (!$shortcut){
            return redirect()->route('admin.aboutusshortcut.index')->with(['success' => 'The Shortcut Not Found', 'bg' => 'bg-cyan', 'fa' => 'fa-check', 'color' => 'whitesmoke']);

        }
        else{
            return view('admin.website.aboutusshortcut.edit',compact(['shortcut']));
        }
    }

    public function update(Request $request)
    {



        $shortcut = AboutusShortcut::find($request->id);
        if (!$shortcut) {
            return redirect()->route('admin.aboutusshortcut.index')->with(['success' => 'The Shortcut Not Found', 'bg' => 'bg-cyan', 'fa' => 'fa-check', 'color' => 'whitesmoke']);

        } else {

            $validator=Validator::make($request->only('head','paragraph','image'),$this->rules(),$this->messages());
            if ($validator->fails()){
                return redirect()->back()->withErrors($validator->errors())->withInput();
            }
            try {
                $oldimage=$shortcut->image;
                if (isset($request->image)) {
                    $imagename = $request->id . time() . $request->image->hashName();
                } else {
                    $imagename = $shortcut->image;
                }
                DB::beginTransaction();
                $shortcut->update([
                    'head' => $request->head,
                    'paragraph' => $request->paragraph,
                    'image' => $imagename,
                ]);
                if (isset($request->image)) {
                    $request->image->move(base_path().DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'aboutus'.DIRECTORY_SEPARATOR, $imagename);
                    try {
                        if (!$oldimage=='header.jpg')
                        unlink(base_path() .DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'aboutus'.DIRECTORY_SEPARATOR. $oldimage);
                    }catch (\Exception $e){}
                }
                DB::commit();
                return redirect()->route('admin.aboutusshortcut.index')->with(['success' => 'The Shortcut Updated Successfully', 'bg' => 'bg-green', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
            } catch (\Exception $e) {

                DB::rollBack();
                return redirect()->route('admin.aboutusshortcut.index')->with(['success' => 'The Shortcut Not Updated Please Try Again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
            }
        }
    }




    public function delete(Request $request)
    {
        $id=$request->id;
        $shortcut = AboutusShortcut::find($id);
        if (!$shortcut) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'Shortcut Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke'
            ]);
        }
        try {
            $oldimage=$shortcut->image;
            $shortcut->delete();
            try {
                if (!$oldimage=='header.jpg')
                unlink(base_path('public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'aboutus' . DIRECTORY_SEPARATOR . $oldimage));
            }catch (\Exception $e){}
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'The Shortcut Deleted Successfully',
                'bg' => 'bg-red',
                'color' => 'whitesmoke',
                'deleted'=>true
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'The Shortcut Not Deleted Please Try Again',
                'bg' => 'bg-dark',
                'color' => 'whitesmoke'
            ]);
        }
    }


    public function changeStatus(Request $request){

        $id=$request->id;
        $shortcut=AboutusShortcut::find($id);
        if (!$shortcut) {
            return response()->json([
                'show'=>true,
                'message' => 'Shortcut Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke',
            ]);        }
        try {
            if($shortcut->status==0){$shortcut->update(['status'=>1]);
                return response()->json([
                    'show'=>true,
                    'message' => 'The Shortcut Activated Successfully',
                    'bg' => 'bg-green',
                    'fa' => 'fa-check',
                    'color' => 'whitesmoke',
                    'action'=>'Deactivate',
                    'btn'=>'danger',
                    'id'=>$request->id,
                    'status'=>'Active',
                    'statuscolor'=>'green'
                ]);} elseif ($shortcut->status==1){$shortcut->update(['status'=>0]);
                return response()->json([
                    'show'=>true,
                    'message' => 'The Shortcut Deactivated Successfully',
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
            'head'=>['required','max:20','string'],
            'paragraph'=>['required','max:100'.'string'],
            'image'=>['image'],
            'status'=>['in:0,1']
        ];
    }

    public function messages(){
        return[
            'required'=>'this field is required',
            'string'=>'this field must be string',
            'head.max'=>'the head must be less than 20',
            'paragraph.max'=>'the paragraph must be less than 100',
            'image'=>'this filed must be an image',
            'in'=>'the status must be only 0 or 1'
        ];
    }
}
