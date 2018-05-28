<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Role;

class RoleController extends Controller{

  //retorna todas as funcoes do sistema
  public function roles(){
    $roles = Role::get();
    return $roles;
  }

  public function insert(Request $request){
    $display_name = $request->input('display_name');
    $description = $request->input('description');
    $name = Str::slug($display_name, '_');
    $role = new Role();
    $role->name         = $name;
    $role->display_name = $display_name; // optional
    $role->description  = $description; // optional
    $role->save();
  }

  public function delete(Request $request){
    $id = $request->input('id');

    $role = Role::whereId($id)->delete(); // Pull back a given role

  }

  public function update(Request $request){
    $id = $request->input('id');
    $dados['display_name'] = $request->input('display_name');
    $dados['description'] = $request->input('description');
    $role = new Role();
    $role->where('id', $id)->update($dados);
  }

}
