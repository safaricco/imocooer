<?php

namespace Modules\Admin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use Modules\Admin\Entities\LogR;
use Pingpong\Modules\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Spatie\LaravelAnalytics\LaravelAnalytics;


class Dashboard extends Controller
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

//        $analyticsData = new LaravelAnalytics(env('ANALYTICS_SITE_ID'), env('ANALYTICS_CLIENT_ID'));
//        $analyticsData->setSiteId('ga:UA-61838331-1');
//        $analyticsData->getVisitorsAndPageViews();
//        dd($analyticsData);
        try{
            return view('admin::dashboard');

        } catch (\Exception $e) {

            LogR::exception('index dashboard', $e);
            session()->flash('flash_message', 'Ops!! Ocorreu algum problema!. ' . $e->getMessage());

            return view('admin::dashboard');
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
        //
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
}
