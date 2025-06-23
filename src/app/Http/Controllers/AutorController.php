<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autor;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class AutorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
           
            $data = Autor::latest()->get();
            
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $actionBtns = '
                        <a href="' . route("autor.edit", $row->id) . '" class="btn btn-outline-info btn-sm"><i class="fas fa-pen"></i></a>
                        
                        <form action="' . route("autor.destroy", $row->id) . '" method="POST" style="display:inline" onsubmit="return confirm(\'Deseja realmente excluir este registro?\')">
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

        return view('autores.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('autores.crud');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $autor = $request->post('autor');
        $nacionalidade = $request->post('nacionalidade');

        $aut = new Autor();
        $aut->autor = $autor;
        $aut->nacionalidade = $nacionalidade;
        $aut->origin_user = $user->name;
        $aut->last_user = $user->name;
        $aut->save();

        return view('autores.index');


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
        $aut = Autor::find($id);

        $output = array(
            'aut' => $aut,
        );

        return view('autores.crud', $output);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $autor = $request->post('autor');
        $nacionalidade = $request->post('nacionalidade');

        $aut = Autor::find($id);
        $aut->autor = $autor;
        $aut->nacionalidade = $nacionalidade;
        $aut->last_user = $user->name;
        $aut->update();

        return view('autores.index');
        // dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $aut = Autor::find($id);
        $aut->delete();

        return view('autores.index');
        // dd($id);
    }
}
