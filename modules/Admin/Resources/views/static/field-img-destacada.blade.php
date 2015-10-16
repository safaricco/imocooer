@if(!empty($destacada->imagem_destacada))
    <div class="form-group">
        <label class="control-label">Imagens atuais:</label>
        <div class="row">
            <div class="col-xs-6 col-md-3">
                <div class="thumbnail">
                    <div class="thumbnail">
                        <img src="{{ url('admin/thumb/348/null/' . $tipo . '/' . $destacada->imagem_destacada) }}" class="img-responsive">
                    </div>
                    <a data-rel="fancybox-button" href="{{ Module::asset('admin:uploads/' . $tipo . '/' . $destacada->imagem_destacada) }}" class="btn btn-primary fancybox-button" role="button" title="Visualizar"><i class="fa fa-eye"></i></a>
                    <a href="{{ Module::asset('admin:uploads/' . $tipo . '/' . $destacada->imagem_destacada) }}" download="{{ $destacada->imagem_destacada }}" class="btn btn-default" role="button" title="Download"><i class="fa fa-download"></i></a>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="form-group">
    <label class="control-label">Imagem destacada</label>
    <input type="file" value="{{ old('imagem') }}" name="imagem">
</div>