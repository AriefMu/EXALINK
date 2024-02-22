<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lantai;


class LantaiController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'lantai';
        $data['q'] = $request->query('q');
        $query = lantai::orderBy('updated_at','desc')
            ->where(function ($query) use ($data) {
            $query->where('nama', 'like', '%' . $data['q'] . '%');
            });
            $data['lantai'] = $query->paginate(10)->withQueryString();
            return view('lantai.index', $data);
    }
    public function create()
    {
        return view('lantai.create');
    }
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            
            'nama'     => 'required',
           
        ]);

        //upload image
        
        //create ruang
        lantai::create([
            
            'nama'     => $request->nama,
           
        ]);

        //redirect to index
        return redirect()->route('lantai.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    public function edit(ruang $ruang)
    {
        return view('lantai.edit', compact('ruang'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $ruang
     * @return void
     */
    public function update(Request $request, lantai $lantai)
    {
        //validate form
        $this->validate($request, [
            
            'nama'=> 'required',
           
        ]);

        //check if image is uploaded
        

            //update ruang without image
            $lantai->update([
                'nama'=> $request->nama,
                
            ]);
        

        //redirect to index
        return redirect()->route('lantai.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    public function destroy(lantai $lantai)
    {
        //delete image
        

        //delete post
        $lantai->delete();

        //redirect to index
        return redirect()->route('lantai.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
