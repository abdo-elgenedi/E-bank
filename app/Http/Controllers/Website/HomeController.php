<?php

namespace App\Http\Controllers\Website;

use App\Models\AboutusHeader;
use App\Models\AboutusShortcut;
use App\Models\Contact;
use App\Models\ContactUsManage;
use App\Models\Gallery;
use App\Models\Header;
use App\Http\Controllers\Controller;
use App\Models\HowItWorksCard;
use App\Models\HowItWorksHeader;
use App\Models\OurServices;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{



    public function home(){

        $headers=Header::active()->get();
        $aboutusHeaders=AboutusHeader::active()->get();
        $aboutusShortcuts=AboutusShortcut::active()->get();
        $galleries=Gallery::active()->get();
        $howItWorksCards=HowItWorksCard::active()->get();
        $ourServices=OurServices::active()->get();
        $testimonials=Testimonial::inRandomOrder()->active()->with('customer')->limit(4)->get();
        $contactUs=ContactUsManage::first();
        return view('website.home',compact([
            'headers',
            'aboutusHeaders',
            'aboutusShortcuts',
            'galleries',
            'howItWorksCards',
            'ourServices',
            'testimonials',
            'contactUs',
        ]));
    }

    public function aboutUS(){

        $headers=Header::active()->get();
        $aboutusHeaders=AboutusHeader::active()->get();
        $aboutusShortcuts=AboutusShortcut::active()->get();
        return view('website.aboutus',compact(['headers','aboutusHeaders','aboutusShortcuts']));
    }

    public function gallery(){

        $headers=Header::active()->get();
        $galleries=Gallery::active()->get();
        return view('website.gallery',compact(['headers','galleries']));
    }

    public function services(){

        $headers=Header::active()->get();
        $ourServices=OurServices::active()->get();
        return view('website.ourservices',compact(['headers','ourServices']));
    }

    public function testimonials(){

        $headers=Header::active()->get();
        $testimonials=Testimonial::inRandomOrder()->active()->with('customer')->limit(10)->get();
        return view('website.testimonial',compact(['headers','testimonials']));
    }

    public function contact(){

        $headers=Header::active()->get();
        $contactUs=ContactUsManage::first();
        return view('website.contactus',compact(['headers','contactUs']));
    }

    public function contactUs(Request $request){

        $validation=Validator::make($request->only('f_name','l_name','email','subject','message'),$this->contactRules(),$this->contactMessages());
        if($validation->fails()){
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }
        Contact::create([
           'f_name'=>$request->f_name,
           'l_name'=>$request->l_name,
           'email'=>$request->email,
           'subject'=>$request->subject,
           'message'=>$request->message,
        ]);
        return redirect('/')->with(['message'=>'Your message sent successfully','color'=>'green']);

    }




    public function contactRules(){
        return [

            'f_name'=>['string','required','max:20'],
            'l_name'=>['string','required','max:20'],
            'email'=>['email','required'],
            'subject'=>['string','required','max:100'],
            'message'=>['string','required','max:255'],

        ];
    }
    public function contactMessages(){
        return [

            'required'=>'This filed is required',
            'string'=>'this field must be charcters only',
            'email'=>'invalid email address',
            'f_name.max'=>'max 20 words',
            'l_name.max'=>'max 20 words',
            'subject.max'=>'max 100 words',
            'message.max'=>'max 255 words',


        ];
    }
}
