<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
        if ($data['check'] ?? null == 'on') {
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:30'],
                'email' => ['required', 'string', 'email', 'max:30', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'max:60', 'confirmed'],
                'alamat' => ['required', 'min:5'],
                'jenis_kelamin' => ['required'],
                'no_hp' => ['required', 'min:10','max:13'],
                'tanggal_lahir' => ['required'],
                'nik' => ['required', 'max:16'],
                'scan_ktp' => ['required', 'max:2048', 'image']
            ]);
        } else {
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:30'],
                'email' => ['required', 'string', 'email', 'max:30', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'max:60','confirmed'],
                'alamat' => ['required', 'min:5'],
                'jenis_kelamin' => ['required'],
                'no_hp' => ['required', 'min:10','max:13'],
                'tanggal_lahir' => ['required'],
            ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        
        if ($data['check'] ?? null == 'on') {

            $file = $data['scan_ktp'];
            $fileName = substr(md5(microtime()), 0, 100) . '.' . $file->getClientOriginalExtension();
            $data['scan_ktp']->storeAs('public/ktp/', $fileName);
        }
        $u = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'tanggal_lahir' => $data['tanggal_lahir'],
            'no_hp' => $data['no_hp'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'alamat' => $data['alamat'],
            'role' => $data['check'] ?? null == 'on' ? 'pengelola_wisata' : 'wisatawan',
        ]);
        if ($data['check'] ?? null == 'on') {
            $u->wisata()->create([
                'nik' => $data['nik'],
                'scan_ktp' => $fileName,
            ]);
        }
        return $u;
    }
}
