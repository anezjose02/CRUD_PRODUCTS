<?php

namespace App\Http\Controllers;
use App\Models\Compras;
use App\Models\Facturas;
use App\Models\User;
use Illuminate\Http\Request;

class FacturasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function storefactura(Request $request)
    {
        if($request->ajax())
                {
                $output=$request->id_user;
                $numero_factura = rand();
                $compras_realizadas = Compras::select('id')->where('id_user', $output)->where('status', '0')->get();
                foreach ($compras_realizadas as $key ) {
                    $facturas = new Facturas();
                    $facturas->id_purchase = $key->id;
                    $facturas->num_fac = $numero_factura;
                    $facturas->save();
                }

                foreach ($compras_realizadas as $value) {
                    $post = Compras::where('id', $value->id)->update(
                        ['status' => '1'
                        ]
                        );
                }
                
                
                return Response($output);
                }  
       
     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facturas  $facturas
     * @return \Illuminate\Http\Response
     */
    public function show(Facturas $facturas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facturas  $facturas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('factura.edit')->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facturas  $facturas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Facturas $facturas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facturas  $facturas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facturas $facturas)
    {
        //
    }
}
