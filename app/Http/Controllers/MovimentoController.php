<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aeronave;
use App\Http\Requests\StoreUpdateMovimentoRequest;
use App\User;
use App\Movimento;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Filtros\QueryBuilder;

class MovimentoController extends Controller
{
    public function index(Request $request)
    {
        $attr = array();

        if (!is_null($request->id)) {
            $attr['id'] = (int)$request->id;
        }
        if (!is_null($request->aeronave)) {
            $attr['aeronave'] = (string)$request->aeronave;
        }
        if (!is_null($request->piloto)) {
            $attr['piloto_id'] = (int)$request->piloto;
        }
        if (!is_null($request->instrutor)) {
            $attr['instrutor_id'] = (int)$request->instrutor;
        }
        if (!is_null($request->natureza)) {
            $attr['natureza'] = (string)$request->natureza;
        }
        if (!is_null($request->confirmado)) {
            $attr['confirmado'] = (int)$request->confirmado;
        }
        if (!is_null($request->data_inf)) {
            $date = str_replace('/', '-', $request->data_inf);
            $attr['data_inf'] = (string)date("Y-m-d", strtotime($date));
        }
        if (!is_null($request->data_sup)) {
            $date = str_replace('/', '-', $request->data_sup);
            $attr['data_sup'] = (string)date("Y-m-d", strtotime($date));
        }

        $user = User::find(Auth::id());
        if ($user->can('filtrarMeusMovimentos', Movimento::class)) {
            if (!is_null($request->meus_movimentos)) {
                $attr['meus_movimentos'] = (int)$user->id;
            }
        }

        $movimentos = QueryBuilder::movimentos($attr);

        return view('movimentos.index', compact('movimentos'));
    }

    public function create()
    {

        $this->authorize('create', Movimento::class);

        $matriculas = DB::table('aeronaves')->whereNull('deleted_at')->pluck('matricula');

        $movimento = new Movimento(['piloto_id'=>Auth::id()]);//Pré preencher com o id do piloto logado
        return view('movimentos.create', compact('movimento','matriculas'));
    }

    public function store(StoreUpdateMovimentoRequest $request)
    {

        $this->authorize('create', Movimento::class);

        $movimento = $request->validated();

        $piloto = User::find($movimento['piloto_id']);

        if ($piloto->tipo_socio != "P") { //Verificar se piloto inserido é Piloto
            return back()->withInput($request->all())->withErrors(array('piloto_id' => 'O sócio inserido tem de ser piloto.'));
        }
        
        $date = str_replace('/', '-', $movimento['data']);
        $movimento['data'] = date("Y-m-d", strtotime($date));

        $movimento['hora_descolagem'] = date("Y-m-d H:i:s", strtotime($movimento['data'].$movimento['hora_descolagem']));

        $movimento['hora_aterragem'] = date("Y-m-d H:i:s", strtotime($movimento['data'].$movimento['hora_aterragem']));

        $aeronave = Aeronave::find($movimento['aeronave']);

        $movimento['confirmado'] = "0";
        $movimento['tempo_voo'] = ($movimento['conta_horas_fim'] - $movimento['conta_horas_inicio']) * 0.1;
        $tempovooHoras = $movimento['tempo_voo'];
        $movimento['preco_voo'] = $tempovooHoras * $aeronave->preco_hora;

        $movimento['num_licenca_piloto'] = $piloto->num_licenca;
        $movimento['tipo_licenca_piloto'] = $piloto->tipo_licenca;
        $movimento['validade_licenca_piloto'] = $piloto->validade_licenca;
        $movimento['num_certificado_piloto'] = $piloto->num_certificado;
        $movimento['validade_certificado_piloto'] = $piloto->validade_certificado;
        $movimento['classe_certificado_piloto'] = $piloto->classe_certificado;

        if ($movimento['natureza'] == "I") {
            $instrutor = User::find($movimento['instrutor_id']);
            if ($instrutor->instrutor != "1" && $instrutor->tipo_socio != "P") {
                return back()->withInput($request->all())->withErrors(array('instrutor_id' => 'O instrutor inserido tem de ser piloto e instrutor.'));
            }
            $movimento['num_licenca_instrutor'] = $instrutor->num_licenca;
            $movimento['tipo_licenca_instrutor'] = $instrutor->tipo_licenca;
            $movimento['validade_licenca_instrutor'] = $instrutor->validade_licenca;
            $movimento['num_certificado_instrutor'] = $instrutor->num_certificado;
            $movimento['validade_certificado_instrutor'] = $instrutor->validade_certificado;
            $movimento['classe_certificado_instrutor'] = $instrutor->classe_certificado;
        }

        if(Auth::user()->direcao==0){
            if($movimento['natureza'] == "I"){
                if (($piloto->id != Auth::id()) && ($instrutor->id != Auth::id())) {
                    return back()->withInput($request->all())->withErrors(array('instrutor_id' => 'O piloto ID ou o instrutor ID terão de pertencer ao ID do utilizador com login iniciado.','piloto_id' => 'O piloto ID ou o instrutor ID terão de pertencer ao ID do utilizador com login iniciado.'));
                }
            }else{
                if ($piloto->id != Auth::id()) {
                    return back()->withInput($request->all())->withErrors(array('piloto_id' => 'O piloto ID terá de pertencer ao ID do utilizador com login iniciado.'));
                }
            }
        }

        Movimento::create($movimento);

        return redirect()->route('movimentos.index')->with('sucesso', 'Voo inserido com sucesso!');
    }

    public function destroy(Movimento $movimento)
    {

        $this->authorize('delete', $movimento);

        $movimento->forceDelete();

        return redirect()->route('movimentos.index')->with('sucesso', 'Movimento eliminado com sucesso!');
    }

    public function edit(Movimento $movimento)
    {

        $this->authorize('update', $movimento);

        $matriculas = DB::table('aeronaves')->whereNull('deleted_at')->pluck('matricula');

        $movimento->data = date("d/m/Y", strtotime($movimento->data));
        $movimento->hora_aterragem = date("H:i", strtotime($movimento->hora_aterragem));
        $movimento->hora_descolagem = date("H:i", strtotime($movimento->hora_descolagem));

        return view('movimentos.edit', compact('movimento','matriculas'));
    }

    public function update(StoreUpdateMovimentoRequest $request, Movimento $movimento)
    {

        if (isset($request->confirmar)) {
            $this->authorize('confimarVoo', Movimento::class);
            $movimento->confirmado = 1;
            $movimento->save();
            return redirect()->route('movimentos.index')->with('sucesso', 'Movimento confirmado com sucesso!');
        }

        $this->authorize('update', $movimento);

        $movimento->fill($request->validated());

        $piloto = User::find($movimento->piloto_id);

        if ($piloto->tipo_socio != "P") { //Verificar se piloto inserido é Piloto
            return back()->withInput($request->all())->withErrors(array('piloto_id' => 'O sócio inserido tem de ser piloto.'));
        }
        
        $date = str_replace('/', '-', $movimento->data);
        $movimento->data = date("Y-m-d", strtotime($date));

        $movimento->hora_descolagem = date("Y-m-d H:i:s", strtotime($movimento->data.$movimento->hora_descolagem));

        $movimento->hora_aterragem = date("Y-m-d H:i:s", strtotime($movimento->data.$movimento->hora_aterragem));

        $aeronave = Aeronave::find($movimento->aeronave);

        $movimento->confirmado = "0";
        $movimento->tempo_voo = ($movimento->conta_horas_fim - $movimento->conta_horas_inicio) * 0.1;
        $tempovooHoras = $movimento->tempo_voo;
        $movimento->preco_voo = $tempovooHoras * $aeronave->preco_hora;

        $movimento->num_licenca_piloto = $piloto->num_licenca;
        $movimento->tipo_licenca_piloto = $piloto->tipo_licenca;
        $movimento->validade_licenca_piloto = $piloto->validade_licenca;
        $movimento->num_certificado_piloto = $piloto->num_certificado;
        $movimento->validade_certificado_piloto = $piloto->validade_certificado;
        $movimento->classe_certificado_piloto = $piloto->classe_certificado;

        if ($movimento->natureza == "I") {
            $instrutor = User::find($movimento->instrutor_id);
            if ($instrutor->instrutor != "1" && $instrutor->tipo_socio != "P") {
                return back()->withInput($request->all())->withErrors(array('instrutor_id' => 'O instrutor inserido tem de ser piloto e instrutor.'));
            }
            $movimento->num_licenca_instrutor = $instrutor->num_licenca;
            $movimento->tipo_licenca_instrutor = $instrutor->tipo_licenca;
            $movimento->validade_licenca_instrutor = $instrutor->validade_licenca;
            $movimento->num_certificado_instrutor = $instrutor->num_certificado;
            $movimento->validade_certificado_instrutor = $instrutor->validade_certificado;
            $movimento->classe_certificado_instrutor = $instrutor->classe_certificado;
        }

        if(Auth::user()->direcao==0){
            if($movimento->natureza == "I"){
                if (($piloto->id != Auth::id()) && ($instrutor->id != Auth::id())) {
                    return back()->withInput($request->all())->withErrors(array('instrutor_id' => 'O piloto ID ou o instrutor ID terão de pertencer ao ID do utilizador com login iniciado.'));
                }
            }else{
                if ($piloto->id != Auth::id()) {
                    return back()->withInput($request->all())->withErrors(array('piloto_id' => 'O piloto ID terá de pertencer ao ID do utilizador com login iniciado.'));
                }
            }
        }

        $movimento->save();

        return redirect()->route('movimentos.index')->with('sucesso', 'Voo editado com sucesso!');
    }
}