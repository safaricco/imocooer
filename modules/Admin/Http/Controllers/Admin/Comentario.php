<?php

namespace Modules\Admin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use Modules\Admin\Entities\Comentarios;
use Modules\Admin\Entities\LogR;
use Modules\Admin\Entities\StatusComentario;
use Pingpong\Modules\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class Comentario extends Controller
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
    public function index($filtro = null)
    {
        try {
            if (!empty($filtro)) :

                if($filtro == 'aguardando'):
                    $dados['comentarios']   = Comentarios::where('id_status_comentario', 1)->get();
                endif;

                if($filtro == 'aprovados'):
                    $dados['comentarios']   = Comentarios::where('id_status_comentario', 2)->get();
                endif;

                if($filtro == 'rejeitados'):
                    $dados['comentarios']   = Comentarios::where('id_status_comentario', 3)->get();
                endif;

                if($filtro == 'lixo'):
                    $dados['comentarios']   = Comentarios::where('id_status_comentario', 4)->get();
                endif;

                if($filtro == 'span'):
                    $dados['comentarios']   = Comentarios::where('id_status_comentario', 5)->get();
                endif;

                if($filtro == 'todos'):
                    $dados['comentarios']   = Comentarios::all();
                endif;

            else :
                $dados['comentarios']   = Comentarios::all();
            endif;

            $dados['statusComentario']  = StatusComentario::all();

            return view('admin::comentarios/comentarios', $dados);

        } catch (\Exception $e) {

            LogR::exception('index comentários', $e);
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $comentario = new Comentarios();
            $comentario->id_comentario_pai      = $request->id_comentario;
            $comentario->id_noticia             = $request->id_noticia;
            $comentario->id_status_comentario   = 2;
            $comentario->nome                   = Auth::user()->name;
            $comentario->email                  = Auth::user()->email;
            $comentario->texto                  = $request->texto;
            $comentario->save();

            // aprovando comentario pai
            $comentPai = Comentarios::findOrFail($comentario->id_comentario_pai);
            $comentPai->id_status_comentario = 2;
            $comentPai->save();


    //        // enviadno e-mail para quem comentou
    //        $config         = Configuracao::find(1);
    //        $contato        = Contato::find(1);
    //        $email          = Emails::find(1);
    //        $assunto        = '['. $config->nome_site .'] Contato';
    //        $remetente      = $email->endereco;
    //        $destinatario   = $contato->email;
    //
    //        $dados = array(
    //            'dados' => $request->all(),
    //            'hora'  => date('d/m/Y H:m:i')
    //        );
    //
    //        $view = 'emails.resposta-comentario';
    //
    //        Emails::enviarEmail($assunto, $remetente, $destinatario, $dados, $view, $request->email);

            session()->flash('flash_message', 'Comentário aprovado com sucesso!');

        } catch (\Exception $e) {

            LogR::exception('store comentários', $e);
            session()->flash('flash_message', 'Ops!! Ocorreu algum problema!. ' . $e->getMessage());

        }

        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateStatus($status, $id)
    {
        $dado         = Comentarios::findOrFail($id);

        $dado->id_status_comentario = $status;

        $dado->save();

        session()->flash('flash_message', 'Status alterado com sucesso!');

        return Redirect::back();
    }
}
