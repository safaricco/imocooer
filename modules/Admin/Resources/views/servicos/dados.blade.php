@extends('admin::static.site')

@section('content')

    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>Serviços</h1>
                </div>
            </div>
            @include('admin::static.breadcrumb', ['active' => 'Serviços', 'retorno' => 'servicos/listar'])
            <div class="row">
                <div class="col-md-12">

                    @include('admin::static.mensagem')

                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i> Novo Serviço
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form" action="{{ url($route) }}" method="post" enctype="multipart/form-data">

                                @if ($put) @include('admin::static.field-put') @endif

                                {!! csrf_field() !!}

                                <div class="form-body">

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>Nome</label>
                                            <input name="nome" type="text" class="form-control" placeholder="Nome do serviço" value="{{ $dados->nome or old('nome') }}">
                                        </div>
                                    </div>
     
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>Descrição</label>
                                            <textarea name="descricao" id="summernote_1">{{ $dados->descricao or old('descricao') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">

                                        <div class="col-md-6">
                                            <label>REF:</label>
                                            <input name="ref" type="text" class="form-control" placeholder="REF" value="{{ $dados->ref or old('ref') }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label>Subcategoria</label>
                                            <select name="id_subcategoria" class="form-control">

                                                @foreach($subcategorias as $sub)

                                                    @if (!empty($dados))

                                                        @if (($sub->id_subcategoria == $dados->idSubcategoria) or ($sub->id_subcategoria == old('idSubcategoria')))
                                                            <option selected value="{{ $sub->id_subcategoria }}">{{ $sub->titulo }}</option>
                                                        @else
                                                            <option value="{{ $sub->id_subcategoria }}">{{ $sub->titulo }}</option>
                                                        @endif

                                                    @else

                                                        <option value="{{ $sub->id_subcategoria }}">{{ $sub->titulo }}</option>

                                                    @endif

                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    @if(!empty($destacada->imagem_destacada))
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="control-label">Imagem Destacada</label>
                                                <div class="col-xs-6 col-md-3">
                                                    <div class="thumbnail">
                                                        <div class="thumbnail">
                                                            <img src="{{ url('uploads/servicos/' . $destacada->imagem_destacada) }}" class="img-responsive form-control">
                                                        </div>
                                                        <a href="{{ url('uploads/servicos/' . $destacada->imagem_destacada) }}" download="{{ url('uploads/servicos/' . $destacada->imagem_destacada) }}" class="btn btn-default" role="button" title="Download"><i class="fa fa-download"></i></a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label class="control-label">Imagem Destacada</label>
                                        <input type="file" value="{{ old('imagem') }}" name="imagem">
                                    </div>

                                    <hr>

                                    @include('admin::static.field-img-atual', ['tipo' => 'servicos'])

                                    <div class="form-group">
                                        <label class="control-label">Imagens</label>
                                        <input type="file" value="{{ old('imagens[]') }}" name="imagens[]" multiple>
                                    </div>

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