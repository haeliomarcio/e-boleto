<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClients;
use App\Models\Client as Model;
use App\Models\Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Carbon\Carbon;
use Exception;

class ClientsController extends Controller
{

    protected $model;
    protected $prefixName = 'clients';

    public function __construct(Model $model) {
        $this->model = $model;        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->input('search') && !empty($request->input('search'))) {
            $search = $request->input('search');
            $context = $this->model->where('name', 'like', "%{$search}%")
                ->orWhere('id', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->paginate(10);
        } else {
            $context = $this->model->paginate(10);
        }
        return view($this->prefixName.'.list', ['list' => $context]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->prefixName.'.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClients $request)
    {
        try {
            $params = $request->all();
            $this->model->create($params);
            return redirect('/'.$this->prefixName)->with('success', 'Cliente criado com sucesso.');
        } catch(Exception $e) {
            return back()->with('error', $e->getMessage());
        }   
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
        $context = $this->model->find($id);
        return view($this->prefixName.'.edit', ['data' => $context]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreClients $request, $id)
    {
        $context = $this->model->find($id);
        $params = $request->all();
        $context->update($params);
        return redirect('/'.$this->prefixName)->with('success', 'Cliente atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $context = $this->model->find($id);
        if($context) {
            if($context->delete()) {
                Storage::disk('site')->delete($context->path_image);
                return back()
                ->with('success', 'Cliente '. $context->name. ' removido com sucesso');
            }
        }
        return back()
            ->with('error', 'Erro ao remover notícia');
    }

    public function carregarClientes() {
        $file = base_path('/files/listaemails.csv');
        $handle = fopen($file, "r");
        $row = 0;
        while ($line = fgetcsv($handle, 1000, ";")) {
            if ($row++ == 0) {
                continue;
            }

            Client::updateOrCreate(
                ['name' => $line[0], 'email' => $line[1]],
                ['name' => $line[0], 'email' => $line[1]]
            );
        }
        fclose($handle);
        return redirect('clients')->with('succcess', 'Clientes Carregados com sucesso.');
    }
}
