<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Setting;
use App\Models\Service;



class SettingsController extends Controller
{
    public function index(){
        $settings=Setting::find(1);
        $services=Service::orderBy('name','asc')->get();
        return view('admin.settings',['settings'=>$settings , 'services'=>$services]);
    }
    
    public function save(Request $request)
    {
        $validator=Validator::make($request->all(),[
           'website_title'=>'required'
        ]);
        if($validator->passes()){
            $settings=Setting::find(1);
            if($settings==null){
                  $settings=new Setting;
                  $settings->website_title=$request->website_title;
                  $settings->email=$request->email;
                  $settings->phone=$request->phone;
                  $settings->facebook_url=$request->facebook_url;
                  $settings->twitter_url=$request->twitter_url;
                  $settings->instagram_url=$request->instagram_url;
                  $settings->contact_card_one=$request->contact_card_one;
                  $settings->contact_card_two=$request->contact_card_two;
                  $settings->contact_card_three=$request->contact_card_three;
                  $settings->save();
            }else{
                $settings->website_title=$request->website_title;
                $settings->email=$request->email;
                $settings->phone=$request->phone;
                $settings->facebook_url=$request->facebook_url;
                $settings->twitter_url=$request->twitter_url;
                $settings->instagram_url=$request->instagram_url;
                $settings->contact_card_one=$request->contact_card_one;
                $settings->contact_card_two=$request->contact_card_two;
                $settings->contact_card_three=$request->contact_card_three;
                $settings->save();
            }
                 Session()->flash('success','Settings Saved Successfully');
            return response()->json([
                'status'=>200,
              ]);
        }else {
          // return errors here 
          return response()->json([
            'status'=>0,
            'errors'=>$validator->errors()
          ]);
      
        }
    }
}
