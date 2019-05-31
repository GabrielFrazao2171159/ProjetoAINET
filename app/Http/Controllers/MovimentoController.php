<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aeronave;
use App\Http\Requests\StoreMovimentoRequest;
use App\User;
use App\Movimento;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Filtros\QueryBuilder;

class MovimentoController extends Controller
{
    public function index(Request $request){
        $attr = array();

        if(!is_null($request->id)){
            $attr['id'] = (int)$request->id;
        }
        if(!is_null($request->aeronave)){
            $attr['aeronave'] = (string)$request->aeronave;
        }
        if(!is_null($request->piloto)){
            $attr['piloto_id'] = (int)$request->piloto;
        }
        if(!is_null($request->instrutor)){
            $attr['instrutor_id'] = (int)$request->instrutor;
        }
        if(!is_null($request->natureza)){
            $attr['natureza'] = (string)$request->natureza;
        }
        if(!is_null($request->confirmado)){
            $attr['confirmado'] = (int)$request->confirmado;
        }
        if(!is_null($request->data_inf)){
            $date = str_replace('/', '-', $request->data_inf);
            $attr['data_inf'] = (string)date("Y-m-d", strtotime($date));
        }
        if(!is_null($request->data_sup)){
            $date = str_replace('/', '-', $request->data_sup);
            $attr['data_sup'] = (string)date("Y-m-d", strtotime($date));
        }

        $user = User::find(Auth::id());
        if($user->can('filtrarMeusMovimentos', Movimento::class)){
            if(!is_null($request->meus_movimentos)){
                $attr['meus_movimentos'] = (int)$user->id;
            }
        }

		$movimentos = QueryBuilder::movimentos($attr);

		return view('movimentos.index',compact('movimentos'));
	}

	public function create(){

        $this->authorize('create', Movimento::class);

        $movimento = new Movimento();
		return view('movimentos.create',compact('movimento'));
	}

	public function store(StoreMovimentoRequest $request){

        $this->authorize('create', Movimento::class);

        $movimento = $request->validated();
        $piloto = User::find($movimento['piloto_id']);
        $aeronave = Aeronave::find($movimento['aeronave']);
        $instrutor = User::find($movimento['instrutor_id']);

        $movimento['confirmado'] = "0";
        $movimento['tempo_voo'] = ($movimento['conta_horas_fim']-$movimento['conta_horas_inicio'])*0.1;
        $tempovooHoras = $movimento['tempo_voo'];
        $movimento['preco_voo'] = $tempovooHoras*$aeronave->preco_hora;

        if($piloto->tipo_socio != "P"){
            return back()->withErrors(array('piloto_id' => 'O utilizador inserido tem de ser do tipo piloto.'));
        }

        if(Auth::user()->direcao == 1){
            $movimento['num_licenca_piloto'] = Auth::user()->num_licenca;
            $movimento['tipo_licenca_piloto'] = Auth::user()->tipo_licenca;
            $movimento['validade_licenca_piloto'] = Auth::user()->validade_licenca;
            $movimento['num_certificado_piloto'] = Auth::user()->num_certificado;
            $movimento['validade_certificado_piloto'] = Auth::user()->validade_certificado;
            $movimento['classe_certificado_piloto'] = Auth::user()->classe_certificado;
            if($movimento['natureza'] == "I") {
                if ($instrutor->instrutor != "1") {
                    return back()->withErrors(array('instrutor_id' => 'O utilizador inserido tem de ser instrutor.'));
                }
                $movimento['num_licenca_instrutor'] = $instrutor->num_licenca;
                $movimento['tipo_licenca_instrutor'] = $instrutor->tipo_licenca;
                $movimento['validade_licenca_instrutor'] = $instrutor->validade_licenca;
                $movimento['num_certificado_instrutor'] = $instrutor->num_certificado;
                $movimento['validade_certificado_instrutor'] = $instrutor->validade_certificado;
                $movimento['classe_certificado_instrutor'] = $instrutor->classe_certificado;
            }
        }
        else{
            if($movimento['natureza'] == "I") {

                $movimento['num_licenca_piloto'] = Auth::user()->num_licenca;
                $movimento['tipo_licenca_piloto'] = Auth::user()->tipo_licenca;
                $movimento['validade_licenca_piloto'] = Auth::user()->validade_licenca;
                $movimento['num_certificado_piloto'] = Auth::user()->num_certificado;
                $movimento['validade_certificado_piloto'] = Auth::user()->validade_certificado;
                $movimento['classe_certificado_piloto'] = Auth::user()->classe_certificado;

                if (($movimento['piloto_id'] != Auth::user()->id && $movimento['instrutor_id'] != Auth::user()->id)){
                    return back()->withErrors(array('instrutor_id' => 'O piloto ID ou o instrutor ID terão de pertencer ao ID do utilizador com login iniciado.'));
                }
                if($instrutor->instrutor != "1"){
                    return back()->withErrors(array('instrutor_id' => 'O utilizador inserido tem de ser instrutor.'));
                }
                $movimento['num_licenca_instrutor'] = $instrutor->num_licenca;
                $movimento['tipo_licenca_instrutor'] = $instrutor->tipo_licenca;
                $movimento['validade_licenca_instrutor'] = $instrutor->validade_licenca;
                $movimento['num_certificado_instrutor'] = $instrutor->num_certificado;
                $movimento['validade_certificado_instrutor'] = $instrutor->validade_certificado;
                $movimento['classe_certificado_instrutor'] = $instrutor->classe_certificado;
            }
            else{
                if($movimento['piloto_id'] != Auth::user()->id){
                    return back()->withErrors(array('piloto_id' => 'O ID do piloto terá de ser o mesmo do utilizador com login iniciado.'));
                }
                $movimento['num_licenca_piloto'] = Auth::user()->num_licenca;
                $movimento['tipo_licenca_piloto'] = Auth::user()->tipo_licenca;
                $movimento['validade_licenca_piloto'] = Auth::user()->validade_licenca;
                $movimento['num_certificado_piloto'] = Auth::user()->num_certificado;
                $movimento['validade_certificado_piloto'] = Auth::user()->validade_certificado;
                $movimento['classe_certificado_piloto'] = Auth::user()->classe_certificado;
            }
        }



        $movimentoCriado = Movimento::create($movimento);
        return redirect()->route('movimentos.index')->with('sucesso', 'Voo inserido com sucesso!');
    }

    public function destroy(Movimento $movimento){

        $this->authorize('delete', $movimento);

        $movimento->forceDelete();

        return redirect()->route('movimentos.index')->with('sucesso', 'Movimento eliminado com sucesso!');
    }

    public function edit(Movimento $movimento){

        $this->authorize('update', $movimento);

        return view('movimentos.edit',compact('movimento'));
    }

    public function update(StoreMovimentoRequest $request, Movimento $movimento){

        if(isset($request->confirmar)){
            $this->authorize('confimarVoo', Movimento::class);
            $movimento->confirmado = 1;
            $movimento->save();
            return redirect()->route('movimentos.index')->with('sucesso', 'Movimento confirmado com sucesso!');
        }

        $this->authorize('update', $movimento);

        $movimento->fill($request->all());

        $piloto = User::find($movimento['piloto_id']);
        $aeronave = Aeronave::find($movimento['aeronave']);

        $movimento['tempo_voo'] = ($movimento['conta_horas_fim']-$movimento['conta_horas_inicio'])*0.1;
        $tempovooHoras = $movimento['tempo_voo'];
        $movimento['preco_voo'] = $tempovooHoras*$aeronave->preco_hora;

        if(Auth::user()->direcao == 1){
            $movimento['num_licenca_piloto'] = Auth::user()->num_licenca;
            $movimento['tipo_licenca_piloto'] = Auth::user()->tipo_licenca;
            $movimento['validade_licenca_piloto'] = Auth::user()->validade_licenca;
            $movimento['num_certificado_piloto'] = Auth::user()->num_certificado;
            $movimento['validade_certificado_piloto'] = Auth::user()->validade_certificado;
            $movimento['classe_certificado_piloto'] = Auth::user()->classe_certificado;
            if($movimento['natureza'] == "I") {
                if ($instrutor->instrutor != "1") {
                    return back()->withErrors(array('instrutor_id' => 'O utilizador inserido tem de ser instrutor.'));
                }
                $movimento['num_licenca_instrutor'] = $instrutor->num_licenca;
                $movimento['tipo_licenca_instrutor'] = $instrutor->tipo_licenca;
                $movimento['validade_licenca_instrutor'] = $instrutor->validade_licenca;
                $movimento['num_certificado_instrutor'] = $instrutor->num_certificado;
                $movimento['validade_certificado_instrutor'] = $instrutor->validade_certificado;
                $movimento['classe_certificado_instrutor'] = $instrutor->classe_certificado;
            }
        }
        else{
            if($movimento['natureza'] == "I") {

                $movimento['num_licenca_piloto'] = Auth::user()->num_licenca;
                $movimento['tipo_licenca_piloto'] = Auth::user()->tipo_licenca;
                $movimento['validade_licenca_piloto'] = Auth::user()->validade_licenca;
                $movimento['num_certificado_piloto'] = Auth::user()->num_certificado;
                $movimento['validade_certificado_piloto'] = Auth::user()->validade_certificado;
                $movimento['classe_certificado_piloto'] = Auth::user()->classe_certificado;

                if (($movimento['piloto_id'] != Auth::user()->id && $movimento['instrutor_id'] != Auth::user()->id)){
                    return back()->withErrors(array('instrutor_id' => 'O piloto ID ou o instrutor ID terão de pertencer ao ID do utilizador com login iniciado.'));
                }
                if($instrutor->instrutor != "1"){
                    return back()->withErrors(array('instrutor_id' => 'O utilizador inserido tem de ser instrutor.'));
                }
                $movimento['num_licenca_instrutor'] = $instrutor->num_licenca;
                $movimento['tipo_licenca_instrutor'] = $instrutor->tipo_licenca;
                $movimento['validade_licenca_instrutor'] = $instrutor->validade_licenca;
                $movimento['num_certificado_instrutor'] = $instrutor->num_certificado;
                $movimento['validade_certificado_instrutor'] = $instrutor->validade_certificado;
                $movimento['classe_certificado_instrutor'] = $instrutor->classe_certificado;
            }
            else{
                if($movimento['piloto_id'] != Auth::user()->id){
                    return back()->withErrors(array('piloto_id' => 'O ID do piloto terá de ser o mesmo do utilizador com login iniciado.'));
                }
                $movimento['num_licenca_piloto'] = Auth::user()->num_licenca;
                $movimento['tipo_licenca_piloto'] = Auth::user()->tipo_licenca;
                $movimento['validade_licenca_piloto'] = Auth::user()->validade_licenca;
                $movimento['num_certificado_piloto'] = Auth::user()->num_certificado;
                $movimento['validade_certificado_piloto'] = Auth::user()->validade_certificado;
                $movimento['classe_certificado_piloto'] = Auth::user()->classe_certificado;
            }
        }
        $movimento->save();

        return redirect()->route('movimentos.index')->with('sucesso', 'Voo editado com sucesso!');
    }
}