<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function Staffindex()
    {
        $users = User::where('role', 'staff')->get();           
        return view('staff.index', compact('users'));
    }
    public function GuruIndex()
    {
        $users = User::where('role', 'guru')->get();           
        return view('guru.index', compact('users'));
    }

    public function Staffcreate()
    {
        return view('staff.create');
    }
    public function GuruCreate()
    {
        return view('guru.create');
    }

    public function Staffstore(Request $request)
    {
        $request->validate([
            'name' => 'required||min:3',
            'email' => 'required|email|unique:users,email',
        ]);

        $password = substr($request->name, 0, 3) . substr($request->email, 0, 3);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'role' => 'staff'
        ]);

        return redirect()->back()->with('success', 'Akun berhasil dibuat!');
    }
    public function GuruStore(Request $request)
    {
        $request->validate([
            'name' => 'required||min:3',
            'email' => 'required|email|unique:users,email',
        ]);

        $password = substr($request->name, 0, 3) . substr($request->email, 0, 3);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'role' => 'guru'
        ]);

        return redirect()->back()->with('success', 'Akun berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function Staffedit($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('staff.index')->with('error', 'Akun tidak ditemukan.');
        }

        return view('staff.edit', compact('user'));
    }
    public function GuruEdit($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('guru.index')->with('error', 'Akun tidak ditemukan.');
        }

        return view('guru.edit', compact('user'));
    }

    public function Staffupdate(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('staff.index')->with('error', 'Akun tidak ditemukan.');
        }

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        if ($request->password) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }

        return redirect()->route('guru  .index')->with('success', 'Akun berhasil diperbarui.');
    }
    public function GuruUpdate(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('guru.index')->with('error', 'Akun tidak ditemukan.');
        }

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        if ($request->password) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }

        return redirect()->route('staff.index')->with('success', 'Akun berhasil diperbarui.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function StaffDestroy($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect()->route('staff.index')->with('success', 'Akun berhasil dihapus.');
        } else {
            return redirect()->route('staff.index')->with('error', 'Akun tidak ditemukan.');
        }
    }

    public function loginAuth(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = $request->only(['email', 'password']);
        if (Auth::attempt($user)) {
            return redirect('/home');
        } else{
            return redirect()->back()->with('failed', 'Login Gagal Silahkan Coba Lagi');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('logout', 'Anda Telah logout');
    }

    public function page(){
        $users1 = User::where('role', 'staff')->get()->count();
        $users2 = User::where('role', 'guru')->get()->count();
        return view('home',['staff' => $users1, 'guru' => $users2]);
    }
}
