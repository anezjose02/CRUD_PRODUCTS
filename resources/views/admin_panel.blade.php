<!-- Bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
@php
    use App\Models\Productos;
    use App\Models\Compras;
    use App\Models\User;
    use App\Models\Facturas;
    use Illuminate\Support\Facades\DB;
    $facturas = Facturas::select('num_fac', 'created_at')->groupBy('num_fac', 'created_at')->orderBy('created_at')->get();
    
    $users = User::all();
    $productos = Productos::all();
@endphp
<div class="accordion" id="accordionExample">
    
    <div class="card">
      <div class="card-header" id="headingTwo">
        <h2 class="mb-0">
          <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Generar Facturas
          </button>
        </h2>
      </div>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
        <div class="card-body">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Productos por Facturar</th>
                    <th scope="col">Factura</th>

                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $value)
                    <tr>
                        <td>{{$value->id}}</td>
                        <td>{{$value->name}}</td>
                        @php
                            $compras_realizadas = Compras::select('*')->where('id_user', $value->id)->where('status', '0')->get();
                        @endphp
                        <td>{{count($compras_realizadas)}}</td>
                        <td>  <a class="btn btn-primary" href="/factura/{{ $value->id}}/edit" role="button">Generar Factura</a></td>
                    @endforeach
                </tbody>
              </table>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="headingTwo">
        <h2 class="mb-0">
          <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseView" aria-expanded="false" aria-controls="collapseTwo">
            Ver Facturas
          </button>
        </h2>
      </div>
      <div id="collapseView" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
        <div class="card-body">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Numero de Factura</th>
                    <th scope="col">Fecha de Creacion</th>
                    <th scope="col">Ver Factura</th>

                  </tr>
                </thead>
                <tbody>
                    @foreach ($facturas as $value)
                    <tr>
                        <td>{{$value->num_fac}}</td>
                        <td>{{$value->created_at}}</td>
                        <td> <a class="btn btn-primary" href="/showFacturas/{{ $value->num_fac}}" role="button">Ver Factura</a></td>
                    @endforeach
                </tbody>
              </table>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" id="headingThree">
        <h2 class="mb-0">
          <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
           Lista de Productos
          </button>
        </h2>
      </div>
      <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
        <div class="card-body">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Agregar Productos
            </button>
            <br>
            <br>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col" class="text-center">Producto</th>
                    <th scope="col" class="text-center">Precio</th>
                    <th scope="col" class="text-center">Impuesto</th>
                    <th scope="col" class="text-center">Action</th>

                  </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $listP)
                    <tr>
                        <td class="text-center">{{$listP->id}}</td>
                        <td class="text-center">{{$listP->name}}</td>
                        <td class="text-center">{{$listP->price}}</td>
                        <td class="text-center">{{$listP->tax}}%</td>
                        
                        
                        <td class="text-center">
                            <form action="{{ route ('admin_panel.destroy', $listP->id)}}" method="POST">
                                <a class="btn btn-success" href="/admin_panel/{{ $listP->id}}/edit" role="button">Editar</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                </button>
                                </form>
                            </td>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{action('App\Http\Controllers\ProductosController@store')}}" method="POST">
            @csrf
            <div class="modal-body">
                  <div class="mb-3">
                    <label for="" class="form-label">Producto</label>
                    <input id="name" name="name" type="text" class="form-control" required>    
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Precio</label>
                    <input id="price" name="price" type="text" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Impuesto %</label>
                    <input id="tax" name="tax" type="text" class="form-control" required>
                  </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-outline-primary" data-bs-dismiss="modal" style="width: 200px; width: 200px;"><i class="ficon" data-feather='save'></i><strong>GUARDAR</strong></button>
            </div>
          </form>
      </div>
    </div>
  </div>