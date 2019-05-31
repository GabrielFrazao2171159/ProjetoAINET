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
use Illuminate\Support\Facades\Storage;
use App\Filtros\QueryBuilder;

class UtilizadorController extends Controller
{
    public function index(Request $request)
    {
        $user = User::find(Auth::id());

        $attr = array();
        if (!($user->can('verInativos', User::class))) {
            $attr['ativo'] = 1;
        }

        //Filtro => Valor
        if (!is_null($request->num_socio)) {
            $attr['num_socio'] = (int)$request->num_socio;
        }
        if (!is_null($request->nome_informal)) {
            $attr['nome_informal'] = $request->nome_informal;
        }
        if (!is_null($request->email)) {
            $attr['email'] = $request->email;
        }
        if (!is_null($request->tipo)) {
            $attr['tipo_socio'] = (string)$request->tipo;
        }
        if (!is_null($request->direcao)) {
            $attr['direcao'] = (int)$request->direcao;
        }

        if ($user->can('filtrarTodosDados', User::class)) {
            if (!is_null($request->quotas_pagas)) {
                $attr['quota_paga'] = (int)$request->quota_paga;
            }
            if (!is_null($request->ativo)) {
                $attr['ativo'] = (int)$request->ativo;
            }
        }

        $socios = QueryBuilder::socios($attr);

        return view('socios.index', compact('socios'));
    }

    public function create()
    {
        $this->authorize('create', User::class);

        $socio = new User();
        return view('socios.create', compact('socio'));
    }

    public function store(StoreUserRequest $request)
    {
        $this->authorize('create', User::class);

        $socio = $request->validated();

        $foto = null;
        if (!empty($socio['file_foto'])) {
            $foto = $socio['file_foto'];
            unset($socio['file_foto']);
        }

        //Mudar data para formato da BD (ela vem noutro formato para passar nos testes)
        $date = str_replace('/', '-', $socio['data_nascimento']);
        $socio['data_nascimento'] = date("Y-m-d", strtotime($date));

        //Definir pass automática
        $socio['password'] = password_hash($socio['data_nascimento'], PASSWORD_DEFAULT);
        $user = User::create($socio);

        //Foto
        if (!empty($foto)) {
            $image = $foto;
            $name = $user->id . '_' . time() . '.' . $image->getClientOriginalExtension();
            $path = $foto->storeAs('/public/fotos', $name);
            //Meter foto_url na BD
            $user = User::find($user->id);
            $user->foto_url = $name;
            $user->save();
        }

        $user->SendEmailVerificationNotification();//Email automático ao cliente

        return redirect()->route('socios.index')->with('sucesso', 'Sócio inserido com sucesso!');
    }

    public function reenviarEmail(User $socio)
    {
        $socio->SendEmailVerificationNotification();
        return redirect()->route('socios.edit', $socio)->with('sucesso', 'Email reenviado com sucesso!');
    }

    public function quotas(User $socio)
    {
        $this->authorize('gerirCotasAtivos', User::class);

        if ($socio->quota_paga == 0) {
            $socio->quota_paga = 1;
        } else {
            $socio->quota_paga = 0;
        }
        $socio->save();
        return redirect()->route('socios.index')->with('sucesso', 'Quota alterada com sucesso!');
    }

    public function ativo(User $socio)
    {
        $this->authorize('gerirCotasAtivos', User::class);

        if ($socio->ativo == 0) {
            $socio->ativo = 1;
        } else {
            $socio->ativo = 0;
        }
        $socio->save();
        return redirect()->route('socios.index')->with('sucesso', 'Estado do sócio alterado com sucesso!');
    }

    public function desativar_sem_quotas()
    {
        $this->authorize('gerirCotasAtivos', User::class);

        DB::update("update users set ativo=0 where quota_paga=0");
        return redirect()->route('socios.index')->with('sucesso', 'Todos os sócios com quotas por pagar ficaram inativos!');

    }

    public function reset_quotas()
    {
        $this->authorize('gerirCotasAtivos', User::class);

        DB::update("update users set quota_paga=0");
        return redirect()->route('socios.index')->with('sucesso', 'Todas as quotas ficaram por pagar!');
    }

    public function edit(User $socio)
    {
        $socio->data_nascimento = date('d/m/Y', strtotime($socio->data_nascimento));
        $this->authorize('update', $socio);

        return view('socios.edit', compact('socio'));
    }

    public function update(UpdateUserRequest $request, User $socio)
    {
        $this->authorize('update', $socio);

        //Regra de unicidade
        $rules = array();
        $rules['email'] = 'unique:users,email,' . $socio->id . ',id';
        if (User::find(Auth::id())->direcao == 1) {
            $rules['num_socio'] = 'unique:users,num_socio,' . $socio->id . ',id';
        }
        $request->validate($rules);
        //Fim_Regra Unicidade (Faço aqui para ter acesso à variável socio)

        $socio->fill($request->validated());

        if ($request->hasFile('file_foto')) {
            $image = $request->file('file_foto');
            $name = $socio->id . '_' . time() . '.' . $image->getClientOriginalExtension();
            $path = $request->file('file_foto')->storeAs('/public/fotos', $name);
            if (!is_null($socio->foto_url)) {
                Storage::delete('/public/fotos/' . $socio->foto_url); //Apagar antiga
            }
            $socio->foto_url = $name;
        }


        if ($request->hasFile('file_licenca')) {
            $pdf = $request->file('file_licenca');
            $name = 'licenca_' . $socio->id . '.' . $pdf->getClientOriginalExtension();
            $path = $request->file('file_licenca')->storeAs('/docs_piloto', $name);
            $socio->licenca_confirmada = 0;
        }

        if ($request->hasFile('file_certificado')) {
            $pdf = $request->file('file_certificado');
            $name = 'certificado_' . $socio->id . '.' . $pdf->getClientOriginalExtension();
            $path = $request->file('file_certificado')->storeAs('/docs_piloto', $name);
            $socio->certificado_confirmado = 0;
        }


        //Mudar data para formato da BD (ela vem noutro formato para passar nos testes)
        $date = str_replace('/', '-', $socio->data_nascimento);
        $socio->data_nascimento = date("Y-m-d", strtotime($date));
        $socio->save();

        return redirect()->route('socios.index')->with('sucesso', 'Sócio editado com sucesso!');
    }

    public function destroy(User $socio)
    {
        $this->authorize('delete', User::class);

        $movimentos = $socio->movimentos;

        if (count($movimentos) == 0) {
            $socio->forceDelete();
        } else {
            $socio->delete();
        }
        return redirect()->route('socios.index')->with('sucesso', 'Sócio eliminado com sucesso!');
    }

    public function editPassword()
    {
        return view('socios.editPassword');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $socio = User::find(Auth::id());

        if (!(Hash::check($request->old_password, $socio->password))) {
            return back()->withErrors(array('old_password'
            => 'O campo palavra-passe antiga deve coincidir com a atual.'));
        }

        $array = array('password' => password_hash($request->password, PASSWORD_DEFAULT));

        if ($socio->password_inicial == 1) {
            $socio->password_inicial = 0;
        }

        $socio->fill($array);
        $socio->save();

        return redirect()->route('socios.index')->with('sucesso', 'Palavra-passe alterada com sucesso!');
    }

    public function certificado(User $piloto)
    {
        $name = 'certificado_' . $piloto->id . '.pdf';
        return Storage::disk('local')->response('docs_piloto/' . $name);
    }

    public function licenca(User $piloto)
    {
        $name = 'licenca_' . $piloto->id . '.pdf';
        return Storage::disk('local')->response('docs_piloto/' . $name);    }
}
