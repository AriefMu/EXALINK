<?php

namespace App\Http\Controllers;

use App\Models\pegawai;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class penggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['q'] = $request->query('q');
        $data['title'] = 'Pengguna';
        // $user = User::select('user.id','user.pegawai_nip','pegawais.nama','user.role')
        //         ->join('pegawais','pegawais.nip','=','user.pegawai_nip')
        //         ->get();
        
        $query = User::with('pegawai')
        ->join('pegawais','pegawais.nip_baru','=','user.pegawai_nip')
        ->where(function ($query) use ($data) {
            $query->where('pegawai_nip', 'like', '%' . $data['q'] . '%');
            $query->orWhere('role', 'like', '%' . $data['q'] . '%');
            $query->orWhere('pegawais.nama', 'like', '%' . $data['q'] . '%');
            });
        $data['user'] = $query->Paginate(10)->withQueryString();
            return view ('pengguna.index',$data);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $user = User::all();
        $pegawai=pegawai::all()
                ->sortBy('nama');
    
        return view('pengguna.create',compact('user','pegawai'));
    }
    public function select2Pengguna(Request $request)
    {
        $pengguna = [];

        if($request->has('q')){
            $search = $request->q;
            $pengguna =pegawai::select("nip_baru", "nama")           
                    ->where('nama', 'LIKE', "%$search%")
                    ->orWhere('nip_baru', 'LIKE', "%$search%")
                    ->get();
        }
        return response()->json($pengguna);
    }
    public function select2Pengguna2(Request $request)
    {
        $pengguna = [];

        if($request->has('q')){
            $search = $request->q;
            $pengguna =pegawai::select("nip_baru", "nama")           
                    ->where('nama', 'LIKE', "%$search%")
                    ->orWhere('nip_baru', 'LIKE', "%$search%")
                    ->get();
        }
        return response()->json($pengguna);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'username' => 'required|unique:user',
            'password' => 'required',
            'role'=>'required',
            'imgprofil'=>''
        ]);
        $idp= DB::table('pegawais')
            ->select('nip_baru')
            ->where('nama',$request->nip)
            ->get();
            foreach ($idp as $p) {
        $user = new User([
            'pegawai_nip' => $p->nip_baru,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role'=> $request->role,
            'imgprofil'=>$request->imgprofil
        ]);
    }
        $user->save();
        return redirect()->route('pengguna.index')->with(['success' => 'Data berhasil diinput']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('pengguna.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }
    public function update(Request $request,$id)
    {
        //validate form
        $this->validate($request, [
            
            'nip'=> 'required',
            'role'=> 'required'
        ]);
        $input = $request->all();
       
        
        $user = User::find($id);
        $user->update($input);
       
            $user->update([
                'pegawai_nip'=> $request->nip,
                'role'=> $request->role
            ]);
        

        //redirect to index
        return redirect()->route('pengguna.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user,$id)
    {
        DB::table("user")->where('id',$id)->delete();

        //redirect to index
        return redirect()->route('pengguna.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
    public function updpg()
    {
        $awal = User::count();
       
        $pengguna= User::select('pegawai_nip')->count();
        // dd($pengguna);
        $pegawai = DB::table('pegawais')
            ->select('nip_baru','tgl_lahir')
            ->whereNotIn('nip_baru',User::select('pegawai_nip'))
            
            ->get();
            // $berapa =  DB::table('pegawais')
            // ->select('nip_baru','tgl_lahir')
            // ->whereNotIn('nip_baru', [199503022018011001])
            // ->limit(2)
            // ->count();
        // for ($i = 0;$i < ;$i--  ){
            
                # code...
        // dd($pegawai);
            foreach($pegawai as $row){
           
         
            $user = new User([
                'pegawai_nip' => $row->nip_baru,
                'username' => $row->nip_baru,
                'password' => Hash::make(Carbon::createFromFormat('Y-m-d',$row->tgl_lahir)->format('dmY')),
                'role'=> 'user',
                
                
            ]);
            $user->save();
       
        // }
    }
           
        $akhir = User::count();
        $total = $akhir - $awal;
            return redirect()->route('pengguna.index')->with(['success' => $total .' Data berhasil diinput']);
        
    }
}
