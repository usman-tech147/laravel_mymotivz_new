<?php

namespace App\Models\PayPal;

use App\NewClient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class ClientPackage extends Authenticatable
{
    use HasFactory, Notifiable,HasApiTokens;
    protected $table='client_packages';
    public function package(){
        return $this->belongsTo(Package::class);
    }
    public function newClients(){
        return $this->belongsTo(NewClient::class);
    }
}
