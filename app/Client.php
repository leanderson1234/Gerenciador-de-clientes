<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['id','nome_empresa','email','cnpj','telefone','nome_responsavel'];

    public function adress(){
        return $this->hasMany(Adress::class, 'clients_id', 'id');
    }
}
