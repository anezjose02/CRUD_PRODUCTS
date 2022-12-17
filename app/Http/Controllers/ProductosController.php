<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    public function search(Request $request)
    {
        if($request->ajax())
                {
                $output=$request->producto;
                $producto = Productos::select('*')->where('id', $output)->first();
                //$cliente= Cliente::where('documento',$output)->firts();
                if($producto){
                    return Response($producto);
                }
                }  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productos = new Productos();

        $productos->name = $request->name;
        $productos->price = $request->price;
        $productos->tax = $request->tax;
        
       
        $productos->save();

        return redirect('/dashboard');   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function show(Productos $productos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productos = Productos::find($id);
        return view('admin_panel_edit')->with('productos',$productos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $productos = Productos::find($id);

        $productos->name = $request->get('name');
        $productos->price = $request->get('price');
        $productos->tax = $request->get('tax');

        $productos->save();

        return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Productos::find($id)->delete();
        return redirect()->route('dashboard');
    }
}
