@extends('admin::static.site')

@section('content')

    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>Vídeos</h1>
                </div>
            </div>
            @include('admin::static.breadcrumb', ['active' => 'Vídeos', 'retorno' => 'videos/listar'])
            <div class="row">
                <div class="col-md-12">

                    @include('admin::static.mensagem')

                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i> Nova Galeria
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form" action="{{ url($route) }}" method="post" enctype="multipart/form-data">
                                @if ($put) @include('admin::static.field-put') @endif
                                {!! csrf_field() !!}
                                <div class="form-body">


                                    <div class="form-group">
                                        <label>Título Galerias</label>
                                        <div class="input-icon">
                                            <i class="fa fa-bell-o"></i>
                                            <input name="titulo" type="text" class="form-control" placeholder="Título Galerias" value="{{ $dados->titulo or old('titulo') }}">
                                        </div>
                                    </div>
     
                                    <div class="form-group">
                                        <label>Texto Evento</label>
                                        <textarea name="texto" id="summernote_1">{{ $dados->texto or old('texto') }}</textarea>
                                    </div>

                                    @include('admin::static.field-img-destacada', ['tipo' => 'noticias'])

                                    @include('admin::static.field-img-atual', ['tipo' => 'noticias'])
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