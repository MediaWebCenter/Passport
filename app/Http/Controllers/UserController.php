<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\models\User;
use App\Http\Querys\UserQuerys;
//php artisan make::controller UserControler | asi se crea el controlador desde consola
class UserController extends Controller
{

// con Eloquent
     public function normal(){
        $user= User::all();
        return response()->json($user);
    }
    public function getById($id){
      $user= User::find($id);
      return $user;
      }
    
//usando el query builder y separando en un archivo para las consultas con la BBDD
    public function staticQuery(){
      
      return UserQuerys::queryAll();
    }

    public function getOne($id){
      
      return UserQuerys::getById($id);
    }

    public function insertUser(Request $request){
      // Lumen encriptacion https://lumen.laravel.com/docs/5.5/encryption
      //lumen hash https://laravel.com/docs/5.5/hashing
      $hash=  Hash::make($request->input('password'));
      $campos= array(
        'first_name'=> $request->input('first_name'),
        'last_name'=>$request->input('last_name'),
        'email'=>$request->input('email'),
        'password'=>$hash,
        'city'=>$request->input('city'),
        'status'=>$request->input('status')
      );

      
          UserQuerys::insertUser($campos);
          return response()->json('registro con exito');
    }
    public function updatetUser(Request $request, $id){

     $registro=$id;
     $hash=  Hash::make($request->input('password'));
    
      $campos= array(
        'first_name'=> $request->input('first_name'),
        'last_name'=>$request->input('last_name'),
        'email'=>$request->input('email'),
        'password'=>$hash,
        'city'=>$request->input('city'),
        'status'=>$request->input('status')
      );  
          UserQuerys::updatetUser($registro,$campos);
          return response()->json('update con exito');
    }

    public function deleteUser($id){
      
       UserQuerys::deleteUser($id);
      return response()->json('delete con exito');
    }

    
}
