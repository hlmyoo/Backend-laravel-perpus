<?php
namespace App\Http\Controllers;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class PeminjamanController extends Controller
{
    public function getpeminjaman($id)
    {
        $dt_peminjaman=peminjaman::
        where('id_peminjaman',$id)
        // ->select('nama_siswa','nama_kelas','judul_buku','pengarang','tgl_pinjam','tgl_kembali','status')
        ->join('siswa','siswa.id_siswa','=','peminjaman.id_siswa')
        ->join('kelas','kelas.id_kelas','=','peminjaman.id_kelas')
        ->join('buku','buku.id_buku','=','peminjaman.id_buku')
        ->get();
        return response()->json($dt_peminjaman);
        // return view('welcome');
    }
    public function getsemuapeminjaman()
    {
        $dt_peminjaman=peminjaman::
        
        // select('nama_siswa','nama_kelas','judul_buku','pengarang','tgl_pinjam','tgl_kembali','status')
        join('siswa','siswa.id_siswa','=','peminjaman.id_siswa')
        ->join('kelas','kelas.id_kelas','=','peminjaman.id_kelas')
        ->join('buku','buku.id_buku','=','peminjaman.id_buku')
        ->orderBy('id_peminjaman','desc')
        ->get();
        return response()->json($dt_peminjaman);
        // return view('welcome');
    }

    


    public function createpeminjaman(Request $req)
    {    
        $validator = Validator::make($req->all(),[
            
            'id_siswa'=>'required',
            'id_kelas'=>'required',
            'id_buku'=>'required',
            
            
   ]);
   if($validator->fails()){
    return Response()->json($validator->errors()->toJson());
    
   }
   $kembali = carbon::now()->addDays(5);
   $pinjam = carbon::now();
   $save = peminjaman::create([
    
    'id_siswa' =>$req->input('id_siswa'),
    'id_kelas' =>$req->input('id_kelas'),
    'id_buku' =>$req->input('id_buku'),
    'tgl_pinjam' => $pinjam,
    'tgl_kembali' => $kembali,
    'status' => 'Dipinjam',
    
   ]);
   if($save){
    return Response()->json(['status'=>true, 'message' =>'Sukses Menambah Peminjaman']);
   } 
   else {
    return Response()->json(['status'=>false, 'message' =>'Gagal Menambah Peminjaman']);
   
    }
}
public function kembalipeminjaman ($id){
    
    $kembali = peminjaman::where('id_peminjaman', $id)
    ->update([
    'status' => 'Kembali',
]);
       if($kembali){
        return Response()->json(['status'=>true, 'message' =>'Sukses Update Peminjaman']);
       } 
       else {
        return Response()->json(['status'=>false, 'message' =>'Gagal Update Peminjaman']);
       
        }

}
public function updatepeminjaman(Request $req, $id)
    {
        $validator = Validator::make($req->all(),[
           
   ]);
   if($validator->fails()){
    return Response()->json($validator->errors()->toJson());
    
   }
   $ubah = peminjaman::where('id_peminjaman',$id)->update([
    
    'id_siswa' =>$req->get('id_siswa'),
    'id_kelas' =>$req->get('id_kelas'),
    'id_buku' =>$req->get('id_buku'),
    'status' =>$req->get('status'),
    
   ]);
   if($ubah){
    return Response()->json(['status'=>true, 'message' =>'Sukses Update Peminjaman']);
   } else {
    return Response()->json(['status'=>false, 'message' =>'Gagal Update Peminjaman']);
   
    }
}

public function deletepeminjaman($id)
{
    $hapus=Peminjaman::where('id_peminjaman',$id)->delete();
    if($hapus){
        return Response() ->json(['status'=>true, 'message' =>'Sukses Delete Peminjaman']);
   } else {
    return Response()->json(['status'=>false, 'message' =>'Gagal Delete Peminjaman']);
   
    }
    }

}



