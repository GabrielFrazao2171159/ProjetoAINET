<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UtilizadorController extends Controller
{
	public function index(){
		$utilizadores=User::all();
		return view('utilizadores.index',compact('utilizadores'));
	}

	public function create(){
		$utilizadores = new User();
		return view('utilizadores.create',compact('utilizadores'));
	}

	public function store(Request $request){
		dd($request);
	}

	public function edit(User $utilizador){
		return view('utilizadores.edit',compact('utilizador'));
	}

	public function update(Request $request, User $utilizador){
		dd($request);
	}

	public function destroy(User $utilizador){
		dd($utilizador);
	}

}
