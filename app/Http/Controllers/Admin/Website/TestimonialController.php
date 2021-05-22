<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Models\Header;
use App\Models\HowItWorksCard;
use App\Models\HowItWorksHeader;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestimonialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){

        $tests=Testimonial::with('customer')->get();
        return view('admin.website.testimonials.index',compact('tests'));
    }

    public function delete(Request $request)
    {
        $id=$request->id;
        $tests = Testimonial::find($id);
        if (!$tests) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'Testimonial Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke'
            ]);
        }
        try {
            $tests->delete();
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'The Testimonial Deleted Successfully',
                'bg' => 'bg-red',
                'color' => 'whitesmoke',
                'deleted'=>true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'show'=>true,
                'id'=>$request->id,
                'message' => 'The Testimonial Not Deleted Please Try Again',
                'bg' => 'bg-dark',
                'color' => 'whitesmoke'
            ]);
        }
    }


    public function changeStatus(Request $request){

        $id=$request->id;
        $tests=Testimonial::find($id);
        if (!$tests) {
            return response()->json([
                'show'=>true,
                'message' => 'The testimonial Not Found',
                'bg' => 'bg-cyan',
                'color' => 'whitesmoke',
            ]);        }
        try {
            if($tests->status==0){$tests->update(['status'=>1]);
                return response()->json([
                    'show'=>true,
                    'message' => 'The Testimonial Activated Successfully',
                    'bg' => 'bg-green',
                    'fa' => 'fa-check',
                    'color' => 'whitesmoke',
                    'action'=>'Deactivate',
                    'btn'=>'danger',
                    'id'=>$request->id,
                    'status'=>'Active',
                    'statuscolor'=>'green'
                ]);} elseif ($tests->status==1){$tests->update(['status'=>0]);
                return response()->json([
                    'show'=>true,
                    'message' => 'The Testimonial Deactivated Successfully',
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
                'message' => 'The Testimonial Status Not Changed Please Try Again',
                'bg' => 'bg-dark',
                'color' => 'whitesmoke',
            ]);
        }
    }



}
