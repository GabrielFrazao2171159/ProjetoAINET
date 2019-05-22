<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
		$socio = $request->validated();
       // $socio->image = $name;
		$socio['password']=$socio['data_nascimento'];
		$user=User::create($socio);
		$user->SendEmailVerificationNotification();
        
		return redirect()->route('socios.index')->with('sucesso', 'Sócio inserido com sucesso!');
	}

    public function reenviarEmail()
    {
        $id=\request('reenviarID');
        $user=User::find($id);
        $user->SendEmailVerificationNotification();
        return redirect()->route('socios.edit')->with('sucesso', 'Email reenviado com sucesso!');
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

        return redirect()->route('socios.index')->with('sucesso', 'Sócio editado com sucesso!');
	}

	public function destroy(User $socio){
        $socio->delete();
		return redirect()->route('socios.index')->with('sucesso', 'Sócio eliminado com sucesso!');
	}

	public function editPassword(){
		return view('socios.editPassword');
	}

	public function updatePassword(UpdatePasswordRequest $request){
		$socio = User::find(Auth::id());

		if(!(Hash::check($request->old_password, $socio->password))){
			return back()->withErrors(array('old_password' 
				=> 'O campo palavra-passe antiga deve coincidir com a atual.'));
		}

		$socio->fill(['password' => password_hash($request->password, PASSWORD_DEFAULT)]);
		$socio->save();

		return redirect()->route('socios.index')->with('sucesso', 'Palavra-passe alterada com sucesso!');
	}
}
