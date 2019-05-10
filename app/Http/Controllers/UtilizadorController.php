<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UtilizadorController extends Controller
{
	public function index(){
		$socios=User::paginate(15);
		return view('socios.index',compact('socios'));
	}

	public function create(){
		$socio = new User();
		return view('socios.create',compact('socio'));
	}

	public function store(StoreUpdateUserRequest $request){
		$socio = $request->validated();
		User::create($socio);
		return redirect()->route('socios.index')->with('sucesso', 'Utilzador inserida com sucesso!');
	}

	public function edit(User $socio){
		return view('socios.edit',compact('socio'));
	}

	public function update(StoreUpdateUserRequest $request, User $socio){
        $socio->fill($request->validated());
        $socio->save();

        return redirect()->route('socios.index')->with('sucesso', 'Utilzador editado com sucesso!');;
	}

	public function destroy(User $utilizador){
        $socio->delete();
		return redirect()->route('socios.index')->with('sucesso', 'Utilzador eliminado com sucesso!');
	}
}
