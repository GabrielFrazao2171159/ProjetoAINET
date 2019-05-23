<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UtilizadorController extends Controller
{
	public function index(Request $request){
        /*
        if(!is_null($request->num_socio)){
            $socios=User::where('num_socio',$request->num_socio)->paginate(15);
        }else{
            $socios=User::paginate(15);   
        }*/
        $user = User::find(Auth::id());
        if ($user->can('verAtivos', User::class)) {
            $socios=User::paginate(15);
        }else{
            $socios=User::where('ativo',1)->paginate(15); 
        }

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
		if(empty($request->ativo)){
            $socio['ativo']=0;
        }else{
            $socio['ativo']=1;
        }

        if(empty($request->ativo)){
            $socio['direcao']=0;
        }else{
            $socio['direcao']=1;
        }

        if(empty($request->ativo)){
            $socio['quota_paga']=0;
        }else{
            $socio['quota_paga']=1;
        }
        // $socio->image = $name;
		$socio['password']=password_hash($socio['data_nascimento'],PASSWORD_DEFAULT);
		$user=User::create($socio);
//        dd($user);

        $user->SendEmailVerificationNotification();
//        dd($user);

        return redirect()->route('socios.index')->with('sucesso', 'Sócio inserido com sucesso!');
	}

    public function reenviarEmail(User $socio)
    {
        $socio->SendEmailVerificationNotification();
        return redirect()->back();
            //->route('socios.edit', $socio)->with('sucesso', 'Email reenviado com sucesso!');
	}

    public function quotas(User $socio)
    {
        if ($socio->quota_paga == 0){
            $socio->quota_paga = 1;
        }else{
            $socio->quota_paga = 0;
        }
        $socio->save();
        return redirect()->route('socios.index')->with('sucesso', 'Quota alterada com sucesso!');
    }

    public function reset_quotas()
    {
        DB::update("update users set quota_paga=0");
        return redirect()->route('socios.index')->with('sucesso', 'Todas as quotas ficaram por pagar!');
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
        dd($request);
        //$socio->image = $name;
       //dd($socio);
        $socio->save();

        return redirect()->route('socios.index')->with('sucesso', 'Sócio editado com sucesso!');
	}

	public function destroy(User $socio){
        $movimentos = $socio->movimentos;

        if(count($movimentos)==0){
            $socio->forceDelete();
        }else{
            $socio->delete();
        }
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

		$array = array('password' => password_hash($request->password, PASSWORD_DEFAULT));

		if($socio->password_inicial == 1){
			$socio->password_inicial = 0;
		}

		$socio->fill($array);
		$socio->save();

		return redirect()->route('socios.index')->with('sucesso', 'Palavra-passe alterada com sucesso!');
	}
}
