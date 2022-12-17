@php
    use App\Models\Compras;
    use App\Models\Productos;
    $compras_realizadas = Compras::select('*')->where('id_user', $user->id)->where('status', '0')->get();
@endphp
<x-app-layout>
    <!-- Bootstrap -->
    
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-4">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table" id="usuarios">
                                    <thead>
                                        <tr>
                                          <th scope="col">ID</th>
                                          <th scope="col">Producto</th>
                                          <th scope="col">Precio</th>
                                          <th scope="col">Impuestos</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach ($compras_realizadas as $value)
                                        <tr>
                                            @php
                                                    $producto = Productos::select('*')->where('id', $value->id_product)->first();
                                                @endphp
                                                <tr>
                                                    <td>{{$producto->id}}</td>
                                                    <td>{{$producto->name}}</td>
                                                    <td>{{$producto->price}}$</td>
                                                    <td>{{$producto->tax}}%</td>
                                           
                                        @endforeach
                                    </tbody>
                                </table>
                                
                                    <input type="hidden" name="id_user" id="id_user" value="{{$user->id}}">
                                    <div id="target">
                                        <button class="btn btn-outline-primary" data-bs-dismiss="modal" style="width: 200px; width: 200px;"><i class="ficon" data-feather='save'></i><strong>GUARDAR</strong></button>
                                    </div>
                                    
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        $( "#target" ).click(function() {
            let id_user = $('#id_user').val();
            console.log('====================================');
            console.log(id_user);
            console.log('====================================');
            $.ajax({
                type: 'get',
                url:  '{{URL::to('storefactura')}}',
                data:  {id_user: id_user},
                success: function (response) {
                    window.location.href = "/dashboard";
                    }
                }
                );
        });
        
        </script>
    
</x-app-layout>
