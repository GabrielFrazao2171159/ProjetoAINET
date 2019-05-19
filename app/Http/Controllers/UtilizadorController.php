<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\StoreAddUserRequest;
use App\Http\Requests\StoreUpdateUserRequest;


//Verificação do mail
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyMail;

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

	public function store(StoreUserRequest $request){
//        $image = $request->file('image');
//        $name = time().'.'.$image->getClientOriginalExtension();
//
//        $path = $request->file('image')->storeAs('/fotos', $name);
        //dd($request);
		$socio = $request->validated();
       // $socio->image = $name;
		$socio['password']=$socio['data_nascimento'];
		$user=User::create($socio);
		$user->SendEmailVerificationNotification();
        
		return redirect()->route('socios.index')->with('sucesso', 'Sócio inserido com sucesso!');
	}

	public function edit(User $socio){
		return view('socios.edit',compact('socio'));
	}

	public function update(UpdateUserRequest $request, User $socio){
//    	if(! is_null($request['image'])) {
//            $image = $request->file('image');
//            $name = time().'.'.$image->getClientOriginalExtension();
//
//            $path = $request->file('image')->storeAs('/fotos', $name);
//        }

        $socio->fill($request->all());

        //$socio->image = $name;
       //dd($socio);
        $socio->save();

        return redirect()->route('socios.index')->with('sucesso', 'Sócio editado com sucesso!');;
	}

	public function destroy(User $socio){
        $socio->delete();
		return redirect()->route('socios.index')->with('sucesso', 'Sócio eliminado com sucesso!');
	}

	public function editPassword(){
		return view('socios.reset');
	}
}
