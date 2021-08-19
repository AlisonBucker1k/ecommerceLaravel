<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = User::query();
        $filters = $this->filters($query, $request);

        $data['users'] = $query->orderBy('users.name', 'asc')->paginate(20);
        $data['filters'] = $request->all();
        $data['breadcrumb'] = [
            'Usuários' => route('users')
        ];

        $data['statusActive'] = UserStatus::ACTIVE;

        return view('admin.user.index', $data);
    }

    /**
     * @param  Builder $query
     * @param  Request $request
     * @return array
     */
    private function filters(Builder $query, Request $request)
    {
        $filters = [];

        if (!empty($request->email)) {
            $query->whereEmail($request->email);
        }
        
        if (!empty($request->name)) {
            $query->where(DB::raw('users.name'), 'like' , '%' . $request->name . '%');
        }

        return $filters;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Novo Usuário';

        return view('admin.user.form', $data);
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
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed'
        ]);

        $user = new User();
        $user->fill($request->all());
        $user->password = bcrypt($request->password);
        $user->status = UserStatus::ACTIVE;
        $user->save();

        return redirect()->route('users')->withSuccess('Usuário adicionado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $data['user'] = $user;
        $data['title'] = 'Editar Usuário';
        $data['breadcrumb'] = [
            'Usuários' => route('users'),
            'Editar' => route('user.edit', $user->id)
        ];

        return view('admin.user.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'confirmed'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if (!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }

        $user->update();

        return redirect()->route('users')->withSuccess('Usuário editado com sucesso!');
    }

    /**
     * Disable the specified resource from storage.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function disable(User $user)
    {
        if ($user->status == UserStatus::INACTIVE) {
            return redirect()->route('users')->withErrors('Usuário já está inativo.');
        }

        $user->status = UserStatus::INACTIVE;
        $user->update();

        return redirect()->route('users')->withSuccess('Usuário desativado com sucesso!');
    }

    /**
     * Active the specified resource from storage.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function active(User $user)
    {
        if ($user->status == UserStatus::ACTIVE) {
            return redirect()->route('users')->withErrors('Usuário já está ativo.');
        }

        $user->status = UserStatus::ACTIVE;
        $user->update();

        return redirect()->route('users')->withSuccess('Usuário ativado com sucesso!');
    }
}