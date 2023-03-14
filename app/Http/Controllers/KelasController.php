<?php
namespace App\Http\Controllers;
use App\Models\kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class KelasController extends Controller
{
    public function getkelas()
    {
        $dt_kelas=kelas::get();
        return response()->json($dt_kelas);
        // return view('welcome');
    }
    public function getsemuakelas($id){
        $kelas = kelas::where('id_kelas','=',$id)->get();
        return response()->json($kelas);
    }
    public function createkelas(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'nama_kelas'=>'required',
            
   ]);
   if($validator->fails()){
    return Response()->json($validator->errors()->toJson());
    
   }
   $save = kelas::create([
    'nama_kelas' =>$req->get('nama_kelas'),
    
   ]);
   if($save){
    return Response()->json(['status'=>true, 'message' =>'Sukses Menambah Kelas']);
   } else {
    return Response()->json(['status'=>false, 'message' =>'Gagal Menambah Kelas']);
   
    }
}


    public function updatekelas(Request $req, $id)
    {
        $validator = Validator::make($req->all(),[
            'nama_kelas'=>'required',
            
   ]);
   if($validator->fails()){
    return Response()->json($validator->errors()->toJson());
    
   }
   $ubah = kelas::where('id_kelas',$id)->update([
    'nama_kelas' =>$req->get('nama_kelas'),
    
   ]);
   if($ubah){
    return Response()->json(['status'=>true, 'message' =>'Sukses Update Kelas']);
   } else {
    return Response()->json(['status'=>false, 'message' =>'Gagal Update Kelas']);
   
    }
}

public function deletekelas($id)
{
    $hapus=Kelas::where('id_kelas',$id)->delete();
    if($hapus){
        return Response()->json(['status'=>true, 'message' =>'Sukses Delete Kelas']);
   } else {
    return Response()->json(['status'=>false, 'message' =>'Gagal Delete Kelas']);
   
    }
    }
}


