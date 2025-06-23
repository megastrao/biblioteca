<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;


class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
           
            $data = Cliente::latest()->get();
            
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $actionBtns = '
                        <a href="' . route("cliente.edit", $row->id) . '" class="btn btn-outline-info btn-sm"><i class="fas fa-pen"></i></a>
                        
                        <form action="' . route("cliente.destroy", $row->id) . '" method="POST" style="display:inline" onsubmit="return confirm(\'Deseja realmente excluir este registro?\')">
                            ' . csrf_field() . '
                            ' . method_field("DELETE") . '
                            <button type="submit" class="btn btn-outline-danger btn-sm ml-2")><i class="fas fa-trash"></i></button>
                        </form>
                    ';
                    return $actionBtns;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('clientes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.crud');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $nome = $request->post('nome');
        $cpf = $request->post('cpf');
        $cep = $request->post('cep');
        $email = $request->post('email');

        $clint = new Cliente();
        $clint->nome = $nome;
        $clint->cpf = $cpf;
        $clint->cep = $cep;
        $clint->email = $email;
        $clint->origin_user = $user->name;
        $clint->last_user = $user->name;
        $clint->save();

        return view('clientes.index');


        // dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // dd($id);
        $clint = Cliente::find($id);

        $output = array(
            'clint' => $clint,
        );

        return view('clientes.crud', $output);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $nome = $request->post('nome');
        $cpf = $request->post('cpf');
        $cep = $request->post('cep');
        $email = $request->post('email');

        $clint = Cliente::find($id);
        $clint->nome = $nome;
        $clint->cpf = $cpf;
        $clint->cep = $cep;
        $clint->email = $email;
        $clint->last_user = $user->name;
        $clint->update();

        return view('clientes.index');
        // dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $clint = Cliente::find($id);
        $clint->delete();

        return view('clientes.index');
        // dd($id);
    }
}
