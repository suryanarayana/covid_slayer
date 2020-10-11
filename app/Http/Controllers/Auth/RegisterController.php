<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'          =>  ['required', 'string', 'max:255'],
            'email'         =>  ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'      =>  ['required', 'string', 'min:8', 'confirmed'],
            'avatar_image'  =>  ['', 'max:1000', 'mimes:jpeg,jpg,png,gif']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $request)
    {   
        if(isset($_FILES['avatar_image']['name']) && $_FILES['avatar_image']['name'] != "") {
            $file_temp_location =   $request['avatar_image']->path();
            $file_extension     =   $request['avatar_image']->extension();
            $file_info          =   $request['avatar_image']->get();
            $public_dir         =   public_path();
        }

        $user               =   User::create([
                                    'name'      =>  $request['name'],
                                    'email'     =>  $request['email'],
                                    'password'  =>  Hash::make($request['password']),
                                    'avatar'    =>  'no_avatar.png'
                                ]);

        if($user['id'] != "" 
            && isset($_FILES['avatar_image']['name']) 
            && $_FILES['avatar_image']['name'] != "") {
            $file_name  =   "avatar_1.".$file_extension;
            move_uploaded_file($file_temp_location, $public_dir . "/user_images/" . $file_name );
            $user->avatar = "avatar_1.".$file_extension;
            $user->save();
        }

        return $user;
    }
}
