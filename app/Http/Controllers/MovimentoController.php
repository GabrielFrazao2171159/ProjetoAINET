<?php

namespace App\Http\Controllers;

use App\Aeronave;
use App\User;
use App\Movimento;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;


class MovimentoController extends Controller
{

    public function index(){
		$movimentos = Movimento::paginate(15);
		return view('movimentos.index',compact('movimentos'));
	}

}