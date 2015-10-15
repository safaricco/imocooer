<?php

namespace Modules\Admin\Http\Controllers\Admin;

//use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\View;
use Modules\Admin\Entities\User;
use Pingpong\Modules\Routing\Controller;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class Login extends Controller
{
    public function index()
    {
        return View::make('admin::login');
    }

    public function logar(Request $request)
    {
        $validacao = Validator::make($request->all(), [
            'email'     => 'required|email',
            'password'  => 'required|string'
        ]);

        if ($validacao->fails()) :
            return redirect('admin/login')->withErrors($validacao)->withInput();
        else :

            $usuario = User::where('email', '=', $request->email)->first();

            if ($usuario):

                $senhaIgual = Hash::check($request->password, $usuario->password);

                if ($senhaIgual) :                    

                    if (!Auth::check() ):

                        Auth::login($usuario);
                        $usuario->ultimo_acesso = date('Y-m-d H:i:s');
                        $usuario->save();

                        return Redirect::to('/admin/dashboard');

                    elseif (Auth::check()) :

                        $usuario->ultimo_acesso = date('Y-m-d H:i:s');
                        $usuario->save();
                        
                        return Redirect::to('admin/dashboard');

                    else :
                        session()->flash('flash_message', 'Usuário ou senha inválidos');
                        return Redirect::to('admin/login')->withInput();
                    endif;

                else :
                    session()->flash('flash_message', 'Usuário ou senha inválidos');
                    return Redirect::to('admin/login')->withInput();
                endif;

            else :
                session()->flash('flash_message', 'Usuário ou senha inválidos');
                return Redirect::to('admin/login')->withInput();
            endif;

        endif;
    }
}