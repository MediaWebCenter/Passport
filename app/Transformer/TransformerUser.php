<?php

namespace App\Transformer;
use League\Fractal\TransformerAbstract;

//se usa para saltar la logica de eloquent y mostrar los campos que deseamos mostrar


class TransformerUser extends TransformerAbstract
{
 function transform(User $user){
     return[
       
        'id'=>$user->id,
        'first_name'=>$user->first_name,
        'last_name'=>$user->last_name,
        'email'=>$user->email,
        'city'=>$user->city,
        'status'=>$user->status
       
    ];

 }

}