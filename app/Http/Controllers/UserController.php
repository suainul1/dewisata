<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(User $user)
    {
        if (is_null($user->id)) {
            $user = auth()->user();
        }
        if(!is_null($user->id) && auth()->user()->role != 'admin'){
            $user = auth()->user();
        }
        return view('user.profile', compact('user'));
    }
    public function all(Request $request, $role)
    {
        $l = false;
        $users = User::where('role', $role);
        if (!empty($request->all())) {
            $users = $users->where('name', 'like', '%' . $request->search . '%');
            $users = $users->get();
        } else {
            $l = true;
            $users = $users->paginate(10);
        }
        return view('user.all', compact(['users', 'role', 'l']));
    }
    public function update(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'nama' => ['required', 'string', 'max:255', 'min:2'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'image' => ['nullable', 'image', 'max:2048'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'alamat' => ['required', 'min:5'],
            'jenis_kelamin' => ['required'],
            'no_hp' => ['required', 'min:10'],
            'tanggal_lahir' => ['required'],
        ]);
        if (!is_null($request->password)) {
            if (Hash::check($request->old_password, $user->password)) {
                $user->update([
                    'password' => bcrypt($request->password),
                ]);
            } else {
                return redirect()->back()->withErrors(['old_password' => 'password lama salah']);
            }
        }
        $fileName = $user->avatar ?? null;
        if ($request->file('image') != null) {
            $file = $request->file('image');
            $fileName = substr(md5(microtime()), 0, 100) . '.' . $file->getClientOriginalExtension();
            $request->file('image')->storeAs('public/avatar', $fileName);
        }
            $user->update([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => !is_null($request->password) ? bcrypt($request->password) : $user->password,
                'role'  =>  $user->role,
                'alamat' => $request->alamat,
                'avatar' => $fileName,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_hp' => $request->no_hp,
                'tanggal_lahir' => $request->tanggal_lahir
            ]);
        toast('Success Update!', 'success');
        return redirect()->back();
    }
}
