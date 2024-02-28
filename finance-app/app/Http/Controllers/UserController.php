<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::where('role', 'client')->get();
        return $user;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'cpf' => 'required|string|unique:users,cpf',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',

        ]);
        $user = User::create([
            'name' => $request->name,
            'cpf' => $request->cpf,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'client'
        ]);
        return $user;
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string',
            'cpf' => 'required|string|unique:users,cpf',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
        $user->update([
            'name' => $request->name,
            'cpf' => $request->cpf,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return ['msg' => 'Usuário deletado com sucesso'];
    }
}
