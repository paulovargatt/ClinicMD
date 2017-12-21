<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function usuarios(){
        $users = User::paginate()
                    ->where('email','!=','pvargatt@gmail.com');

        return view('usuarios.usuarios', compact('users'));
    }

    public function usuariosEdit(Request $request, $id){
        $user = User::find($id);
        return view('usuarios.edit',compact('user'));
    }

    public function usuariosUpdate(Request $request, $id){
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->type = $request->type;
        $user->update();
        return redirect()->back()->with("success","Atualizado com sucesso");
    }

    public function usuariosNovo(){
     return view('usuarios.new');
    }

    public function usuariosNew(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->type = $request->type;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect('/user/'.$user->id.'')->with("success","Usuário Criado Com Sucesso!");
    }






    //CHANGE PASSWORD
    public function changePassword(Request $request){
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            return redirect()->back()->with("error","Insira as senhas corretamente");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            return redirect()->back()->with("error","Digite a senha atual");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success","Sua senha foi alterar com sucesso !");
    }

    public function senha(){
        return view('alterar-senha');
    }
}
