@extends('template.app')
@section('content')
    <div class="container mt-5">
        <div class="jumbotron">
            <h1 class="display-4">{{$client->nome_empresa}}</h1>
            <p class="lead">{{$client->nome_responsavel}}</p>
            <hr class="my-4">
            <p>{{$client->email}} / {{$client->telefone}}</p>
            <hr class="my-4">
            <p>{{$client->cnpj}}</p>
        </div>
        <table id="show_client" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Endereços</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($client->adress()->get() as $adress)
                <tr>
                    <td >
                        <span class="text-nowrap font-weight-bold" style="font-size: 14px">
                            {{$adress->cep}}/{{$adress->bairro}}/{{$adress->complemento}}/{{$adress->cidade}}-{{$adress->estado}}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Endereço</th>
                </tr>
            </tfoot>
        </table>
    </div>

@endsection

@section('script')

<script src="{{asset('site/jquery.js')}}" ></script>
<script src="{{asset('site/datatables.js')}}" ></script>
<script>
$(document).ready(function() {
    $('#show_client').DataTable( {
    } );
} );

</script>
@endsection
