<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    public function edit()
    {
        $data['breadcrumb'] = [
            'Meus Dados' => route('account.edit')
        ];

        return view('admin.user.edit', $data);
    }

    public function update(Request $request)
    {
        $user = \auth()->user();
        $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($user)
            ]
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return back()->withSuccess('Dados alterados com sucesso!');
    }

    public function editPassword()
    {
        $data['breadcrumb'] = [
            'Alterar Senha' => route('password.edit')
        ];

        return view('admin.user.edit_password', $data);
    }

    public function updatePassword(Request $request)
    {
        $user = \auth()->user();
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:3|different:old_password'
        ]);

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors('Senha antiga incorreta.');
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return back()->withSuccess('Senha alterada com sucesso!');
    }
}
