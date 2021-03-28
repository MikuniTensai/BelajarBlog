<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class ArtikelController extends Controller
{
    public function index(){
        $artikel = Artikel::all();

        return view('admin.artikel.artikel', compact('artikel'));
    }

    public function create(Request $request){ 
        $filetype  = '|file|image|mimes:jpeg,png,jpg|max:2048';
        $filename  = $request->file('gambar');
        $nama_file = time()."_".$filename->getClientOriginalName();
        $fileloc   = '../public/uploads/image/artikel/';
        $filename->move($fileloc,$nama_file);

        Artikel::create([
            'judul'    => $request->judul,
            'artikel'  => $request->artikel,
            'gambar'   => $nama_file,
        ]);

        Alert::success('Success', 'Artikel berhasil dibuat');
        return redirect()->back();
    }

    public function delete($id){
        $file = Artikel::where('id', $id)->first();
        File::delete(public_path('/uploads/image/artikel/').$file->gambar);
        
        Artikel::where('id', $id)->delete();

        Alert::warning('Warning', 'Data anda telah dihapus');
        return redirect()->back();
    }

    public function update($id){
        $artikel['artikel'] = Artikel::find($id);

        return view('admin.artikel.update', $artikel);
    }

    public function aksi_update(Request $request, $id){
        $file = Artikel::select('gambar')->where('id', $id)->first();
        File::delete(public_path('/uploads/image/artikel/').$file->gambar);

        $filetype = '|file|image|mimes:jpeg,png,jpg|max:2048';
        $filename = $request->file('gambar');
        $nama_file = time()."_".$filename->getClientOriginalName();
        $fileloc   = '../public/uploads/image/artikel/';
        $filename->move($fileloc,$nama_file);

        DB::table('article')->where('id', $id)->update([
            'judul'       => $request->judul,
            'artikel'     => $request->artikel,
            'gambar'      => $nama_file
        ]);

        Alert::success('Success', 'Artikel berhasil diupdate');
        return redirect()->route('artikel');
    }
}
