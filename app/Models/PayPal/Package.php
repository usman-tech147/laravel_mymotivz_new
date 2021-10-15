<?php

namespace App\Models\PayPal;

use App\NewClient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    public function newClients(){
        return $this->belongsToMany(NewClient::class,'client_packages')
            ->withPivot('id','username','password','subscribed_at','updated_at',
                'created_at','subscribed_status','renewal_status','payment_method',
                'subscription_id','expired_at','billing_agreement_id','payment_by',
                'error_message','frequency','interval_count');
    }
}
