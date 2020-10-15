<?php

namespace App\Http\Controllers;

use App\Http\Requests\historytore;
use Illuminate\Http\Request;
use App\Models\History as Model;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{

    protected $model;
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
            $context = $this->model
                ->join('clients as c', 'c.id', 'history.client_id')
                ->orWhere('c.id', 'like', "%{$search}%")
                ->orWhere('c.name', 'like', "%{$search}%")
                ->orWhere('c.email', 'like', "%{$search}%")
                ->orWhere('history.competence', 'like', "%{$search}%")
                ->orWhere('history.status', 'like', "%{$search}%")
                ->paginate(10);
        } else {
            $context = $this->model->paginate(10);
        }
        return view('history.list', ['list' => $context]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('history.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(historytore $request)
    {
        $this->model->create($request->all());
        return redirect('history')->with('success', 'Loja criado com sucesso.');
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
        $context = DB::table('store as sto')
            ->select('sto.*', 'state.id as state_id')
            ->join('city', 'city.id', 'sto.city_id')
            ->join('state', 'state.id', 'city.state_id')
            ->where('sto.id', $id)
            ->get()->first();

        return view('history.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Store $request, $id)
    {
        $context = $this->model->find($id);
        $context->update($request->all());
        return redirect('/history')->with('success', 'Loja atualizado com sucesso.');
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
                return back()
                ->with('success', 'History '. $context->name. ' removido com sucesso');
            }
        }
        return back()
            ->with('error', 'Erro ao remover loja');
        
    }
}
