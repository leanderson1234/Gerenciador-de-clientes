@extends('template.app')

@section('content')
     <form method="post" class="form" action="{{route('client.store')}}">

        @csrf
        <div class="form-group">
            <label for="email">Email </label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="form-row">
            <div class="form-group col-6">
                <label for="nome_empresa">Empresa </label>
                <input type="text" class="form-control" id="nome_empresa" name="nome_empresa">
            </div>
            <div class="form-group col-6">
                <label for="cnpj">cnpj </label>
                <input type="text" class="form-control" id="cnpj" name="cnpj">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-6">
                <label for="telefone">telefone </label>
                <input type="text" class="form-control" id="telefone" name="telefone">
            </div>
            <div class="form-group col-6">
                <label for="nome_responsavel">Responsável </label>
                <input type="text" class="form-control" id="nome_responsavel" name="nome_responsavel">
            </div>
        </div>
        <div class="form-row">
            <label for="nome_responsavel">Endereço Principal </label>
        </div>
        <a class="btn btn-dark mb-2" id="clonar"><i class="fa fa-plus-circle"></i></a>
        <div class="form-group destino">
            <div class="form-row">
                 <div class="btn-group btn-group-toggle " data-toggle="buttons">
                      <input type="hidden" name="isPrimary[]" id="option1" value='sim'  class='active'>
                  </div>

                <div class="form-group col-4 ml-3 ">
                    <label for="nome_responsavel">Cep </label>
                    <input type="number" class="form-control" name="cep[]">
                </div>
                <div class="form-group col-4 ml-3 ">
                    <label for="complemento">Complemento </label>
                    <input type="text" class="form-control" name="complemento[]">
                </div>
                <div class="form-group col-1 ml-3 ">
                    <label for="numero">Numero</label>
                    <input type="text" class="form-control" name="numero[]">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary sub">Submit</button>

        </form>



@endsection

@section('script')
    <script src="{{ asset('site/jquery.js') }}"></script>

    <script>
        caunt = 1
        $("#clonar").click(function() {
            caunt++
            $(".destino").append(
                "<div id='campo" + caunt + "' class='form-group '> " +
                    "<div class='mr-2 form-row'> " +
                "<div class='mr-2 form-group'> " +
                "<a id='" + caunt + "' class='btn-apagar btn btn-dark mt-2'><i class='fa fa-minus-circle'></i></a>" +
                "</div>" +
                "</div>" +
                "<label for='cep'>Outros Endereços </label>" +
                "<div class='mr-2 form-row'> " +
                        "<div class='btn-group btn-group-toggle' data-toggle='buttons'>"+
                            " <input type='hidden' name='isPrimary[]'  value='nao' id='option2' class='active'> "+
                    "</div>"+
                "<div class='form-group col-4 ml-3'>" +
                "<label for='cep'>Cep </label>" +
                "<input type='number' class='form-control' ' name='cep[]'>" +
                "</div>" +
                "<div class='form-group col-4 ml-3'>" +
                "<label for='complemento'>Complemento </label>" +
                "<input type='text' class='form-control' ' name='complemento[]'>" +
                "</div>" +
                "<div class='form-group col-1 ml-3'>" +
                "<label for='numero'>Numero </label>" +
                "<input type='text' class='form-control' ' name='numero[]'>" +
                "</div>" +
                "</div>" +
                "</div>"
            )
        });

        $("form").on("click", '.btn-apagar', function() {
            button_id = $(this).attr("id");
            $('#campo' + button_id).remove();
        });
    </script>

@endsection
