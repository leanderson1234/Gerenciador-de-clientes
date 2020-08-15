@extends('template.app')
@section('content')
    <div class="container">
        <a class="btn btn-dark" href="{{route('client.create')}}">Cadastrar <i class="fa fa-plus-circle"></i></a>
    </div>
    <div class="container mt-5">
        <table id="management_client" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Empresa</th>
                    <th>CNPJ</th>
                    <th>Telefone</th>
                    <th>Responsável</th>
                    <th>Email</th>
                    <th>Endereço</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients->items() as $client)
                {{-- @include('includes.modal') --}}
                        {{-- {{$adresses->get()}} --}}
                {{-- @includeFirst(['includes.modal', 'adresses'], ['data' => $adresses]) --}}
                <tr>
                    <td>{{$client->nome_empresa}}</td>
                    <td>{{$client->cnpj}}</td>
                    <td>{{$client->telefone}}</td>
                    <td>{{$client->nome_responsavel}}</td>
                    <td>{{$client->email}}</td>

                    <td >
                        {{-- <button type="button" class="btn btn-dark modall" data-toggle="modal"  data-target="#exampleModal">
                            Endereço
                          </button> --}}
                @foreach ($client->adress()->get() as $adress)
                    @if($adress->isPrimary == '1')
                        <span class="text-nowrap font-weight-bold" style="font-size: 14px">
                            {{$adress->cep}}/{{$adress->bairro}}/{{$adress->complemento}}/{{$adress->cidade}}-{{$adress->estado}}
                        </span>
                    @endif
                @endforeach


                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <a  class='btn btn-dark' href='{{route('client.edit',['client'=> $client->id])}}'><i class="fa fa-user-edit"></i></a>
                            <a  class='btn btn-dark' href='{{route('client.show',['client'=> $client->id])}}'><i class="fa fa-eye"></i></a>
                            <form action='{{ route('client.destroy',['client'=> $client->id]) }}' method='post'>
                                @method('delete')
                                @csrf
                                <button type='submit'  class='btn btn-danger' ><i class="fa fa-user-times"></i></button>
                            </form>
                          </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Empresa</th>
                    <th>CNPJ</th>
                    <th>Telefone</th>
                    <th>Responsável</th>
                    <th>Email</th>
                    <th>Endereço</th>
                    <th>Opções</th>
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
    $('#management_client').DataTable( {
    } );
} );

// $('#exampleModal').on('shown.bs.modal', function () {
//   $('#teste').trigger('focus')
// })
</script>
@endsection
