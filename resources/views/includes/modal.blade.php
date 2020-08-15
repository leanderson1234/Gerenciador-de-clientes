<div class="modal" tabindex="-1"  id="exampleModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Endereços</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h1>Endereço principal</h1>
          @foreach ($adresses as $adress)
            @foreach ($adress as $item)
                @if($item->isPrimary === '1')
                    <p>{{$item->cep}}</p>
                    <p>{{$item->bairro}}</p>
                    <p>{{$item->complemento}}</p>
                    <p>{{$item->cidade}}</p>
                    <p>{{$item->estado}}</p>
                @endif
            @endforeach
          @endforeach

          <h2>Endereços secundarios</h2>
          @foreach ($adresses as $adress)
            @foreach ($adress as $item)
                @if($item->isPrimary === '0')
                    {{$item}}
                @endif
            @endforeach
          @endforeach

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
