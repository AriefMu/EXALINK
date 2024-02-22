<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {   
       $data['notify']=null;

        // dd($data['notify']);
        $data['q'] = $request->query('q');        
        $data['cruan'] = DB::table('ruang')->count();
        $data['cuser'] = DB::table('user')->count();
        $now = new Carbon;
        $time = Carbon::now()->format('H:i:s');
        $query= DB::table('peminjamanruang as p')
                        ->select('p.id as id','p.user_id as uid','p.ruang_id as rid' ,'d.alasan as alasan' ,'d.namakeg as namakeg', 'w.nama as nama', 'r.nama as ruang', 'd.mulai as mulai', 'd.selesai as selesai', 's.nama as status','k.nama as penanggungjawab', 'd.approvedby as approvedby')
                        ->join('detailpeminjamanruang as d', 'd.id', '=', 'p.dtpr_id')
                        ->join('user as u', 'u.id', '=', 'p.user_id')
                        ->join('pegawais as w', 'w.nip_baru', '=', 'u.pegawai_nip')
                        ->join('ruang as r', 'r.id', '=', 'p.ruang_id')
                        ->join('status as s','s.id','=','p.status_id')
                        ->join('penanggungjawab as g','g.id','=','p.penanggungjawab_id')
                        ->join('pegawais as k','k.nip_baru','=','g.pegawai_nip')
                        ->where('s.nama', '=', 'proses')
                        ->orderBy('p.updated_at', 'desc');
        $setuju= DB::table('peminjamanruang as p')
                        ->select('p.id as id','p.user_id as uid','p.ruang_id as rid' ,'d.alasan as alasan' ,'d.namakeg as namakeg', 'w.nama as nama', 'r.nama as ruang', 'd.mulai as mulai', 'd.selesai as selesai', 's.nama as status','k.nama as penanggungjawab', 'd.approvedby as approvedby')
                        ->join('detailpeminjamanruang as d', 'd.id', '=', 'p.dtpr_id')
                        ->join('user as u', 'u.id', '=', 'p.user_id')
                        ->join('pegawais as w', 'w.nip_baru', '=', 'u.pegawai_nip')
                        ->join('ruang as r', 'r.id', '=', 'p.ruang_id')
                        ->join('status as s','s.id','=','p.status_id')
                        ->join('penanggungjawab as g','g.id','=','p.penanggungjawab_id')
                        ->join('pegawais as k','k.nip_baru','=','g.pegawai_nip')
                        ->where('s.nama', '=', 'setuju')
                        ->where('d.mulai','>=',$now)
                        ->where('d.mulai','>=',$time)
                        ->where(function ($query) use ($data) {
                            $query->where('w.nama', 'like', '%' . $data['q'] . '%');
                            $query->orWhere('r.nama', 'like', '%' . $data['q'] . '%');
                            $query->orWhere('d.namakeg', 'like', '%' . $data['q'] . '%');
                            $query->orWhere('k.nama', 'like', '%' . $data['q'] . '%');
                            $query->orWhere('d.approvedby', 'like', '%' . $data['q'] . '%');
                            $query->orWhere('s.nama', 'like', '%' . $data['q'] . '%');
                        })
                        ->orderBy('p.updated_at', 'desc');
        $data['activity'] = $query->paginate(5)->withQueryString();
        $data['jadwal'] = $setuju->paginate(5)->withQueryString();
      
        return view('dashboard.dashboard', $data);    
    }
}
