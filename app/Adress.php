<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adress extends Model
{
    protected $table = 'enderecos';
    protected $fillable =['cep','logradouro','bairro','complemento','numero','cidade','estado','isPrimary','clients_id'];
    public function client()
    {
        return $this->belongsTo(Client::class, 'clients_id', 'id');
    }
}
