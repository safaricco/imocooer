<?php

namespace Modules\Admin\Http\Controllers\Admin;

use Modules\Admin\Entities\Analytics;
use Modules\Admin\Entities\LogR;
use Illuminate\Http\Request;
use App\Http\Requests;
use Pingpong\Modules\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class Analytic extends Controller
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
            $dados['dados'] = Analytics::findOrFail(1);
            $dados['route'] = '/admin/configuracoes/analytics/editar/1';
            $dados['put']   = true;
            return view('admin::analytics/analytics', $dados);

        } catch (\Exception $e) {

            LogR::exception('index analytics', $e);
            session()->flash('flash_message', 'Ops!! Ocorreu algum problema!. ' . $e->getMessage());
            return Redirect::back();
        }
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
        $validacao = Validator::make($request->all(), [
            'codigo' => 'required|string'
        ]);

        if ($validacao->fails()) :
            return redirect('admin/configuracoes/analytics')->withErrors($validacao)->withInput();
        else :

            try{
                $analytic           = Analytics::find($id);

                $analytic->codigo   = $request->codigo;

                $analytic->save();

                session()->flash('flash_message', 'Registro atualizado com sucesso!');

                return redirect('admin/configuracoes/analytics');

            } catch (\Exception $e) {

                LogR::exception($analytic, $e);
                session()->flash('flash_message', 'Ops!! Ocorreu algum problema!. ' . $e->getMessage());

            }

        endif;
    }

//    public function analytics()
//    {
//
//    }
}
