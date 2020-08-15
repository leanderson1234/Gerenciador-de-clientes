<?php

namespace App\Http\Controllers;

use App\Adress;
use App\Client;
use App\Http\Requests\UpdateStoreClient;
use App\Http\Requests\UpdateStoreEndereco;

use App\Http\Services\ViaCep;

class ClientController extends Controller
{
    private $client;
    private $apiCep;
    private $adressModel;
    public function __construct(Client $client,ViaCep $apiCep,Adress $adresses){
        $this->client = $client;
        $this->apiCep = $apiCep;
        $this->adressModel = $adresses;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Client $client)
    {
        $clients = $client->paginate();
        return view('admin.index',['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\UpdateStoreClient  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdateStoreClient $request)
    {
        $client = $this->client->create(
            $request->only(['nome_empresa','email','cnpj','telefone','nome_responsavel']));

        $adress = $this->apiCep->getAdresses($request->only('cep'));
            foreach ($request->only('isPrimary') as $key => $value) {

                foreach ($value as $key => $primary) {

                    if($primary === 'sim'){
                        $isPrimary[] = 1;
                    }else{
                        $isPrimary[] = 0;
                    }
                }
            }
        foreach ($adress as $key => $adres) {

            $createAdress[] = [
                'clients_id' => $client->id,
                'cep'=>$adres->cep,
                'logradouro' =>$adres->logradouro,
                'bairro'=>$adres->bairro,
                'complemento'=>$request->only('complemento')['complemento'][$key],
                'numero'=> $request->only('numero')['numero'][$key],
                'cidade'=>$adres->localidade,
                'estado'=>$adres->uf,
                'isPrimary' =>$isPrimary[$key],
            ];
        }
        foreach ($createAdress as $adres) {
            $this->adressModel->create($adres);
        }

        return redirect()->route('client.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {

        return view('admin.show',['client'=>$client]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('admin.edit',['client'=>$client,'adress'=>$client->adress()->get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateStoreClient  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStoreClient $request, Client $client,Adress $adressUpdate)
    {
        $client->update(
            $request->only(['nome_empresa','email','cnpj','telefone','nome_responsavel'])
        );
        $adress = $this->apiCep->getAdresses($request->only('cep'));
        foreach ($request->only('isPrimary') as $key => $value) {

            foreach ($value as $key => $primary) {

                if($primary === 'sim'){
                    $isPrimary[] = 1;
                }else{
                    $isPrimary[] = 0;
                }
            }
        }
    foreach ($adress as $key => $adres) {
        // $clientUpdate = $request->only(['nome_empresa','email','cnpj','telefone','nome_responsavel']);

        $UpdateAdress[] = [
            // 'nome_empresa' => $clientUpdate['nome_empresa'],
            // 'email' => $clientUpdate['email'],
            // 'cnpj' => $clientUpdate['cnpj'],
            // 'telefone' => $clientUpdate['telefone'],
            // 'nome_responsavel' => $clientUpdate['nome_responsavel'],
            'clients_id' => $client->id,
            'cep'=>$adres->cep,
            'logradouro' =>$adres->logradouro,
            'bairro'=>$adres->bairro,
            'complemento'=>$request->only('complemento')['complemento'][$key],
            'numero'=> $request->only('numero')['numero'][$key],
            'cidade'=>$adres->localidade,
            'estado'=>$adres->uf,
            'isPrimary' =>$isPrimary[$key],
        ];
    }
    foreach ($UpdateAdress as $adres) {

        $teste = $adressUpdate->where('id','=',$request->only('id')['id'])->update($adres);

    }

        return redirect()->route('client.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $this->adressModel->where('clients_id', '=', $client->id)->delete();
        $client->delete();
        return redirect()->route('client.index');
    }
}
