@extends('admin::static.site')

@section('content')

    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>Ajuda</h1>
                </div>
            </div>
            @include('admin::static.breadcrumb', ['active' => 'Ajuda', 'retorno' => 'ajuda/listar'])
            <div class="row">
                <div class="col-md-12">

                    @include('admin::static.mensagem')

                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-edit"></i>Listando Itens de ajuda
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <a href="{{url('admin/ajuda/novo')}}">
                                                <button id="sample_editable_1_new" class="btn green">
                                                    Novo <i class="fa fa-plus"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="btn-group pull-right">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-hover table-bordered" id="sample_1">
                            <thead>
                            <tr>
                                <th> Cód. </th>
                                <th> Título </th>
                                <th> Texto </th>
                                <th class="col-md-2"> Ações </th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach($itens as $item)
                                    <tr>
                                        <td> {{$item->id_ajuda}} </td>
                                        <td> {{$item->titulo}} </td>
                                        <td> {!! str_limit($item->texto,380) !!} </td>
                                        <td>
                                            <a href="{{ url('admin/ajuda/editar/' . $item->id_ajuda) }}" class="btn btn-icon-only yellow" title="Editar"><i class="fa fa-edit"></i></a>
                                            <a href="{{ url('admin/ajuda/visualizar/' . $item->id_ajuda) }}" class="btn btn-icon-only blue" title="Visualizar"><i class="fa fa-eye"></i></a>
                                            <a href="{{ url('admin/ajuda/destroy/' . $item->id_ajuda) }}" class="btn btn-icon-only red" title="Excluir"><i class="fa fa-trash"></i></a>
                                            @if ($item->status == 1)
                                                <a href="{{ url('/admin/ajuda/status/0/' . $item->id_ajuda) }}" class="btn btn-icon-only green" title="Ativo"><i class="fa fa-thumbs-o-up"></i></a>
                                            @else
                                                <a href="{{ url('/admin/ajuda/status/1/' . $item->id_ajuda) }}" class="btn btn-icon-only grey-cascade" title="Inativo"><i class="fa fa-thumbs-o-down"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                            </table>
                        </div>
                    </div>

                </div>
            </div>
         </div>
    </div>

@stop