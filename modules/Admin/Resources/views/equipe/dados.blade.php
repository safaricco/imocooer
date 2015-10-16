@extends('admin::static.site')

@section('content')

    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>Equipe</h1>
                </div>
            </div>
            @include('admin::static.breadcrumb', ['active' => 'Equipe', 'retorno' => 'equipe/listar'])
            <div class="row">
                <div class="col-md-12">

                    @include('admin::static.mensagem')

                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i> Novo Membro
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form" action="{{ url($route) }}" method="post" enctype="multipart/form-data">
                                @if ($put) @include('admin::static.field-put') @endif
                                {!! csrf_field() !!}
                                <div class="form-body">


                                    <div class="form-group">
                                        <label>Nome</label>
                                        <input name="nome" type="text" class="form-control" placeholder="Nome do membro da equipe" value="{{ $dados->nome or old('nome') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Função</label>
                                        <input name="funcao" type="text" class="form-control" placeholder="Função do membro da equipe" value="{{ $dados->funcao or old('funcao') }}">
                                    </div>
     
                                    <div class="form-group">
                                        <label>Descrição</label>
                                        <textarea name="descricao" id="summernote_1">{{ $dados->descricao or old('descricao') }}</textarea>
                                    </div>

                                    @include('admin::static.field-img-destacada', ['tipo' => 'equipe'])

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