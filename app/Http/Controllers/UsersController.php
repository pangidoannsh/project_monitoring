<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = Users::all();

        return view("users", [
            'section' => "Daftar Leader",
            "title" => "users",
            "users" => $users
        ]);
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
            "name" => "required",
            "email" => "required",
            "photo" => "image|file|required"
        ]);
        $file = $request->file('photo');
        if ($request->file('photo')) {
            $nameFile = date("YmdHis") . $file->getClientOriginalExtension();
            $file->move('img/photo-profile', $nameFile);
        }
        Users::create([
            "name" => $request->name,
            "email" => $request->email,
            "photo" => $nameFile
        ]);

        return redirect("users");
    }
    public function k(Request $request,   $ruangan)
    {
        //proses input data gedung
        $request->validate([
            'nama' => 'required',
            'kategori_ruangan_id' => 'required',
            'gedung_id' => 'required',
            'kapasitas' => 'required|numeric',
            'lantai' => 'required|numeric',
            'foto1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();
        //--------proses update data lama & upload file foto baru--------
        $image = $request->file('foto1');
        if (!empty($image)) //kondisi akan upload foto baru
        {
            if (!empty($ruangan->foto1)) { //kondisi ada nama file foto di tabel
                //hapus foto lama
                unlink('img/ruangan/' . $ruangan->foto1);
            }
            //proses upload foto baru
            $destinationPath = 'img/ruangan/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            //print_r($profileImage); die();
            $image->move($destinationPath, $profileImage);
            $input['foto1'] = "$profileImage";
        } else //kondisi user hanya update data saja, bukan ganti foto
        {
            $input['foto1'] = $ruangan->foto1; //nama file foto masih yg lama
        }

        $ruangan->update($input);

        return redirect()->route('ruangan.index')
            ->with('success', 'Ruangan updated successfully.');
    }
}
