<?php

namespace App\Http\Controllers;

use App\Aeronave;
use App\Http\Requests\StoreUpdateAeronaveRequest;

class AeronaveController extends Controller
{
	public function index(){
		$aeronaves=Aeronave::all();
		return view('aeronaves.index',compact('aeronaves'));
	}

	public function create(){
		$aeronave = new Aeronave;
		return view('aeronaves.create',compact('aeronave'));
	}

	public function store(StoreUpdateAeronaveRequest $request){
		$aeronave = $request->validated();
		Aeronave::create($aeronave);
		return redirect()->route('aeronaves.index')->with('sucesso', 'Aeronave inserida com sucesso!');
	}

	public function edit(Aeronave $aeronave){
		return view('aeronaves.edit',compact('aeronave'));
	}

	public function update(StoreUpdateAeronaveRequest $request, Aeronave $aeronave){
        $aeronave->fill($request->validated());
        $aeronave->save();

        return redirect()->route('aeronaves.index')->with('sucesso', 'Aeronave editada com sucesso!');;
	}

	public function destroy(Aeronave $aeronave){
        $aeronave->delete();
		return redirect()->route('aeronaves.index')->with('sucesso', 'Aeronave eliminada com sucesso!');
	}

    public function pilotosAutorizados(Aeronave $aeronave){
        dd($aeronave);
    }
}