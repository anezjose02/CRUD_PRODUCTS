@php
    use App\Models\Compras;
    use App\Models\Productos;
    $subTotal = 0;
@endphp
<x-app-layout>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-4">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="page_pdf">
                                    <table id="factura_cliente">
                                        <tr>
                                            <td class="info_cliente">
                                                <div class="round">
                                                    <span class="h3">Usuario: {{$user->name}}</span>
                                                    <table class="datos_cliente">
                                                        <tr>
                                                            <td><label>ID User:</label>{{$user->id}} </td>
                                                            <td><label>Correo:</label>{{$user->email}} </td>
                                                        </tr>
                                                        @php
                                                                $compras_realizadas = Compras::select('*')->where('id_user', $user->id)->get();
                                                        @endphp
                                                        <tr>
                                                            <td><label>Nº Compras:</label>{{count($compras_realizadas)}} </td>
                                                            
                                                        </tr>
                                                    </table>
                                                </div>
                                            </td>
                                
                                        </tr>
                                    </table>
                                
                                    <table id="factura_detalle">
                                        <span class="h3">Detalle de la Factura</span>
                                            <thead>
                                                <tr>
                                                    <th>Producto</th>
                                                    <th>Precio Unitario</th>
                                                    <th>Impuesto</th>
                                                    <th>Precio Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="detalle_productos">
                                                @foreach ($compras_realizadas as $value)
                                                @php
                                                    $producto = Productos::select('*')->where('id', $value->id_product)->first();
                                                @endphp
                                                <tr>
                                                    <td>{{$producto->name}}</td>
                                                    <td>{{$producto->price}}$</td>
                                                    <td>{{$producto->tax}}%</td>
                                                    @php
                                                        $precioFinal = ($producto->price)+($producto->price*($producto->tax/100));
                                                        $subTotal = round($precioFinal, 2) + $subTotal;
                                                    @endphp
                                                    <td>{{round($precioFinal, 2)}}$</td>
                                                </tr>
                                                @endforeach 
                                            
                                            </tbody>
                                            
                                    </table>
                                    <table id="factura_detalle">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                
                                                <th colspan="4" class="textcenter">Sub Total:       {{$subTotal}}$</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <div>
                                        
                                        <h4 class="label_gracias">¡Gracias por su compra!</h4>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
