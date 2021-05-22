<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){

        return view('admin.dashboard.index');
    }

    public function profile(){

        return view('admin.dashboard.profile');
    }

    public function updateProfile(AdminRequest $request){

        if(Auth::guard('admin')->validate(['id'=>Auth::user()->id,'password'=>$request->password])){
        $admin=Admin::find(Auth::user()->id);
        $admin->update([
            'name'=>$request['name'],
            'username'=>$request['username'],
            'email'=>$request['email'],
            'mobile'=>$request['mobile'],
        ]);
        return redirect()->route('admin.profile')->with(['success' => 'Your profile updated successfully', 'bg' => 'bg-success', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
        } else{
            return redirect()->route('admin.profile')->with(['success' => 'The Password is wrong please try again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
        }
}


    public function updatePhoto(Request $request){
        $validate=Validator::make($request->all(),[
            'image'=>'required|image',
        ],[
            'image.required'=>'please choose image first',
            'image.image'=>'the file must be an image'
        ]);
        if($validate->fails()){
            return redirect()->back()->withErrors($validate);
        }else {
            $admin=Admin::find(Auth::user()->id);
            $oldimage=$admin->image;
            $imagename = Auth::user()->id . time() . $request->image->hashName();
            try{
                $request->image->move(base_path().'/public/images/admins/',$imagename);
                $admin->update([
                    'image'=>$imagename
                ]);
                try{
                    unlink(base_path() .DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'admins'.DIRECTORY_SEPARATOR. $oldimage);
                }catch (\Exception $e){}
                return redirect()->back()->with(['success' => 'the image updated successfully', 'bg' => 'bg-success', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
            }catch (\Exception $e){
                return redirect()->back()->with(['success' => 'The image not updated please try again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
            }
        }
    }

    public function updatePassword(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'oldpassword' => ['required'],
            'password' => ['required', 'confirmed','min:8'],
        ], [
            'required' => 'this field is required',
            'confirmed' => 'the password does not matched',
            'min' => 'the password must be more than 8 character',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->with(['success' => 'The password not updated please check the errors', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke'])->withErrors($validate);
        } else {
            if (Auth::guard('admin')->validate(['username' => Auth::user()->username, 'password' => $request->oldpassword])) {

                $admin = Admin::find(Auth::user()->id);
                $admin->update([
                    'password' => Hash::make($request['password']),
                ]);
                return redirect()->route('admin.profile')->with(['success' => 'Your password updated successfully', 'bg' => 'bg-success', 'fa' => 'fa-check', 'color' => 'whitesmoke']);
            } else {
                return redirect()->route('admin.profile')->with(['success' => 'The Password is wrong please try again', 'bg' => 'bg-dark', 'fa' => 'fa-exclamation', 'color' => 'whitesmoke']);
            }

        }
    }
}
