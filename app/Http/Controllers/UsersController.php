<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use App\Services\UsersServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;


class UsersController extends Controller
{
    protected $services;
    public function __construct(UsersServices $services) {
        $this->services = $services;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($this->services->isCheckPermission('users', 'admin')) {
            return $this->services->redirectUserNotAuthorization();
        }
        if($request->input('search') && !empty($request->input('search'))) {
            $search = $request->input('search');
            $users = User::where('name', 'like', "%{$search}%")
                ->orWhere('id', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->paginate(10);
        } else {
            $users = User::paginate(10);
        }
        return view('users.list', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ($this->services->isCheckPermission('users', 'admin')) {
            return $this->services->redirectUserNotAuthorization();
        }
        return view('users.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        if ($this->services->isCheckPermission('users', 'admin')) {
            return $this->services->redirectUserNotAuthorization();
        }
        User::create($request);
        return redirect('users.list')->with('success', 'Usuário criado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($this->services->isCheckPermission('users', 'admin')) {
            return $this->services->redirectUserNotAuthorization();
        }
        $user = User::find($id);
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, $id)
    {
        if ($this->services->isCheckPermission('users', 'admin')) {
            return $this->services->redirectUserNotAuthorization();
        }
        $user = User::find($id);
        if($request->input('password')) {
            $validator = Validator::make($request->all(), [
                'password' => 'required|min:6',
                'password_confirmation' => 'required|confirmed|min:6'
            ]);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $user->password = Hash::make($request->input('password'));
        }

        $user->name = $request->input('name');    
        $user->email = $request->input('email');  
        $user->type = $request->input('type');  
        $user->save();
        return redirect('/dashboard/users')->with('success', 'Usuário atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->services->isCheckPermission('users', 'admin')) {
            return $this->services->redirectUserNotAuthorization();
        }
        $user = User::find($id);
        
        if($user) {
            if($user->delete()) {
                return back()
                ->with('success', 'Usuário '. $user->name. ' removido com sucesso');
            }
        }
        return back()
            ->with('error', 'Erro ao remover usuário');
        
    }
}
