<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuario = User::all();
        return view('welcome')->with('usuarios', $usuario);
    }
    
}
