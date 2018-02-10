<?php

namespace App\Http\Querys;
use Illuminate\Support\Facades\DB;


 class UserQuerys 
{
    static function queryAll(){

        $users = DB::table('users')->select('first_name', 'last_name','email','city','status')->get();
        return response()->json($users);
      }

    static function getById($id){
         $users= DB::table('users')
                    ->select('first_name', 'last_name','email','city','status')
                    ->where('id', $id);
         
         return response()->json($users);
         /*->select('first_name', 'last_name','email','city','status')
                                    ->where('id', $id)
                                    ->first();*/

    }  

    static function insertUser($input){
       
        $users = DB::table('users')->insert($input);
       
      }
      static function updatetUser($id, $input){
       
        DB::table('users')
        ->where('id', $id)
        ->update($input);
      }
      static function deleteUser($id){
       
        DB::table('users')->where('id', $id)->delete();
       
      }

    

}