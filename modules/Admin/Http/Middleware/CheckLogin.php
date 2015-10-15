<?php

namespace Modules\Admin\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Modules\Admin\Entities\Acesso;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) :

            return redirect('admin/login');

        else :

            $idUser = Auth::user()->id;

            if($idUser != 1) :

                if (Acesso::perfilAtivo($idUser) and Acesso::userAtivo($idUser)) :

                    $req = explode('/', $request->getPathInfo());

                    if ($req[2] != 'dashboard'):

                        if ($req[2] == 'configuracoes') :
                            $like   = $req[3];
                        else :
                            $like   = $req[2];
                        endif;

                        $permissaoUser  = Acesso::permissaoUser($idUser, $like);

                        if (!$permissaoUser) :

                            return View::make('admin::static.sem-permissao', ['tipo' => 'Usuário']);

                        elseif($permissaoUser == 1) :

                            // verificando se existe permissão para o perfil do usuário
                            $permissaoPerfil = Acesso::permissaoPerfil($idUser, $like);

                            if (!$permissaoPerfil) :

                                return View::make('admin::static.sem-permissao', ['tipo' => 'Perfil']);

                            elseif($permissaoPerfil) :

                                return $next($request);

                            endif;

                        elseif($permissaoUser) :

                            return $next($request);

                        endif;

                    endif;

                else :

                    return Redirect::to('admin/login');

                endif;

            endif;

        endif;

        return $next($request);
    }
}
