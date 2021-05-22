<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Models\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HeaderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){

        $headers=Header::all();
        return view('admin.website.header.index',compact('headers'));
    }


    public function create(){
        return view('admin.website.header.create');
    }

    public function store(Request $request){

        try{
            $validator=Validator::make($request->only('head','paragraph','status'),$this->rules(),$this->messages());
            if ($validator->fails()){
                return redirect()->back()->withErrors($validator->errors())->withInput();
            }

            DB::beginTransaction();
            Header::create([
                'head'=>$request->head,
                'paragraph'=>$request->paragraph,
                'status'=>'1',
            ]);
            DB::commit();
            return redirect()->route('admin.header.index')->with(['success' => 'The Header Added Successfully', 'bg' => 'bg-green', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('admin.header.index')->with(['success' => 'The Header Not Added Please Try Again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
        }
    }


    public function edit($id){

        $header=Header::find($id);
        if (!$header){
            return redirect()->route('admin.header.index')->with(['success' => 'The Header Not Found', 'bg' => 'bg-cyan', 'fa' => 'fa-check', 'color' => 'whitesmoke']);

        }
        else{
            return view('admin.website.header.edit',compact(['header']));
        }
    }

    public function update(Request $request)
    {

        $header = Header::find($request->id);
        if (!$header) {
            return redirect()->route('admin.header.index')->with(['success' => 'The Header Not Found', 'bg' => 'bg-cyan', 'fa' => 'fa-check', 'color' => 'whitesmoke']);

        } else {
            try {
                $validator=Validator::make($request->only('head','paragraph'),$this->rules(),$this->messages());
                if ($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors());
                }
                DB::beginTransaction();
                $header->update([
                    'head' => $request->head,
                    'paragraph' => $request->paragraph,
                ]);
                DB::commit();
                return redirect()->route('admin.header.index')->with(['success' => 'The Header Updated Successfully', 'bg' => 'bg-green', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
            } catch (\Exception $e) {

                DB::rollBack();
                return redirect()->route('admin.header.index')->with(['success' => 'The Header Not Updated Please Try Again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
            }
        }
    }




    public function delete(Request $request)
    {
        $id=$request->id;
        $header = Header::find($id);
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
            $header->delete();
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
        $header=Header::find($id);
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
            'head'=>['required','max:30','string'],
            'paragraph'=>['required','max:255'.'string'],
            'status'=>['in:0,1']
        ];
    }

    public function messages(){
        return[
            'required'=>'this field is required',
            'string'=>'this field must be string',
            'head.max'=>'the head must be less than 30',
            'paragraph.max'=>'the paragraph must be less than 255',
            'in'=>'the status must be only 0 or 1'
        ];
    }

}
