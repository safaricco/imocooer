@extends('admin::static.site')

@section('content')

    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>Eventos</h1>
                </div>
            </div>
            @include('admin::static.breadcrumb', ['active' => 'Eventos', 'retorno' => 'eventos/listar'])
            <div class="row">
                <div class="col-md-12">

                    @include('admin::static.mensagem')

                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i> Novo Evento
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form" action="{{ url($route) }}" method="post" enctype="multipart/form-data">
                                @if ($put) @include('admin::static.field-put') @endif
                                {!! csrf_field() !!}
                                <div class="form-body">


                                    <div class="form-group">
                                        <label>Título Evento</label>
                                        <div class="input-icon">
                                            <i class="fa fa-bell-o"></i>
                                            <input name="titulo" type="text" class="form-control" placeholder="Título Evento" value="{{ $dados->titulo or old('titulo') }}">
                                        </div>
                                    </div>
     
                                    <div class="form-group">
                                        <label>Texto Evento</label>
                                        <textarea name="texto" id="summernote_1">{{ $dados->texto or old('texto') }}</textarea>
                                    </div>

                                    @include('admin::static.field-img-destacada', ['tipo' => 'eventos'])

                                    @include('admin::static.field-img-atual', ['tipo' => 'eventos'])
                                </div>


                                <div class="form-actions">
                                    <button type="submit" class="btn blue">Enviar</button>
                                    <button type="reset" class="btn default">Limpar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
         </div>
    </div>

@stop