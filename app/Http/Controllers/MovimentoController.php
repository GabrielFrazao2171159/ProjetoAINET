<?php

namespace App\Http\Controllers;

use App\Aeronave;
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
		$this->authorize('create', Movimento::class);
		
		$aeronave = new Movimento;
		return view('movimentos.create',compact('movimento'));
	}

}