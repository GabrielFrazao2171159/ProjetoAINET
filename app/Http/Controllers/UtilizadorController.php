<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\StoreUpdateUserRequest;

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
//        $image = $request->file('image');
//        $name = time().'.'.$image->getClientOriginalExtension();
//
//        $path = $request->file('image')->storeAs('/fotos', $name);
        //dd($request);
		$socio = $request->validated();
       // $socio->image = $name;

		User::create($socio);
		return redirect()->route('socios.index')->with('sucesso', 'Sócio inserido com sucesso!');
	}

	public function edit(User $socio){
		return view('socios.edit',compact('socio'));
	}

	public function myPerfil(){
		$socio=Auth::id();
		return view('socios.myperfil',compact('socio'));
	}

	public function update(StoreUpdateUserRequest $request, User $socio){
//    	if(! is_null($request['image'])) {
//            $image = $request->file('image');
//            $name = time().'.'.$image->getClientOriginalExtension();
//
//            $path = $request->file('image')->storeAs('/fotos', $name);
//        }

        $socio->fill($request->validated());
        //$socio->image = $name;
        $socio->save();

        return redirect()->route('socios.index')->with('sucesso', 'Sócio editado com sucesso!');;
	}

	public function destroy(User $socio){
        $socio->delete();
		return redirect()->route('socios.index')->with('sucesso', 'Sócio eliminado com sucesso!');
	}
}
