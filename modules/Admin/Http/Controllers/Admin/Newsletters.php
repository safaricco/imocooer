<?php

namespace Modules\Admin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use Modules\Admin\Entities\LogR;
use Modules\Admin\Entities\Newsletter;
use Pingpong\Modules\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class Newsletters extends Controller
{
    public function __construct()
    {
        LogR::register(last(explode('\\', get_class($this))) . ' ' . explode('@', Route::currentRouteAction())[1]);
    }

    public function index()
    {

        try {
            $dados['newsletters'] = Newsletter::all();
            return view('admin::newsletter/newsletter', $dados);

        } catch (\Exception $e) {

            LogR::exception('index newsletters', $e);
            session()->flash('flash_message', 'Ops!! Ocorreu algum problema!. ' . $e->getMessage());

            return Redirect::back();
        }
    }

    public function destroy($id)
    {
        try {
            Newsletter::destroy($id);

            session()->flash('flash_message', 'Registro apagado com sucesso');
        } catch (\Exception $e) {

            LogR::exception('destroy newsletters', $e);
            session()->flash('flash_message', 'Ops!! Ocorreu algum problema!. ' . $e->getMessage());

        }

        return Redirect::back();
    }
}
