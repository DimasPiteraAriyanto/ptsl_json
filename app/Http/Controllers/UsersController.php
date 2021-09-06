<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Proyek;
use App\Models\Desa;
use Illuminate\Http\Request;
use Redirect, Response;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $desa = Desa::all();
        $proyek = Proyek::all();
        $user = User::all();
        return view('auths.users.index', compact('proyek', 'desa', 'user'));
    }

    public function json_user_index()
    {
        $data = User::all();

        $pengguna = array(
            1 => 'Administrator',
            2 => 'Petugas Yuridis',
            3 => 'Petugas Pengukuran',
            4 => 'Petugas Desa',
        );

        $users = array();
        foreach ($data as $user) {
            $users[] = array(
                'id' => $user->id,
                'proyek_id' => $user->proyek->nama_proyek,
                'desa_id' => $user->desa->nama_desa,
                'username' => $user->username,
                'nama_lengkap' => $user->nama_lengkap,
                'level' => $pengguna[$user->level],
            );
        }

        return Datatables::of($users)->make(true);
    }

    public function json_user_edit(Request $request)
    {
        $user = User::find($request->id);
        return response()->json($user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->proyek_id = $request->proyek_id;
        $user->desa_id = $request->desa_id;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->nama_lengkap = $request->nama_lengkap;
        $user->level = $request->level;
        $user->save();
        return response()->json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (empty($request->password)) {
            $user = User::find($id);
            $user->proyek_id = $request->proyek_id;
            $user->desa_id = $request->desa_id;
            $user->username = $request->username;
            $user->nama_lengkap = $request->nama_lengkap;
            $user->level = $request->level;
            $user->update();
        } else {
            $user = User::find($id);
            $user->proyek_id = $request->proyek_id;
            $user->desa_id = $request->desa_id;
            $user->username = $request->username;
            $user->password = bcrypt($request->password);
            $user->nama_lengkap = $request->nama_lengkap;
            $user->level = $request->level;
            $user->update();
        }

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
    }
}
