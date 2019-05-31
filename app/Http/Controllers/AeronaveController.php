<?php

namespace App\Http\Controllers;

use App\Aeronave;
use App\User;
use App\ValorTabela;
use App\Http\Requests\StoreUpdateAeronaveRequest;

class AeronaveController extends Controller
{
	public function index(){
		$aeronaves=Aeronave::all();
		return view('aeronaves.index',compact('aeronaves'));
	}

	public function create(){
		$this->authorize('create', Aeronave::class);

		$valores = array_fill(0,10,new ValorTabela);
		$aeronave = new Aeronave();
		return view('aeronaves.create',compact('aeronave','valores'));
	}

	public function store(StoreUpdateAeronaveRequest $request){
		$this->authorize('create', Aeronave::class);

		$aeronave = $request->validated();
		$aeronaveCriada = Aeronave::create($aeronave);
		
		$valor = array();
		for($i=1;$i<11;$i++){
			$valor['matricula'] = $aeronaveCriada->matricula;
			$valor['unidade_conta_horas'] = $i;
			$valor['minutos'] = $aeronave['tempos'][$i];
			$valor['preco'] = $aeronave['precos'][$i];
			ValorTabela::create($valor);		
		}

		return redirect()->route('aeronaves.index')->with('sucesso', 'Aeronave inserida com sucesso!');
	}

	public function edit(Aeronave $aeronave){
		$this->authorize('update', Aeronave::class);
		$valores = $aeronave->valores;

		return view('aeronaves.edit',compact('aeronave','valores'));
	}

	public function update(StoreUpdateAeronaveRequest $request, Aeronave $aeronave){
		$this->authorize('update', Aeronave::class);

        $aeronaveValidated = $request->validated();
        unset($aeronaveValidated['matricula']);
        $aeronave->fill($aeronaveValidated);
        $aeronave->save();

        $valores = $aeronave->valores;
        
        $i = 1;
        $array = array();
        foreach ($valores as $valor){
            $array['matricula'] = $aeronave->matricula;
            $array['unidade_conta_horas'] = $i;
            $array['minutos'] = $aeronaveValidated['tempos'][$i];
            $array['preco'] = $aeronaveValidated['precos'][$i];
            $valor->fill($array);
            $valor->save();
            $i++;
        }

        return redirect()->route('aeronaves.index')->with('sucesso', 'Aeronave editada com sucesso!');
	}

	public function destroy(Aeronave $aeronave){
		$this->authorize('delete', Aeronave::class);

		$movimentos = $aeronave->movimentos;

		if(count($movimentos)==0){
			$aeronave->forceDelete();
			$valores = $aeronave->valores;
			foreach ($valores as $valor) {
    			$valor->delete();
			}
		}else{
			$aeronave->delete();
		}

		return redirect()->route('aeronaves.index')->with('sucesso', 'Aeronave eliminada com sucesso!');
	}

    public function pilotosAutorizados(Aeronave $aeronave){
    	$this->authorize('pilotosAutorizados', Aeronave::class);

        $pilotos = Aeronave::find($aeronave->matricula)->pilotos()->paginate(15);
        return view('aeronaves.listagemPilotosAutorizados',compact('pilotos','aeronave'));
    }

    public function naoAutorizarPiloto(Aeronave $aeronave, User $piloto){
    	$this->authorize('pilotosAutorizados', Aeronave::class);

        $aeronave->pilotos()->detach($piloto->id);
        return redirect()->route('aeronaves.pilotosAutorizados',$aeronave)->with('sucesso', 'Piloto adicionado à lista de não autorizados!');
    }

    public function pilotosNaoAutorizados(Aeronave $aeronave){
    	$this->authorize('pilotosAutorizados', Aeronave::class);

    	$todosPilotos= $aeronave->pilotos()->get()->pluck('id')->toArray();
    	$pilotos = User::where('tipo_socio','P')->whereNotIn('id',$todosPilotos)->orderBy('id')->paginate(15);
        return view('aeronaves.listagemPilotosNaoAutorizados',compact('pilotos','aeronave'));
    }

    public function autorizarPiloto(Aeronave $aeronave, User $piloto){
    	$this->authorize('pilotosAutorizados', Aeronave::class);
    	
        $aeronave->pilotos()->attach($piloto->id);
        return redirect()->route('aeronaves.pilotosAutorizados',$aeronave)->with('sucesso', 'Piloto adicionado à lista de autorizados!');
    }

    public function mostrarPrecos(Aeronave $aeronave){
        $this->authorize('precos', Aeronave::class);

        $valores = $aeronave->valores;
        foreach ($valores as $valor) {
       		unset($valor->id);
       		unset($valor->matricula);
        }

        return response()->json($valores);
    }
}