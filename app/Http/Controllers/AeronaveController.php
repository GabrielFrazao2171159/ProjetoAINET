<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aeronave;
use App\Http\Requests\StoreAeronaveRequest;

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

	public function store(StoreAeronaveRequest $request){
		$aeronave = $request->validated();
		Aeronave::create($aeronave);
		return redirect()->route('aeronaves.index');
	}

	public function edit(Aeronave $aeronave){
		return view('aeronaves.edit',compact('aeronave'));
	}

	public function update(Request $request, Aeronave $aeronave){
		dd($request);
	}

	public function destroy(Aeronave $aeronave){
		$user->delete();		
		return redirect()->route('aeronaves.index');
	}
}
