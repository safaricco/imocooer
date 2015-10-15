<?php

namespace Modules\Admin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use Modules\Admin\Entities\Funcao;
use Modules\Admin\Entities\LogR;
use Modules\Admin\Entities\Perfil;
use Modules\Admin\Entities\PerfilUser;
use Modules\Admin\Entities\PermissaoPerfil;
use Modules\Admin\Entities\Role;
use Pingpong\Modules\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class Perfis extends Controller
{
    public function __construct()
    {
        LogR::register(last(explode('\\', get_class($this))) . ' ' . explode('@', Route::currentRouteAction())[1]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return view('admin::perfis/perfis', ['perfis' => Perfil::all()]);

        } catch (\Exception $e) {

            LogR::exception('index perfis', $e);
            session()->flash('flash_message', 'Ops!! Ocorreu algum problema!. ' . $e->getMessage());

            return Redirect::back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $dados['funcoes']   = Funcao::all();
            $dados['roles']     = Role::all();
            $dados['put']       = false;
            $dados['dados']     = '';
            $dados['permissao'] = '';
            $dados['route']     = 'admin/configuracoes/perfis/store';
            return view('admin::perfis/dados', $dados);
        } catch (\Exception $e) {

            LogR::exception('create perfis', $e);
            session()->flash('flash_message', 'Ops!! Ocorreu algum problema!. ' . $e->getMessage());

            return Redirect::back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'descricao' => 'required|string'
        ]);

        if ($validator->fails()) :
            return redirect('admin/configuracoes/perfis/novo')->withErrors($validator)->withInput();
        else :

            try {
                $perfil             = new Perfil();
                $perfil->descricao  = $request->descricao;
                $perfil->save();

                $funcoes = Funcao::all();

                $cont = 1;

                foreach ($funcoes as $funcao) :

                    try {
                        $permissao = new PermissaoPerfil();

                        $permissao->id_funcao   = $funcao->id_funcao;
                        $permissao->id_perfil   = $perfil->id_perfil;
                        $permissao->id_role     = $request->$cont;
                        $permissao->save();

                        $cont++;

                    } catch (\Exception $e) {

                        LogR::exception($permissao, $e);
                        session()->flash('flash_message', 'Ops!! Ocorreu algum problema!. ' . $e->getMessage());

                    }

                endforeach;

                session()->flash('flash_message', 'Registro gravado com sucesso!');

            } catch (\Exception $e) {

                LogR::exception($perfil, $e);
                session()->flash('flash_message', 'Ops!! Ocorreu algum problema!. ' . $e->getMessage());

            }

            return Redirect::back();

        endif;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $dados['funcoes']   = Funcao::all();
            $dados['roles']     = Role::all();
            $dados['put']       = true;
            $dados['dados']     = Perfil::findOrFail($id);
            $dados['permissao'] = PermissaoPerfil::where('id_perfil', $id)->get();
            $dados['route']     = 'admin/configuracoes/perfis/atualizar/'.$id;
            return view('admin::perfis/dados', $dados);

        } catch (\Exception $e) {

            LogR::exception('show perfis', $e);
            session()->flash('flash_message', 'Ops!! Ocorreu algum problema!. ' . $e->getMessage());

            return Redirect::back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'descricao' => 'required|string'
        ]);

        if ($validator->fails()) :
            return redirect('admin/configuracoes/perfis/editar/'.$id)->withErrors($validator)->withInput();
        else :

            try {
                $perfil             = Perfil::findOrFail($id);
                $perfil->descricao  = $request->descricao;
                $perfil->save();

                $funcoes = Funcao::all();

                $cont = 1;

                foreach ($funcoes as $funcao) :

                    try {

                        $permissao = PermissaoPerfil::where('id_funcao', $funcao->id_funcao)->where('id_perfil', $perfil->id_perfil)->first();

                        $permissao->id_role = $request->$cont;
                        $permissao->save();

                        $cont++;

                    } catch (\Exception $e) {

                        LogR::exception($permissao, $e);
                        session()->flash('flash_message', 'Ops!! Ocorreu algum problema!. ' . $e->getMessage());

                    }

                endforeach;

                session()->flash('flash_message', 'Registro alterado com sucesso!');

            } catch (\Exception $e) {

                LogR::exception($perfil, $e);
                session()->flash('flash_message', 'Ops!! Ocorreu algum problema!. ' . $e->getMessage());

            }

            return Redirect::back();

        endif;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // destruindo vinculo entre as permissões e o perfil
            $permissao = PermissaoPerfil::where('id_perfil', $id)->get();
            foreach($permissao as $perm) :
                PermissaoPerfil::destroy($perm->id_permissao_perfil);
            endforeach;

            // destruindo vinculo entre perfil e usuário
            $peruser = PerfilUser::where('id_perfil', $id)->get();
            foreach($peruser as $perf) :
                PerfilUser::destroy($perf->id_perfil_user);
            endforeach;

            // destruindo o perfil
            Perfil::destroy($id);

            session()->flash('flash_message', 'Registro apagado com sucesso!');

        } catch (\Exception $e) {

            LogR::exception('destroy perfis', $e);
            session()->flash('flash_message', 'Ops!! Ocorreu algum problema!. ' . $e->getMessage());

        }

        return Redirect::back();
    }

    public function updateStatus($status, $id)
    {

        try {
            $dado         = Perfil::findOrFail($id);

            $dado->status = $status;

            $dado->save();

            session()->flash('flash_message', 'Status alterado com sucesso!');

        } catch (\Exception $e) {

            LogR::exception($dado, $e);
            session()->flash('flash_message', 'Ops!! Ocorreu algum problema!. ' . $e->getMessage());

        }

        return Redirect::back();
    }
}
