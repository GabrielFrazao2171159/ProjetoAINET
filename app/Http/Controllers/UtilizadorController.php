<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\StoreUpdateUserRequest;

//Verificação do mail
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Support\Facades\Mail;

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
		/*
        $image = $request->file('image');
        $name = time().'.'.$image->getClientOriginalExtension();

        $path = $request->file('image')->storeAs('/fotos', $name);
        */

		$socio = $request->validated();
        //$socio->image = $name;
dd($socio);
		Mail::to($socio['email'])->send(new VerifyMail($socio));
        dd($socio);
		User::create($socio);
		return redirect()->route('socios.index')->with('sucesso', 'Utilizador inserida com sucesso!');
	}

	public function edit(User $socio){
		return view('socios.edit',compact('socio'));
	}

	public function myPerfil(){
		$socio=Auth::id();
		return view('socios.myperfil',compact('socio'));
	}

	public function update(StoreUpdateUserRequest $request, User $socio){
    	if(! is_null($request['image'])) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();

            $path = $request->file('image')->storeAs('/fotos', $name);
        }

        $socio->fill($request->validated());
        $socio->image = $name;
        $socio->save();

        return redirect()->route('socios.index')->with('sucesso', 'Utilzador editado com sucesso!');;
	}

	public function destroy(User $socio){
        $socio->delete();
		return redirect()->route('socios.index')->with('sucesso', 'Utilzador eliminado com sucesso!');
	}
}
