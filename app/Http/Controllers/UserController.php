<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUser;
use App\Http\Requests\EditUser;
use App\Http\Requests\profile;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Barryvdh\DomPDF\Facade as PDF;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::paginate(5);

        return view('users.index', compact('user'));
    }

    public function userData()
    {
        return Datatables()
                ->eloquent(User::query())
                ->addColumn('btn', 'users.actions')
                ->rawColumns(['btn'])
                ->make(true);
    }

    public function reportes()
    {
        $user = User::all();

        $pdf = PDF::loadView('pdfs.reporte-users', compact('user'));

        return $pdf->download('reporte-users.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUser $request)
    {

        User::create([
            'cedula' => $request['cedula'],
            'name' => $request['nombre'],
            'apellido_pater' => $request['apellido_paterno'],
            'apellido_mater' => $request['apellido_materno'],
            'direc' => $request['direccion'],
            'tlf' => $request['telefono'],
            'email' => $request['email'],
            'password' => Hash::make($request['contraseña']),
        ]);

        return redirect()->route('users.index')
                ->with('info', 'Funcionario creado con exito');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        $id = Hashids::decode($user);
        $user = User::findOrfail($id)->first();
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        $id = Hashids::decode($user);
        $user = User::findOrfail($id)->first();
        $roles = Role::get();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(EditUser $request, $id)
    {
        $users = User::findOrFail($id);

        $users->direc = $request->direccion;
        $users->tlf = $request->telefono;

        $users->save();

        //actualiza roles de ese usuario
        $users->roles()->sync($request->get('roles'));

        if ($request->get('roles') == 1) {
            return redirect()->route('users.show', Hashids::encode($id))
                    ->with('info', 'Administrador actualizado con exito');
        }else{
            return redirect()->route('users.show', Hashids::encode($id))
                    ->with('info', 'Funcionario actualizado con exito');
        }
    }

    public function updateProfile($user)
    {
        $id = Hashids::decode($user);
        $user = User::findOrfail($id)->first();
        return view('users.profile', compact('user'));
    }

    public function updatePass(profile $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->newPassword) {

            if (Hash::check($request->oldPassword, $user->password)) {

                if ($request->newPassword2 == $request->newPassword) {

                    $request->user()->fill([
                        'password' => Hash::make($request->newPassword)
                    ])->save();

                    if ($request->hasFile('foto')) {
                        $image = $request->foto->store('public');
                        $user->path = $image;
                        $user->save();
                    }

                    return redirect()->route('home')->with('info', 'Perfil actualizado');

                } else {
                    return back()->with('danger', 'La contraseña nueva no coincide con la confirmacion');
                }

            } else {
                return back()->with('danger', 'La contraseña actual no coincide');
            }

        } else {

            if ($request->hasFile('foto')) {
                $image = $request->foto->store('public');
                $user->path = $image;
                $user->save();

                return redirect()->route('home')->with('info', 'Foto de perfil actualizada');
            }

            return redirect()->route('home')->with('info', 'No se realizaron cambios en el perfil');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
    }
}
