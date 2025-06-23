<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genero;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class GeneroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
           
            $data = Genero::latest()->get();
            
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $actionBtns = '
                        <a href="' . route("genero.edit", $row->id) . '" class="btn btn-outline-info btn-sm"><i class="fas fa-pen"></i></a>
                        
                        <form action="' . route("genero.destroy", $row->id) . '" method="POST" style="display:inline" onsubmit="return confirm(\'Deseja realmente excluir este registro?\')">
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

        return view('generos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('generos.crud');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $genero = $request->post('genero');

        $gender = new Genero();
        $gender->genero = $genero;
        $gender->origin_user =$user->name;
        $gender->last_user = $user->name;
        $gender->save();

        return view('generos.index');


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
        $gender = Genero::find($id);

        $output = array(
            'gender' => $gender,
        );

        return view('generos.crud', $output);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $genero = $request->post('genero');

        $gender = Genero::find($id);
        $gender->genero = $genero;
        $gender->last_user = $user->name;
        $gender->update();

        return view('generos.index');
        // dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $gender = Genero::find($id);
        $gender->delete();

        return view('generos.index');
        // dd($id);
    }
}
