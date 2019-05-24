<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aeronave;
use App\Http\Requests\StoreMovimentoRequest;
use App\User;
use App\Movimento;
use Illuminate\Support\Facades\DB;

class MovimentoController extends Controller
{

    public function index(){
		$movimentos = Movimento::paginate(15);
		return view('movimentos.index',compact('movimentos'));
	}

	public function create(){
        $movimento = new Movimento();
		return view('movimentos.create',compact('movimento'));
	}

	public function store(StoreMovimentoRequest $request){
        $movimento = $request->validated();
        $piloto = User::find($movimento['piloto_id']);
        $aeronave = Aeronave::find($movimento['aeronave']);

        $movimento['confirmado'] = "0";
        $movimento['tempo_voo'] = ($movimento['conta_horas_fim']-$movimento['conta_horas_inicio'])*0.1;
        $tempovooHoras = $movimento['tempo_voo'];
        $movimento['preco_voo'] = $tempovooHoras*$aeronave->preco_hora;

        $movimento['num_licenca_piloto'] = $piloto->num_licenca;
        $movimento['tipo_licenca_piloto'] = $piloto->tipo_licenca;
        $movimento['validade_licenca_piloto'] = $piloto->validade_licenca;
        $movimento['num_certificado_piloto'] = $piloto->num_certificado;
        $movimento['validade_certificado_piloto'] = $piloto->validade_certificado;
        $movimento['classe_certificado_piloto'] = $piloto->classe_certificado;

        if($movimento['natureza'] != "I") {
            $movimento['tipo_instrucao'] = "";
            $movimento['instrutor_id'] = "";

        }
        else{
            $instrutor = User::find($movimento['instrutor_id']);
            $movimento['num_licenca_instrutor'] = $instrutor->num_licenca;
            $movimento['tipo_licenca_instrutor'] = $instrutor->tipo_licenca;
            $movimento['validade_licenca_instrutor'] = $instrutor->validade_licenca;
            $movimento['num_certificado_instrutor'] = $instrutor->num_certificado;
            $movimento['validade_certificado_instrutor'] = $instrutor->validade_certificado;
            $movimento['classe_certificado_instrutor'] = $instrutor->classe_certificado;
        }

        dd($movimento);

        $movimentoCriado = Movimento::create($movimento);
        return redirect()->route('movimentos.index')->with('sucesso', 'Voo inserido com sucesso!');
    }

    public function destroy(Movimento $movimento){

        if($movimento->confirmado == 0){
            $movimento->forceDelete();
        }else{
            return redirect()->route('movimentos.index')->with('erros', 'Movimento encontra-se confirmado, não pode ser eliminado!');
        }

        return redirect()->route('movimentos.index')->with('sucesso', 'Movimento eliminado com sucesso!');
    }

}