<?php

namespace App\Repository\UsersRepository;
use Illuminate\Support\Facades\Hash;

//las consultar al modelo se separan en el repository el modelo no se usa en lumen
class UsersRepository{
    // desarrollamos el CRUD
    //ver todos los usuarios
    public function getAll(){
        $user= User::all();
        return $user;
    }
    //ver un usuario por Id
    public function getById($id){
        $user= User::find($id);
        return $user;
    }
   
    //insertar un usuario
    public function insertUser($input){
        $user= new User();
        $user= User::All();
        $user->first_name= input('first_name');
        $user->last_name= input('last_name');
        $user->email= input('email');
        $user->password= Hash::make(input('password'));
        $user->city= input('city');
        $user->status= input('status');
        $user->save();

        
    }
   //actualizar un usuario
    public function updateUser($id, $input){
        $user= User::find($id);
        $user->first_name= input('first_name');
        $user->last_name= input('last_name');
        $user->email= input('email');
        $user->password= Hash::make(input('first_name'));
        $user->city= input('city');
        $user->status= input('status');
        $user->save();
       
    }
    // actualizar todos los usuarios
    public function deleteUser($id){
        $user= User::find($id);
        $user->delete();
    }


}