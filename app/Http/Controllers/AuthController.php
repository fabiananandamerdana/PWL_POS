<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            // jika sudah login, maka redirect ke halaman home
            return redirect("/");
        }
        return view("auth.login");
    }
    public function postlogin(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $credentials = $request->only("username", "password");
            if (Auth::attempt($credentials)) {
                return response()->json([
                    "status" => true,
                    "message" => "Login Berhasil",
                    "redirect" => url("/"),
                ]);
            }
            return response()->json([
                "status" => false,
                "message" => "Login Gagal",
            ]);
        }
        return redirect("login");
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // return response()->json([
        //     "status" => true,
        //     "message" => "Logout Berhasil",
        //     "redirect" => redirect("login"),
        // ]);
        return redirect("login");
    }

    public function register(Request $request) {

        if (Auth::check()) {
            // jika sudah login, maka redirect ke halaman home
            return redirect("/");
        }
        return view("auth.register");
    }

    public function postregister(Request $request) {
        $request->validate([
            "username" => "required|string|min:3|unique:m_user,username",
            "name" => "required|string|max:100",
            "password" => "required|min:5",
        ]);

        $level = LevelModel::where('level_kode','STF')->first();
        if (!$level) {
            return response()->json([
                    "status" => false,
                    "message" => "Terjadi Kesalahan. Silahkan hubungin ke admin",
            ]);

        }else {
            UserModel::create([
                "username" => $request->username,
                "nama" => $request->name,
                "password" => $request->password,
                "level_id" => $level->level_id,
            ]);
            return response()->json([
                    "status" => true,
                    "message" => "Register Berhasil",
                    "redirect" => url("/"),
            ]);
        }
        return redirect("/");
    }
}

