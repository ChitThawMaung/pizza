<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //change password page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }

    //change password
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbPassword = $user->password;

        if(Hash::check($request->oldPassword,$dbPassword)){
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
            // Auth::logout();
            // return redirect()->route('auth#loginPage');  //logout / login

            // return redirect()->route('category#list'); //another page

            return back()->with(['changeSuccess' => 'Password Change Success...']); // alert
        }
            return back()->with(['notMatch' => 'The Old Password not Match. Try Again!']);
    }

    //direct admin details page
    public function details(){
        return view('admin.account.details');
    }

    //direct admin profile page
    public function edit(){
        return view('admin.account.edit');
    }

    //update account
    public function update($id,Request $request){
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        //for image
        if($request->hasFile('image')){
            $dbImage = User::where('id',$id)->first();
            $dbImage =  $dbImage->image;

            if($dbImage != null){
                Storage::delete('public/' . $dbImage);
            }

            $fileName = uniqid() .$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        User::where('id',$id)->update($data);
        return redirect()->route('admin#details')->with(['updateSuccess' => 'Admin Account Updated...']);
    }

    //admin list
    public function list(){
        $admin = User::when(request('key'),function($query){
            $query->orWhere('name','like','%'.request('key').'%')
                  ->orWhere('email','like','%'.request('key').'%')
                  ->orWhere('gender','like','%'.request('key').'%')
                  ->orWhere('phone','like','%'.request('key').'%')
                  ->orWhere('address','like','%'.request('key').'%');
        })
        ->where('role','admin')
        ->paginate(3);
        $admin->appends(request()->all());
        return view('admin.account.list',compact('admin'));
    }

    //delete account
    public function delete($id){
       User::where('id',$id)->delete();
       return back()->with(['deleteSuccess' => 'Admin Account Deleted']);
    }

    //change role
    public function changeRole($id){
        $account = User::where('id',$id)->first();
        return view('admin.account.changeRole',compact('account'));
    }

    //change
    public function change($id,Request $request){
       $data = $this->requestUserData($request);
       User::where('id',$id)->update($data);
       return redirect()->route('admin#list');
    }

    //request user data
    private function requestUserData($request){
        return [
            'role' => $request->role
        ];

    }

    // request user data
    private function getUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'updated_at' => Carbon::now()
        ];
    }

    //account validation check
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'image' => 'mimes:png,jpg,jpeg,webp|file',
            'address' => 'required',
        ],[])->validate();
    }

    //password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:6|max:10',
            'newPassword' => 'required|min:6|max:10',
            'confirmPassword' => 'required|min:6|max: 10|:same: newPassword',
        ],[
           'oldPassword.required' => 'Old Password လိုအပ်ပါသည်။',
           'newPassword.required' => 'New Password လိုအပ်ပါသည်။',
           'confirmPassword.required' => 'Confirm Password လိုအပ်ပါသည်။',
        ])->validate();
    }
}