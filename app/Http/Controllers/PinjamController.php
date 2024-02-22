<?php

namespace App\Http\Controllers;



use App\Models\pegawai;
use App\Models\pinjam;
use App\Models\detailpeminjamanruang;
use App\Models\ruang;
use App\Models\User;
use App\Models\penanggungjawab;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class PinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['q'] = $request->query('q');
        $data['ruang_id'] = $request->query('ruang_id');
        $data['start'] = $request->query('start');
        $data['end'] = $request->query('end');
        $data['diffH'] = $request->query('diffH');
       
        $ruang = ruang::all();
        // $data['user']=user::all();
        // $data['pegawai']=pegawai::all();
        if(Auth::user()->role == 'admin' or Auth::user()->role == 'superadmin'  ){
            if($data == true){
             $query = pinjam::select('peminjamanruang.id as id','peminjamanruang.user_id as uid','peminjamanruang.ruang_id as rid' ,'d.alasan as alasan' ,'d.namakeg as namakeg', 'pegawais.nama as nama', 'ruang.nama as ruang', 'd.mulai as mulai', 'd.selesai as selesai', 's.nama as status','w.nama as penanggungjawab', 'd.approvedby as approvedby')
            ->join('detailpeminjamanruang as d', 'd.id', '=', 'peminjamanruang.dtpr_id') 
            ->join('user', 'user.id', '=', 'peminjamanruang.user_id')            
            ->join('pegawais', 'pegawais.nip_baru', '=', 'user.pegawai_nip')            
            ->join('ruang', 'ruang.id', '=', 'peminjamanruang.ruang_id')
            ->join('penanggungjawab as g','g.id','=','peminjamanruang.penanggungjawab_id')
            ->join('pegawais as w', 'w.nip_baru', '=', 'g.pegawai_nip')    
            ->join('status as s','s.id','=','peminjamanruang.status_id')
            ->orderBy('peminjamanruang.updated_at', 'desc')               
            ->where(function ($query) use ($data) {
                $query->where('pegawais.nama', 'like', '%' . $data['q'] . '%');
                $query->orWhere('ruang.nama', 'like', '%' . $data['q'] . '%');
                $query->orWhere('w.nama', 'like', '%' . $data['q'] . '%');
                $query->orWhere('approvedby', 'like', '%' . $data['q'] . '%');
                $query->orWhere('s.nama', 'like', '%' . $data['q'] . '%');
            });
                
        }    
            }else {
                $query = pinjam::select('peminjamanruang.id as id','peminjamanruang.user_id as uid','peminjamanruang.ruang_id as rid' ,'d.alasan as alasan' ,'d.namakeg as namakeg', 'pegawais.nama as nama', 'ruang.nama as ruang', 'd.mulai as mulai', 'd.selesai as selesai', 's.nama as status','w.nama as penanggungjawab', 'd.approvedby as approvedby')
                ->join('detailpeminjamanruang as d', 'd.id', '=', 'peminjamanruang.dtpr_id') 
                ->join('user', 'user.id', '=', 'peminjamanruang.user_id')            
                ->join('pegawais', 'pegawais.nip_baru', '=', 'user.pegawai_nip')            
                ->join('ruang', 'ruang.id', '=', 'peminjamanruang.ruang_id')
                ->join('penanggungjawab as g','g.id','=','peminjamanruang.penanggungjawab_id')
                ->join('pegawais as w', 'w.nip_baru', '=', 'g.pegawai_nip')    
                ->join('status as s','s.id','=','peminjamanruang.status_id')
                ->orderBy('peminjamanruang.updated_at','desc')
                ->where('user.id',Auth::user()->id)
                ->where(function ($query) use ($data) {
                    
                    $query->where('pegawais.nama', 'like', '%' . $data['q'] . '%');
                    $query->orWhere('ruang.nama', 'like', '%' . $data['q'] . '%');
                    $query->orWhere('w.nama', 'like', '%' . $data['q'] . '%');
                    $query->orWhere('approvedby', 'like', '%' . $data['q'] . '%');
                });
                    
             }
        
             if ($data['start']){
             $query->whereDate('mulai', '>=', $data['start']);}
             if ($data['end']){
             $query->whereDate('selesai', '<=', $data['end']);}
             if ($data['ruang_id']){
             $query->where('ruang.id', $data['ruang_id']);}
             if($data['diffH']){
                if($data['diffH'] == 1){
                $query->where('peminjamanruang.updated_at', '>=', Carbon::now()->subHour());
                }
                if($data['diffH'] == 2){
                    $query->where('peminjamanruang.updated_at', '>=', Carbon::now()->subDay());
                }
                if($data['diffH'] == 3){
                    $query->where('peminjamanruang.updated_at', '>=', Carbon::now()->subWeek());
                }
                if($data['diffH'] == 4){
                    $query->where('peminjamanruang.updated_at', '>=', Carbon::now()->subMonth());
                }
                if($data['diffH'] == 5){
                    $query->where('peminjamanruang.updated_at', '>=', Carbon::now()->subYear());
                }else{
               
                }
             }
             $namar = ruang::where('id', "=", $data['ruang_id'])->get();
            $desc = null;
       foreach ($namar as $key => $value) {
        # code...
        $com = " ";
            if(  $value->nama == true or $data['start'] == true or  $data['end'] == true or  $data['diffH'] == true or $data['q'] == true ){
                $desc = $data['q'] . $com .
                $value->nama. $com .
                    $data['start'] . $com .
                    $data['end'] . $com .  $data['diffH']
                    ;
            } 
       }
       
            // $namar = implode( ',',$vpn_network);
            $data['pinjam'] = $query->paginate(10)->withQueryString();
            
       
            return view('pinjam.index',compact('ruang','desc'),$data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function setujuindex(Request $request)
    {
        
        $data['q'] = $request->query('q');
        $data['ruang_id'] = $request->query('ruang_id');
        $data['start'] = $request->query('start');
        $data['end'] = $request->query('end');
        $data['diffH'] = $request->query('diffH');
       
        $ruang = ruang::all();
        $user=user::all();
        $pegawai=pegawai::all();
        if(Auth::user()->role == 'admin' or Auth::user()->role == 'superadmin'){
            if ($data == true) {
                $query = pinjam::select('peminjamanruang.id as id','peminjamanruang.user_id as uid','peminjamanruang.ruang_id as rid' ,'d.alasan as alasan' ,'d.namakeg as namakeg', 'pegawais.nama as nama', 'ruang.nama as ruang', 'd.mulai as mulai', 'd.selesai as selesai', 's.nama as status','w.nama as penanggungjawab', 'd.approvedby as approvedby')
                ->join('detailpeminjamanruang as d', 'd.id', '=', 'peminjamanruang.dtpr_id') 
                ->join('user', 'user.id', '=', 'peminjamanruang.user_id')            
                ->join('pegawais', 'pegawais.nip_baru', '=', 'user.pegawai_nip')            
                ->join('ruang', 'ruang.id', '=', 'peminjamanruang.ruang_id')
                ->join('penanggungjawab as g','g.id','=','peminjamanruang.penanggungjawab_id')
                ->join('pegawais as w', 'w.nip_baru', '=', 'g.pegawai_nip')    
                ->join('status as s','s.id','=','peminjamanruang.status_id')
                    ->where('s.nama', '=', 'setuju')
                    ->orderBy('peminjamanruang.updated_at', 'desc')
                    ->where(function ($query) use ($data) {
                        $query->where('pegawais.nama', 'like', '%' . $data['q'] . '%');
                        $query->orWhere('ruang.nama', 'like', '%' . $data['q'] . '%');
                        $query->orWhere('w.nama', 'like', '%' . $data['q'] . '%');
                        $query->orWhere('approvedby', 'like', '%' . $data['q'] . '%');
                        $query->orWhere('s.nama', 'like', '%' . $data['q'] . '%');
                    });
            }
        }else{
            $query = pinjam::select('peminjamanruang.id as id','peminjamanruang.user_id as uid','peminjamanruang.ruang_id as rid' ,'d.alasan as alasan' ,'d.namakeg as namakeg', 'pegawais.nama as nama', 'ruang.nama as ruang', 'd.mulai as mulai', 'd.selesai as selesai', 's.nama as status','w.nama as penanggungjawab', 'd.approvedby as approvedby')
            ->join('detailpeminjamanruang as d', 'd.id', '=', 'peminjamanruang.dtpr_id') 
                ->join('user', 'user.id', '=', 'peminjamanruang.user_id')            
                ->join('pegawais', 'pegawais.nip_baru', '=', 'user.pegawai_nip')            
                ->join('ruang', 'ruang.id', '=', 'peminjamanruang.ruang_id')
                ->join('penanggungjawab as g','g.id','=','peminjamanruang.penanggungjawab_id')
                ->join('pegawais as w', 'w.nip_baru', '=', 'g.pegawai_nip')    
                ->join('status as s','s.id','=','peminjamanruang.status_id')
            ->where('s.nama','=','setuju')
            ->where('user.id',Auth::user()->id)
            ->orderBy('peminjamanruang.updated_at','desc')
            ->where(function ($query) use ($data) {
                $query->where('pegawais.nama', 'like', '%' . $data['q'] . '%');
                $query->orWhere('ruang.nama', 'like', '%' . $data['q'] . '%');
                $query->orWhere('w.nama', 'like', '%' . $data['q'] . '%');
                $query->orWhere('approvedby', 'like', '%' . $data['q'] . '%');
                $query->orWhere('s.nama', 'like', '%' . $data['q'] . '%');
            });
        }
        if ($data['start']){
            $query->whereDate('mulai', '>=', $data['start']);}
            if ($data['end']){
            $query->whereDate('selesai', '<=', $data['end']);}
            if ($data['ruang_id']){
            $query->where('ruang.id', $data['ruang_id']);}
            if($data['diffH']){
               if($data['diffH'] == 1){
               $query->where('peminjamanruang.updated_at', '>=', Carbon::now()->subHour());
               }
               if($data['diffH'] == 2){
                   $query->where('peminjamanruang.updated_at', '>=', Carbon::now()->subDay());
               }
               if($data['diffH'] == 3){
                   $query->where('peminjamanruang.updated_at', '>=', Carbon::now()->subWeek());
               }
               if($data['diffH'] == 4){
                   $query->where('peminjamanruang.updated_at', '>=', Carbon::now()->subMonth());
               }
               if($data['diffH'] == 5){
                   $query->where('peminjamanruang.updated_at', '>=', Carbon::now()->subYear());
               }else{
              
               }
            }
            $namar = ruang::where('id', "=", $data['ruang_id'])->get();
            $desc = null;
       foreach ($namar as $key => $value) {
        # code...
        $com = " ";
            if(  $value->nama == true or $data['start'] == true or  $data['end'] == true or  $data['diffH'] == true or $data['q'] == true ){
                $desc = $data['q'] . $com .
                $value->nama. $com .
                    $data['start'] . $com .
                    $data['end'] . $com .  $data['diffH']
                    ;
            } 
       }
            // $namar = implode( ',',$vpn_network);
            $data['pinjam'] = $query->paginate(10)->withQueryString();
            
            return view('pinjam.indexsetuju', compact('user','pegawai','ruang','desc'),$data);
       
    }
    public function prosesindex(Request $request)
    {
        $data['q'] = $request->query('q');
        $data['ruang_id'] = $request->query('ruang_id');
        $data['start'] = $request->query('start');
        $data['end'] = $request->query('end');
        $data['diffH'] = $request->query('diffH');
        $ruang = ruang::all();
        $user=user::all();
        $pegawai=pegawai::all();
        if(Auth::user()->role == 'admin' or Auth::user()->role == 'superadmin'  ){
            $query = pinjam::select('peminjamanruang.id as id','peminjamanruang.user_id as uid','peminjamanruang.ruang_id as rid' ,'d.alasan as alasan' ,'d.namakeg as namakeg', 'pegawais.nama as nama', 'ruang.nama as ruang', 'd.mulai as mulai', 'd.selesai as selesai', 's.nama as status','w.nama as penanggungjawab', 'd.approvedby as approvedby')
            ->join('detailpeminjamanruang as d', 'd.id', '=', 'peminjamanruang.dtpr_id') 
            ->join('user', 'user.id', '=', 'peminjamanruang.user_id')            
            ->join('pegawais', 'pegawais.nip_baru', '=', 'user.pegawai_nip')            
            ->join('ruang', 'ruang.id', '=', 'peminjamanruang.ruang_id')
            ->join('penanggungjawab as g','g.id','=','peminjamanruang.penanggungjawab_id')
            ->join('pegawais as w', 'w.nip_baru', '=', 'g.pegawai_nip')    
            ->join('status as s','s.id','=','peminjamanruang.status_id')
                ->where('s.nama','=','proses')
                ->orderBy('peminjamanruang.updated_at','desc')
                ->where(function ($query) use ($data) {
                    $query->where('pegawais.nama', 'like', '%' . $data['q'] . '%');
                    $query->orWhere('ruang.nama', 'like', '%' . $data['q'] . '%');
                    $query->orWhere('w.nama', 'like', '%' . $data['q'] . '%');
                    $query->orWhere('approvedby', 'like', '%' . $data['q'] . '%');
                    $query->orWhere('s.nama', 'like', '%' . $data['q'] . '%');
                });
            }else {
                $query = pinjam::select('peminjamanruang.id as id','peminjamanruang.user_id as uid','peminjamanruang.ruang_id as rid' ,'d.alasan as alasan' ,'d.namakeg as namakeg', 'pegawais.nama as nama', 'ruang.nama as ruang', 'd.mulai as mulai', 'd.selesai as selesai', 's.nama as status','w.nama as penanggungjawab', 'd.approvedby as approvedby')
                ->join('detailpeminjamanruang as d', 'd.id', '=', 'peminjamanruang.dtpr_id') 
                ->join('user', 'user.id', '=', 'peminjamanruang.user_id')            
                ->join('pegawais', 'pegawais.nip_baru', '=', 'user.pegawai_nip')            
                ->join('ruang', 'ruang.id', '=', 'peminjamanruang.ruang_id')
                ->join('penanggungjawab as g','g.id','=','peminjamanruang.penanggungjawab_id')
                ->join('pegawais as w', 'w.nip_baru', '=', 'g.pegawai_nip')    
                ->join('status as s','s.id','=','peminjamanruang.status_id')
                ->where('s.nama','=','proses')
                ->where('user.id',Auth::user()->id)
                ->orderBy('peminjamanruang.updated_at','desc')
                ->where(function ($query) use ($data) {
                    $query->where('pegawais.nama', 'like', '%' . $data['q'] . '%');
                    $query->orWhere('ruang.nama', 'like', '%' . $data['q'] . '%');
                    $query->orWhere('w.nama', 'like', '%' . $data['q'] . '%');
                    $query->orWhere('approvedby', 'like', '%' . $data['q'] . '%');
                    $query->orWhere('s.nama', 'like', '%' . $data['q'] . '%');
                });
            }
            if ($data['start']){
                $query->whereDate('mulai', '>=', $data['start']);}
                if ($data['end']){
                $query->whereDate('selesai', '<=', $data['end']);}
                if ($data['ruang_id']){
                $query->where('ruang.id', $data['ruang_id']);}
                if($data['diffH']){
                   if($data['diffH'] == 1){
                   $query->where('peminjamanruang.updated_at', '>=', Carbon::now()->subHour());
                   }
                   if($data['diffH'] == 2){
                       $query->where('peminjamanruang.updated_at', '>=', Carbon::now()->subDay());
                   }
                   if($data['diffH'] == 3){
                       $query->where('peminjamanruang.updated_at', '>=', Carbon::now()->subWeek());
                   }
                   if($data['diffH'] == 4){
                       $query->where('peminjamanruang.updated_at', '>=', Carbon::now()->subMonth());
                   }
                   if($data['diffH'] == 5){
                       $query->where('peminjamanruang.updated_at', '>=', Carbon::now()->subYear());
                   }else{
                  
                   }
                }
                $namar = ruang::where('id', "=", $data['ruang_id'])->get();
                $desc = null;
           foreach ($namar as $key => $value) {
            # code...
            $com = " ";
                if(  $value->nama == true or $data['start'] == true or  $data['end'] == true or  $data['diffH'] == true or $data['q'] == true ){
                    $desc = $data['q'] . $com .
                    $value->nama. $com .
                        $data['start'] . $com .
                        $data['end'] . $com .  $data['diffH']
                        ;
                } 
           }
           $data['pinjam'] = $query->paginate(10)->withQueryString();
            return view('pinjam.indexproses', compact('user','pegawai','desc'),$data);
       
    }
    public function tolakindex(Request $request)
    {
        $data['q'] = $request->query('q');
        $data['ruang_id'] = $request->query('ruang_id');
        $data['start'] = $request->query('start');
        $data['end'] = $request->query('end');
        $data['diffH'] = $request->query('diffH');
        $ruang = ruang::all();
        $user=user::all();
        $pegawai=pegawai::all();
        if(Auth::user()->role == 'admin' or Auth::user()->role == 'superadmin'  ) {
            $query = pinjam::select('peminjamanruang.id as id','peminjamanruang.user_id as uid','peminjamanruang.ruang_id as rid' ,'d.alasan as alasan' ,'d.namakeg as namakeg', 'pegawais.nama as nama', 'ruang.nama as ruang', 'd.mulai as mulai', 'd.selesai as selesai', 's.nama as status','w.nama as penanggungjawab', 'd.approvedby as approvedby')
            ->join('detailpeminjamanruang as d', 'd.id', '=', 'peminjamanruang.dtpr_id') 
            ->join('user', 'user.id', '=', 'peminjamanruang.user_id')            
            ->join('pegawais', 'pegawais.nip_baru', '=', 'user.pegawai_nip')            
            ->join('ruang', 'ruang.id', '=', 'peminjamanruang.ruang_id')
            ->join('penanggungjawab as g','g.id','=','peminjamanruang.penanggungjawab_id')
            ->join('pegawais as w', 'w.nip_baru', '=', 'g.pegawai_nip')    
            ->join('status as s','s.id','=','peminjamanruang.status_id')
                ->where('s.nama', '=', 'tolak')
                ->orderBy('peminjamanruang.updated_at','desc')
                ->where(function ($query) use ($data) {
                    $query->where('pegawais.nama', 'like', '%' . $data['q'] . '%');
                    $query->orWhere('ruang.nama', 'like', '%' . $data['q'] . '%');
                    $query->orWhere('w.nama', 'like', '%' . $data['q'] . '%');
                    $query->orWhere('approvedby', 'like', '%' . $data['q'] . '%');
                    $query->orWhere('s.nama', 'like', '%' . $data['q'] . '%');
                });
        }else{
            $query = pinjam::select('peminjamanruang.id as id','peminjamanruang.user_id as uid','peminjamanruang.ruang_id as rid' ,'d.alasan as alasan' ,'d.namakeg as namakeg', 'pegawais.nama as nama', 'ruang.nama as ruang', 'd.mulai as mulai', 'd.selesai as selesai', 's.nama as status','w.nama as penanggungjawab', 'd.approvedby as approvedby')
            ->join('detailpeminjamanruang as d', 'd.id', '=', 'peminjamanruang.dtpr_id') 
            ->join('user', 'user.id', '=', 'peminjamanruang.user_id')            
            ->join('pegawais', 'pegawais.nip_baru', '=', 'user.pegawai_nip')            
            ->join('ruang', 'ruang.id', '=', 'peminjamanruang.ruang_id')
            ->join('penanggungjawab as g','g.id','=','peminjamanruang.penanggungjawab_id')
            ->join('pegawais as w', 'w.nip_baru', '=', 'g.pegawai_nip')    
            ->join('status as s','s.id','=','peminjamanruang.status_id')
            ->where('s.nama', '=', 'tolak')
            ->where('user.id',Auth::user()->id)
            ->orderBy('peminjamanruang.updated_at','desc')
            ->where(function ($query) use ($data) {
                $query->where('pegawais.nama', 'like', '%' . $data['q'] . '%');
                $query->orWhere('ruang.nama', 'like', '%' . $data['q'] . '%');
                $query->orWhere('w.nama', 'like', '%' . $data['q'] . '%');
                $query->orWhere('approvedby', 'like', '%' . $data['q'] . '%');
                $query->orWhere('s.nama', 'like', '%' . $data['q'] . '%');
            });
        }
        if ($data['start']){
            $query->whereDate('mulai', '>=', $data['start']);}
            if ($data['end']){
            $query->whereDate('selesai', '<=', $data['end']);}
            if ($data['ruang_id']){
            $query->where('ruang.id', $data['ruang_id']);}
            if($data['diffH']){
               if($data['diffH'] == 1){
               $query->where('peminjamanruang.updated_at', '>=', Carbon::now()->subHour());
               }
               if($data['diffH'] == 2){
                   $query->where('peminjamanruang.updated_at', '>=', Carbon::now()->subDay());
               }
               if($data['diffH'] == 3){
                   $query->where('peminjamanruang.updated_at', '>=', Carbon::now()->subWeek());
               }
               if($data['diffH'] == 4){
                   $query->where('peminjamanruang.updated_at', '>=', Carbon::now()->subMonth());
               }
               if($data['diffH'] == 5){
                   $query->where('peminjamanruang.updated_at', '>=', Carbon::now()->subYear());
               }else{
              
               }
            }
            $namar = ruang::where('id', "=", $data['ruang_id'])->get();
            $desc = null;
       foreach ($namar as $key => $value) {
        # code...
        $com = " ";
            if(  $value->nama == true or $data['start'] == true or  $data['end'] == true or  $data['diffH'] == true or $data['q'] == true ){
                $desc = $data['q'] . $com .
                $value->nama. $com .
                    $data['start'] . $com .
                    $data['end'] . $com .  $data['diffH']
                    ;
            } 
       }
       $data['pinjam'] = $query->paginate(10)->withQueryString();
            return view('pinjam.indextolak', compact('user','pegawai','desc'),$data);
       
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ruang = ruang::all();
        $user = User::all();
        $pegawai=pegawai::all();
        $pinjam = pinjam::all();
        return view('pinjam.create',compact('ruang','user','pinjam','pegawai'));
    }
    public function select2Search(Request $request)
    {
        $pinjam = [];

        if($request->has('q')){
            $search = $request->q;
            $pinjam =penanggungjawab::select('pegawais.nip_baru as nip_baru',"penanggungjawab.id as id", "pegawais.nama as nama")
                    ->join('pegawais','pegawais.nip_baru','=','penanggungjawab.pegawai_nip')           
                    ->where('pegawais.nama', 'LIKE', "%$search%")
                    ->orWhere('pegawais.nip_baru', 'LIKE', "%$search%")
                    ->get();
        }
        return response()->json($pinjam);
    }
    public function selectruang(Request $request)
    {
        $sr = [];

        if($request->has('q')){
            $search = $request->q;
            $sr =ruang::select("id", "nama")           
                    ->where('nama', 'LIKE', "%$search%")
                    // ->orWhere('id', 'LIKE', "%$search%")
                    ->get();
        }
        return response()->json($sr);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_kegiatan' => 'required',
            // 'user_id'     => 'required',
            'ruang_id'   => 'required',
            'mulai'   => 'required',
            'durasi'   => 'required',
            'penanggung_jawab'   => 'required',
           
        ]);
        $from =date('Y-m-d H:i:s',(strtotime($request->mulai))) ;
        $jam = $request->durasi;
        $to = date("Y-m-d H:i:s",(strtotime($request->mulai."+".$jam."hours" ) ));
        $cancel = pinjam::join('detailpeminjamanruang as d', 'd.id', '=', 'peminjamanruang.dtpr_id')->where('peminjamanruang.ruang_id', '=', $request->ruang_id)
        //     ->where([
        //         ['status','setuju'], 
        //    ['status','proses'], 
        //    ])    
        ->where(function ($query) {
            $query->where('peminjamanruang.status_id', '3');
                        // ->orWhere('status','proses');
})         
            // ->whereDate('mulai','=',$date)
            ->WhereBetween('d.mulai',[$from,$to])
            // ->whereTime('selesai','<=',$from)
            // ->whereBetween('mulai',[$from,$to])
            ->count();
    $cancel2 = pinjam::join('detailpeminjamanruang as d', 'd.id', '=', 'peminjamanruang.dtpr_id')->where('peminjamanruang.ruang_id', '=', $request->ruang_id)

        ->where(function ($query) {
            $query->where('peminjamanruang.status_id', '3');
                        // ->orWhere('status','proses');
})         
            ->WhereBetween('d.selesai',[$from,$to])
            ->count();
        // dd($cancel);
        // $pinjam = pinjam::whereDate('mulai',$request->mulai,)->first(); // model or null
        // if($ruangan >= 1)
        // {
           
            if ($cancel >=1 or $cancel2>=1) {
            
                return back()->with(['error' => 'Jadwal ruangan sudah terisi!']);
            }   else if($cancel == 0 or $cancel2 == 0 or $cancel == false or $cancel2 == false) {
                $jam = ($request->durasi);
                $dpinjams = new detailpeminjamanruang ([
                    'namakeg'=>$request->nama_kegiatan,
                    'mulai'   => $request->mulai,
                    'selesai'   =>date("Y-m-d\TH:i",(strtotime($request->mulai."+".$jam."hours" ) )),
                    ]);
                $dpinjams->save();
                $dtpr_id=detailpeminjamanruang::select('id')
                        ->where('namakeg','=',$request->nama_kegiatan)
                        ->where('mulai','=', $request->mulai)
                        ->limit(1)->get();
                foreach ($dtpr_id as $key => $value) {
                    $pinjams = new pinjam ([
                        'dtpr_id'=>$value->id,
                        'user_id'     => Auth::user()->id,
                        'ruang_id'   => $request->ruang_id,
                        'penanggungjawab_id'=> $request->penanggung_jawab,
                        'status_id'=>'2'
                        ]);
                        $pinjams->save();
                    # code...
                }
                
             
                  return redirect()->route('pinjam.index')->with(['success' => 'Data Berhasil Disimpan!']);
            }
        // }else if($ruangan == 0 or $ruangan == false){
        //     $jam = ($request->durasi);
        //    $pinjams = new pinjam ([
        //     'namakeg'=>$request->nama_kegiatan,
        //     'user_id'     => Auth::user()->id,
        //     'ruang_id'   => $request->ruang_id,
        //     'mulai'   => $request->mulai,
        //     'selesai'   =>date("Y-m-d\TH:i",(strtotime($request->mulai."+".$jam."hours" ) )),
        //     'penanggungjawab'=> $request->penanggung_jawab
        //     ]);
        //     $pinjams->save();
        
        //      return redirect()->route('pinjam.index')->with(['success' => 'Data Berhasil Disimpan!']);
        // }

       
        //redirect to index
       
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function show(pinjam $pinjam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, pinjam $pinjam, User $user)
    {
        $this->validate($request, [
            'namakeg' => 'required',
            
            'ruang_id' => 'required',
            'mulai' => 'required',
            'durasi' => 'required',
            'penanggung_jawab' => 'required',
            
        ]);
        
        // $ruangan= pinjam::where('ruang_id','=',$request->ruang_id)->where('status','=','proses'or'setuju')->count();
        // $date =date('Y-m-d',(strtotime($request->mulai))) ;
        // $selesai = pinjam::select('selesai')->where('id', 43)->get();
       
        $from =date('Y-m-d H:i:s',(strtotime($request->mulai))) ;
        $jam = $request->durasi;
        $to = date("Y-m-d H:i:s",(strtotime($request->mulai."+".$jam."hours" ) ));
       
        $cancel = pinjam::join('detailpeminjamanruang as d','d.id','=','peminjamanruang.dtpr_id')
                        ->join('status as s','s.id','=','peminjamanruang.status_id')
                        ->where('peminjamanruang.ruang_id', '=', $request->ruang_id)
            //     ->where([
            //         ['status','setuju'], 
            //    ['status','proses'], 
            //    ])    
            ->where(function ($query) {
                $query->where('s.nama', 'setuju')
                        ->orWhere('s.nama','proses');
    })         
                // ->whereDate('mulai','=',$date)
                ->WhereBetween('d.mulai',[$from,$to])
                // ->whereTime('selesai','<=',$from)
                // ->whereBetween('mulai',[$from,$to])
                ->count();
        $cancel2 = pinjam::join('detailpeminjamanruang as d','d.id','=','peminjamanruang.dtpr_id')
        ->join('status as s','s.id','=','peminjamanruang.status_id')
        ->where('peminjamanruang.ruang_id', '=', $request->ruang_id)

            ->where(function ($query) {
                $query->where('s.nama', 'setuju')
                            ->orWhere('s.nama','proses');
    })         
                ->WhereBetween('d.selesai',[$from,$to])
                ->count();
       
       
        
        if ($cancel > 1 or $cancel2 > 1) {
           
        return back()->with(['error' => 'Pengajuan Sudah Terisi!']);
        }elseif ($cancel == 1 or $cancel2 == 1){
          
            $cancel3= pinjam::select('peminjamanruang.id as id')->join('detailpeminjamanruang as d','d.id','=','peminjamanruang.dtpr_id')
            ->join('status as s','s.id','=','peminjamanruang.status_id')
            ->where('peminjamanruang.ruang_id', '=', $request->ruang_id)
                    ->where(function($query) {
                        $query->where('s.nama','setuju')
                            ->orWhere('s.nama','proses');
                            })                    
                    ->WhereBetween('d.mulai',[$from,$to]) ;                   
                    
                $cancel4= pinjam::select('peminjamanruang.id as id')->join('detailpeminjamanruang as d','d.id','=','peminjamanruang.dtpr_id')
                ->join('status as s','s.id','=','peminjamanruang.status_id')
                ->where('peminjamanruang.ruang_id', '=', $request->ruang_id)
        
                ->where(function($query) {
                    $query->where('s.nama','setuju')
                                ->orWhere('s.nama','proses');
        })         
                    ->WhereBetween('d.selesai',[$from,$to])
                    ->union($cancel3)
                    ->get();
                    
                    foreach($cancel4 as $key){
                       
                    if($key->id == $request->id){
                        $dtpr_id=detailpeminjamanruang::find($pinjam->dtpr_id);
                      
                        
                            $dtpr_id->namakeg = $request->namakeg;
                            $dtpr_id->mulai = $request->mulai;
                            $dtpr_id->selesai = date("Y-m-d\TH:i",(strtotime($request->mulai."+".$request->durasi."hours" ) ));
                            $dtpr_id->alasan = $request->alasan;
                            $dtpr_id->save();
                        
                        $ipj = DB::table('penanggungjawab as a')->join('pegawais as b','b.nip_baru','=','pegawai_nip')->select('a.id as id')->where('b.nama',$request->penanggung_jawab)->get();
                        foreach($ipj as $value){
                        $pinjam->update([
                            
                            'ruang_id' => $request->ruang_id,
                            'penanggungjawab_id'=>$value->id
                           
            
                        ]);
                    }
                        return redirect()->route('pinjam.index')->with(['success' => 'Data Berhasil Disimpan!']);
                        // return back()>with(['success' => 'Data Berhasil Disimpan!']);  
                    }else{
                       
                        return back()->with(['error' => 'Pengajuan Sudah Terisi!']);
                    }
                }
        }
        else if ($cancel == 0 or $cancel == false or $cancel2 == 0 or $cancel2 == false  ) {
        
            $dtpr_id=detailpeminjamanruang::find($pinjam->dtpr_id);
                      
                        
                            $dtpr_id->namakeg = $request->namakeg;
                            $dtpr_id->mulai = $request->mulai;
                            $dtpr_id->selesai = date("Y-m-d\TH:i",(strtotime($request->mulai."+".$request->durasi."hours" ) ));
                            $dtpr_id->alasan = $request->alasan;
                            $dtpr_id->save();
                        
                            $ipj = DB::table('penanggungjawab as a')->join('pegawais as b','b.nip_baru','=','pegawai_nip')->select('a.id as id')->where('b.nama',$request->penanggung_jawab)->get();
                            foreach($ipj as $value){
                        $pinjam->update([
                            
                            'ruang_id' => $request->ruang_id,
                            'penanggungjawab_id'=>$value->id
                           
            
                        ]);
                    }
            return redirect()->route('pinjam.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } 
        // $user=User::all();
        // $ruang=ruang::all();
        // return view('pinjam.edit', compact('pinjam','user','ruang'));
        
    }
   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pinjam $pinjam, User $user)
    {
       
        $this->validate($request, [
            'namakeg' => 'required',
            
            'ruang_id' => 'required',
            'mulai' => 'required',
            'durasi' => 'required',
            'penanggung_jawab' => 'required',
            
        ]);
        // dd($request);
        // DB::enableQueryLog();
        // dd($pinjam);
        // $ruangan= pinjam::where('ruang_id','=',$request->ruang_id)->where('status','=','proses'or'setuju')->count();
        // $date =date('Y-m-d',(strtotime($request->mulai))) ;
        // $selesai = pinjam::select('selesai')->where('id', 43)->get();
        // dd($selesai);
        $from =date('Y-m-d H:i:s',(strtotime($request->mulai))) ;
        $jam = $request->durasi;
        $to = date("Y-m-d H:i:s",(strtotime($request->mulai."+".$jam."hours" ) ));
        // dd($to);
        $cancel = pinjam::join('detailpeminjamanruang as d','d.id','=','peminjamanruang.dtpr_id')
                        ->join('status as s','s.id','=','peminjamanruang.status_id')
                        ->where('peminjamanruang.ruang_id', '=', $request->ruang_id)
            //     ->where([
            //         ['status','setuju'], 
            //    ['status','proses'], 
            //    ])    
            ->where(function ($query) {
                $query->where('s.nama', 'setuju')
                        ->orWhere('s.nama','proses');
    })         
                // ->whereDate('mulai','=',$date)
                ->WhereBetween('d.mulai',[$from,$to])
                // ->whereTime('selesai','<=',$from)
                // ->whereBetween('mulai',[$from,$to])
                ->count();
        $cancel2 = pinjam::join('detailpeminjamanruang as d','d.id','=','peminjamanruang.dtpr_id')
        ->join('status as s','s.id','=','peminjamanruang.status_id')
        ->where('peminjamanruang.ruang_id', '=', $request->ruang_id)

            ->where(function ($query) {
                $query->where('s.nama', 'setuju')
                            ->orWhere('s.nama','proses');
    })         
                ->WhereBetween('d.selesai',[$from,$to])
                ->count();
        // dd($cancel2);
        // var_dump($cancel, DB::getQueryLog());
        
        if ($cancel > 1 or $cancel2 > 1) {
            
        return back()->with(['error' => 'Pengajuan Sudah Terisi!']);
        }elseif ($cancel == 1 or $cancel2 == 1){
            dd($cancel2);
            $cancel3= pinjam::select('peminjamanruang.id as id')->join('detailpeminjamanruang as d','d.id','=','peminjamanruang.dtpr_id')
            ->join('status as s','s.id','=','peminjamanruang.status_id')
            ->where('peminjamanruang.ruang_id', '=', $request->ruang_id)
                    ->where(function($query) {
                        $query->where('s.nama','setuju')
                            ->orWhere('s.nama','proses');
                            })                    
                    ->WhereBetween('d.mulai',[$from,$to])                    
                    ->get();
                $cancel4= pinjam::select('peminjamanruang.id as id')->join('detailpeminjamanruang as d','d.id','=','peminjamanruang.dtpr_id')
                ->join('status as s','s.id','=','peminjamanruang.status_id')
                ->where('peminjamanruang.ruang_id', '=', $request->ruang_id)
        
                ->where(function($query) {
                    $query->where('s.nama','setuju')
                                ->orWhere('s.nama','proses');
        })         
                    ->WhereBetween('d.selesai',[$from,$to])
                    ->get();
                    if($cancel3 == $request->id or $cancel4 == $request->id){
                        $dtpr_id=detailpeminjamanruang::find($pinjam->dtpr_id);
                        dd($dtpr_id);
                        if($dtpr_id){
                            $dtpr_id->namakeg = $request->namakeg;
                            $dtpr_id->save();
                        }
                        
                        $pinjam->update([
                            'namakeg' => $request->namakeg,
                            'ruang_id' => $request->ruang_id,
                            'mulai' => $request->mulai,
                            'selesai' => date("Y-m-d\TH:i",(strtotime($request->mulai."+".$request->durasi."hours" ) )),
                            'penanggungjawab' => $request->penanggung_jawab,
                            'alasan' => $request->alasan
            
                        ]);
                       
                        return back()>with(['success' => 'Data Berhasil Disimpan!']);  
                    }else{
                        return back()->with(['error' => 'Pengajuan Sudah Terisi!']);
                    }
        }
        else if ($cancel == 0 or $cancel == false or $cancel2 == 0 or $cancel2 == false  ) {
      
            $pinjam->update([
                'namakeg' => $request->namakeg,
                'ruang_id' => $request->ruang_id,
                'mulai' => $request->mulai,
                'selesai' => date("Y-m-d\TH:i",(strtotime($request->mulai."+".$request->durasi."hours" ) )),
                'penanggungjawab' => $request->penanggung_jawab,
                'alasan' => $request->alasan

            ]);
           
            return redirect()->route('pinjam.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } 
      
            
           
      
        // $pinjam->update([
        //     'namakeg' => $request->namakeg,
        //     'ruang_id' => $request->ruang_id,
        //     'mulai' => $request->mulai,
        //     'selesai' => date("Y-m-d\TH:i",(strtotime($request->mulai."+".$request->durasi."hours" ) )),
        //     'penanggungjawab' => $request->penanggung_jawab,
        //     'alasan' => $request->alasan

        // ]);
       
        // return redirect()->route('pinjam.index')->with(['success' => 'Data Berhasil Disimpan!']);
        // $pinjam->update([
        //     'namakeg' => $request->namakeg,
        //     'ruang_id' => $request->ruang_id,
        //     'mulai' => $request->mulai,
        //     'selesai' => date("Y-m-d\TH:i",(strtotime($request->mulai."+".$request->durasi."hours" ) )),
        //     'penanggungjawab' => $request->penanggung_jawab,
        //     'alasan' => $request->alasan
        // ]);
       
        
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // dd($pinjam);
        // $pinjam->delete();
        $pinjam = pinjam::find($request->pinjam_delete_id);
        $dp = pinjam::select("dtpr_id")->where('id','=',$request->pinjam_delete_id)->get();
        DB::table('detailpeminjamanruang')->whereIn('id',$dp)->delete();
        
        foreach($dp as $key){
            detailpeminjamanruang::where('id', '=',$key)->get()->each->delete();
            
            // $ddp =detailpeminjamanruang::find($key)->delete();
            // dd($ddp);
            // $ddp->delete();
        }
        // $pinjam->delete();

        
        return back()->with(['success' => 'Data Berhasil Dihapus!']);
    }
    public function setuju(Request $request,$id)
    {
        $from =date('Y-m-d H:i:s',(strtotime($request->mulai))) ;
        $jam = $request->durasi;
        $to = date("Y-m-d H:i:s",(strtotime($request->mulai."+".$jam."hours" ) ));
        // dd(Auth::user()->pegawai->nama);
        // $cancel = pinjam::join('detailpeminjamanruang as d ','d.id','=','peminjamanruang.dtpr_id')
        //     ->where('peminjamanruang.ruang_id', '=', $request->ruang_id)
        //     ->where(function ($query) {
        //     $query->where('peminjamanruang.status_id', '3');
        //     })    
        //     ->WhereBetween('d.mulai',[$from,$to])
        //     ->count();
        $cancel = DB::table('peminjamanruang as p')->join('detailpeminjamanruang as d','d.id','=','p.dtpr_id')
            ->where('p.ruang_id', '=', $request->ruang_id)
            ->where(function ($query) {
            $query->where('p.status_id', '3');
            })    
            ->WhereBetween('d.mulai',[$from,$to])
            ->count();

            $cancel2 = pinjam::join('detailpeminjamanruang as d','d.id','=','peminjamanruang.dtpr_id')
            ->where('peminjamanruang.ruang_id', '=', $request->ruang_id)
            ->where(function ($query) {
            $query->where('peminjamanruang.status_id', '3');
                        // ->orWhere('status','proses');
            })       
            ->WhereBetween('d.selesai',[$from,$to])
            ->count();

               if ($cancel >=1 or $cancel2>=1) {
                 return back()->with(['error' => 'Jadwal ruangan sudah terisi!']);
                  }   else if($cancel == 0 or $cancel2 == 0 or $cancel == false or $cancel2 == false) {
                    $idp = penanggungjawab::join('pegawais','pegawais.nip_baru','=','penanggungjawab.pegawai_nip')->where('pegawais.nama','=', $request->penanggung_jawab)->get();
                    // dd($idp);
            foreach($idp as $val){
            
            pinjam::where('id', $id)
            ->update(array(
            // 'namakeg' => $request->namakeg,
            'ruang_id' => $request->ruang_id,
            // 'mulai' => $request->mulai,
            // 'selesai' => date("Y-m-d\TH:i",(strtotime($request->mulai."+".$request->durasi."hours" ) )),
            'penanggungjawab_id' => $val->id,
            'status_id' => '3'
            // 'approvedby'=>Auth::user()->pegawai->nama,
            // 'alasan'=>$request->alasan,

        ));
        $idd = pinjam::select('dtpr_id')->where('id',$id)->get();
        foreach($idd as $key){
        $app = Auth::user()->pegawai->nama;
         
       DB::table('detailpeminjamanruang')
        ->where('id',$key->dtpr_id)
        ->update(['namakeg'=>$request->namakeg,
                  'mulai'=>$request->mulai,
                  'selesai'=>date("Y-m-d\TH:i",(strtotime($request->mulai."+".$request->durasi."hours" ) )),
                  'approvedby'=>$app,
                  'alasan'=>$request->alasan
        ]);
      
       
    }
    }
        // $id->update([
        //     'status'=> 'setuju',
        //     'approvedby'=>Auth::user()->pegawai->nama
        // ]);
        // dd($request->alasan);
        return back()->with(['success' => 'Data Berhasil Diubah!']);
        }
    }
    public function tolak(Request $request, $id)
    {
        $this->validate($request, [
            'alasan' => 'required',
        ]);
        pinjam::where('id', $request->pinjam_tolak_id)->update(array('status_id' => '4'));
        $idd = pinjam::select('dtpr_id')->where('id',$id)->get();
        foreach($idd as $key){
            $pp= Auth::user()->pegawai->nama;
            $dtpr = detailpeminjamanruang::where('id',$key->dtpr_id)->first();
            //  dd($key->dtpr_id);
            $dtpr->approvedby =$pp;
            $dtpr->alasan=$request->alasan;
            $dtpr->save();
            // update(array('approvedby'=>Auth::user()->pegawai->nama,'alasan'=>$request->alasan));
        }
        
        // dd($id);
        // $id->update([
        //     'status'=> 'tolak',
        //     'approvedby'=>Auth::user()->pegawai->nama
        // ]);
        return back()->with(['success' => 'Data Berhasil Diubah!']);
    }
    public function ajukan(Pinjam $pinjam)
    {
        // $pinjam = Pinjam::select('id','namakeg','ruang_id','user_id','mulai','selesai','penanggungjawab')->where('id', '=', $id);
       $user=User::all();
        $ruang=ruang::all();
        return view('pinjam.ajukan', compact('pinjam','user','ruang'));
        
    }
    public function ajukankembali(Request $request , $id)
    {
        $this->validate($request, [
            'namakeg' => 'required',            
            'ruang_id'   => 'required',
            'mulai'   => 'required',
            'durasi'   => 'required',
            'penanggung_jawab'   => 'required',
           
        ]);
        $ajukan = DB::table('peminjamanruang')
                    ->select('namakeg','user_id','ruang_id','mulai','selesai','penanggungjawab')
                    ->where('id','=',$id)->get();
        foreach ($ajukan as $p) {

            $jam = ($request->durasi);
        $mengajukan = pinjam::where('parent_id','=',$id)->first();
            if($mengajukan)
            {
                return back()->with(['error' => 'Sudah pernah diajukan ']);
            }
            elseif(!$mengajukan)
            {
                if ($p->namakeg == $request->nama_kegiatan and $p->ruang_id == $request->ruang_id and $p->mulai == $request->mulai and $p->selesai == date("Y-m-d\TH:i", (strtotime($request->mulai . "+" . $jam . "hours"))) and $p->penanggungjawab == $request->penanggung_jawab) {
                    return back()->with(['error' => 'Harap isian dirubah terlebih dahulu!!! ']);
                } elseif ($p->namakeg !== $request->nama_kegiatan or $p->ruang_id !== $request->ruang_id or $p->mulai !== $request->mulai or $p->selesai !== date("Y-m-d\TH:i", (strtotime($request->mulai . "+" . $jam . "hours"))) or $p->penanggungjawab !== $request->penanggung_jawab) {
                    Pinjam::create([
                        'namakeg' => $request->namakeg,
                        'user_id' => Auth::user()->id,
                        'ruang_id' => $request->ruang_id,
                        'mulai' => $request->mulai,
                        'selesai' => date("Y-m-d\TH:i", (strtotime($request->mulai . "+" . $jam . "hours"))),
                        'parent_id' => $id,
                        'penanggungjawab' => $request->penanggung_jawab
                    ]);
                }
            }
       
    }
    
    return redirect()->route('pinjam.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
  

    
}
