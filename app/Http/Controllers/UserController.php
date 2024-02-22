<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\ruang;

class UserController extends Controller
{
    public function register()
    {
        $data['title'] = 'Register';
        return view('user/register', $data);
    }

    public function register_action(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:tb_user',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ]);

        $user = new User([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'level'=> 'admin'
        ]);
        $user->save();

        return redirect()->route('login')->with('success', 'Registration success. Please login!');
    }


    public function login()
    {
        $data['title'] = 'Login';
        return view('user/login', $data);
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            $data['q'] = "";        
            $cruan = DB::table('ruang')->count();
            $cuser = DB::table('user')->count();
            $now = new Carbon;
            $time = Carbon::now()->format('H:i:s');
            // $data['notify'] = DB::table('peminjamanruang as p')
            // ->select('p.namakeg as namakeg', 's.nama as status', 'p.approvedby as appprovedby','p.mulai as mulai','p.selesai as selesai','r.nama as nama')
            // ->join('ruang as r','r.id','=','p.ruang_id')
            // ->join('status as s','s.id','=','p.status_id')
            // ->where('user_id', Auth::user()->id)
            // ->whereDate('p.selesai', '>=', $now)
            // ->whereTime('p.selesai','>=',$time)
            // ->orderBy('p.updated_at','desc')
            // ->get();
            $now = new Carbon;
            $time = Carbon::now()->format('H:i:s');
            // $query= DB::table('peminjamanruang as p')
            // ->select('p.id as id','p.user_id as uid','p.ruang_id as rid' ,'p.alasan as alasan' ,'p.namakeg as namakeg', 'w.nama as nama', 'r.nama as ruang', 'p.mulai as mulai', 'p.selesai as selesai', 's.nama as status','k.nama as penanggungjawab', 'p.approvedby as approvedby')
            // ->join('user as u', 'u.id', '=', 'p.user_id')
            // ->join('pegawais as w', 'w.nip_baru', '=', 'u.pegawai_nip')
            // ->join('ruang as r', 'r.id', '=', 'p.ruang_id')
            // ->join('status as s','s.id','=','p.status_id')
            // ->join('penanggungjawab as g','g.id','=','p.penanggungjawab_id')
            // ->join('pegawais as k','k.nip_baru','=','g.pegawai_nip')
            // ->where('s.nama', '=', 'proses')
            //                 ->orderBy('p.updated_at', 'desc');
            // $setuju= DB::table('peminjamanruang as p')
            // ->select('p.id as id','p.user_id as uid','p.ruang_id as rid' ,'p.alasan as alasan' ,'p.namakeg as namakeg', 'w.nama as nama', 'r.nama as ruang', 'p.mulai as mulai', 'p.selesai as selesai', 's.nama as status','k.nama as penanggungjawab', 'p.approvedby as approvedby')
            //                 ->join('user as u', 'u.id', '=', 'p.user_id')
            //             ->join('pegawais as w', 'w.nip_baru', '=', 'u.pegawai_nip')
            //             ->join('ruang as r', 'r.id', '=', 'p.ruang_id')
            //             ->join('status as s','s.id','=','p.status_id')
            //             ->join('penanggungjawab as g','g.id','=','p.penanggungjawab_id')
            //             ->join('pegawais as k','k.nip_baru','=','g.pegawai_nip')
            //                 ->where('s.nama', '=', 'setuju')
            //                 ->where('p.mulai','>=',$now)
            //                 ->where('p.mulai','>=',$time)
            //                 ->where(function ($query) use ($data) {
            //                     $query->where('w.nama', 'like', '%' . $data['q'] . '%');
            //                     $query->orWhere('r.nama', 'like', '%' . $data['q'] . '%');
            //                     $query->orWhere('k.nama', 'like', '%' . $data['q'] . '%');
            //                     $query->orWhere('p.approvedby', 'like', '%' . $data['q'] . '%');
            //                     $query->orWhere('s.nama', 'like', '%' . $data['q'] . '%');
            //                 })
            //               ;
            // $data['activity'] = $query->paginate(10)->withQueryString();
            // $data['jadwal'] = $setuju->paginate(10)->withQueryString();

            $data['title'] = 'Login';
            return redirect()->route('dashboard');
            // return view('dashboard/dashboard',compact('data','cruan','cuser'),$data);
        }

        return back()->withErrors([
            'salah' => 'Wrong username or password',
        ]);
    }

    public function password()
    {
        $data['title'] = 'Change Password';
        return view('user/password', $data);
    }

    public function password_action(Request $request)
    {
        $request->validate([
            'old_password' => 'required|current_password',
            'new_password' => 'required|confirmed',
        ]);
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->new_password);
        $user->save();
        $request->session()->regenerate();
        return back()->with('success', 'Password changed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}