@extends('template.app')

@section('content')
<form action="{{route('client.update',$client->id)}}" method="post">

    @csrf
    @method('put')
    <div class="form-group">
        <label for="email">Email </label>
        <input type="email" class="form-control" id="email" name="email" value="{{$client->email}}">
    </div>
    <div class="form-row">
        <div class="form-group col-6">
            <label for="nome_empresa">Empresa </label>
            <input type="text" class="form-control" id="nome_empresa" name="nome_empresa" value="{{$client->nome_empresa}}">
        </div>
        <div class="form-group col-6">
            <label for="cnpj">cnpj </label>
            <input type="text" class="form-control" id="cnpj" name="cnpj"  value="{{$client->cnpj}}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-6">
            <label for="telefone">telefone </label>
            <input type="text" class="form-control" id="telefone" name="telefone" value="{{$client->telefone}}">
        </div>
        <div class="form-group col-6">
            <label for="nome_responsavel">Responsável </label>
            <input type="text" class="form-control" id="nome_responsavel" name="nome_responsavel" value="{{$client->nome_responsavel}}">
        </div>
    </div>
    <div class="form-row">
    @for ($i = 0; $i < count($adress); $i++)
    <div class="btn-group btn-group-toggle " data-toggle="buttons">
            @if ($adress[$i]->isPrimary == 1)
            <div class="form-row">
                <label for="nome_responsavel">Endereço Principal </label>
            </div>
            <input type="hidden" name="isPrimary[]" id="option1" value="sim" class='active' >
            @else
            <div class="form-row">
                <label for="nome_responsavel">Outros Endereços </label>
            </div>
            <input type="hidden" name="isPrimary[]" id="option1" value="não"  class='active'>
            @endif
        <input type="hidden" name="id" value='{{$adress[$i]->id}}'>
      </div>
            <div class="form-group col-4 ml-3 ">
                <label for="nome_responsavel">Cep </label>
                <input type="text" class="form-control" name="cep[]" value="{{$adress[$i]->cep}}">
            </div>

            <div class="form-group col-4 ml-3 ">
                <label for="complemento">Complemento </label>
                <input type="text" class="form-control" name="complemento[]" value="{{$adress[$i]->complemento}}">
            </div>
            <div class="form-group col-1 ml-3 ">
                <label for="numero">Numero</label>
                <input type="text" class="form-control" name="numero[]" value="{{$adress[$i]->numero}}">
            </div>
    @endfor
</div>
      <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
