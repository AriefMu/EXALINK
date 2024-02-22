<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penanggungjawab;
use App\Models\pegawai;
use Illuminate\Support\Facades\DB;

class PenanggungjawabController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'penanggungjawab';
        $data['q'] = $request->query('q');
        $query = DB::table('penanggungjawab as p')->select('p.id as id','p.pegawai_nip as nip','w.nama')->join('pegawais as w','nip_baru','=','p.pegawai_nip')->orderBy('updated_at','desc')
            ->where(function ($query) use ($data) {
            $query->where('w.nama', 'like', '%' . $data['q'] . '%');
            $query->orWhere('p.pegawai_nip', 'like', '%' . $data['q'] . '%');
            });
            $data['penjaw'] = $query->paginate(15)->withQueryString();
            return view('penanggungjawab.index', $data);
    }
    public function create()
    {
        return view('penanggungjawab.create');
    }
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            
            'nama'     => 'required',
           
        ]);

        //upload image
        $idp= DB::table('pegawais')
            ->select('nip_baru')
            ->where('nama',$request->nama)
            ->get();

            foreach ($idp as $p) {
            // $idpp = implode(' ',$idp);
            
        //create penanggungjawab
        penanggungjawab::create([
            
            'pegawai_nip'     => $p->nip_baru,
           
        ]);
    }
        //redirect to index
        return redirect()->route('penanggungjawab.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    public function edit(penanggungjawab $penanggungjawab)
    {
        return view('penanggungjawab.edit', compact('penanggungjawab'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $penanggungjawab
     * @return void
     */
    public function update(Request $request, penanggungjawab $penanggungjawab)
    {
        //validate form
        $this->validate($request, [
            
            'nama'=> 'required',
            'lantai'=> 'required'
        ]);

        //check if image is uploaded
        

            //update penanggungjawab without image
            $penanggungjawab->update([
                'nama'=> $request->nama,
                'lantai'=> $request->lantai
            ]);
        

        //redirect to index
        return redirect()->route('penanggungjawab.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    public function destroy(penanggungjawab $penanggungjawab)
    {
        //delete image
        

        //delete post
        $penanggungjawab->delete();

        //redirect to index
        return redirect()->route('penanggungjawab.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
    public function select2Search(Request $request)
    {
        $pinjam = [];

        if($request->has('q')){
            $search = $request->q;
            $pinjam =pegawai::select("nip_baru", "nama")           
                    ->where('nama', 'LIKE', "%$search%")
                    ->orWhere('nip_baru', 'LIKE', "%$search%")
                    ->get();
        }
        return response()->json($pinjam);
    }
}
