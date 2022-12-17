 <!-- Bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
@php
    use App\Models\Productos;
    $productos = Productos::all();
@endphp
<div class="card">
    <div class="card-header">
      Lista de Productos
    </div>
    <div class="card-body"> 
        <form action="{{action('App\Http\Controllers\ComprasController@store')}}" method="POST">
        <div class="row d-flex align-items-end">
           
                @csrf
          <input type="hidden" name="user" id="user" value="{{Auth::user()->id}}">
            <div class="col-md-4 col-12">
                <div class="mb-1">
                  <label class="form-label">Productos</label>
                  <select class="form-control" id="producto" name="producto" required>
                    <option></option>
                    @foreach ($productos as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
                </div>
              </div>
              <div class="col-md-4 col-12">
                <div class="mb-1">
                  <label class="form-label">Precio</label>
                  <input id="precio" name="precio" type="text" class="form-control" tabindex="1" disabled> 
                </div>
              </div>
              <div class="col-md-4 col-12">
                <div class="mb-1">
                  <label class="form-label">Impuesto en %</label>
                  <input id="impuesto" name="impuesto" type="text" class="form-control" tabindex="1" disabled >
                </div>
              </div>
              <br>
              <br>
              <div class="col-md-4 col-12">
                <div class="mb-1">
                    <button class="btn btn-outline-primary" data-bs-dismiss="modal" style="width: 200px; width: 200px;"><strong>Comprar</strong></button>
                </div>
              </div>
        
        </div>
    </form>
        
  </div>
  <script>

$( "select" )
  .change(function () {
    let producto = $('#producto').val();
    $.ajax({
         type: 'get',
         url:  '{{URL::to('search')}}',
         data:  {producto: producto},
         success: function (response) {
            console.log('====================================');
            console.log(response);
            console.log('====================================');
            $('#precio').val(response.price);
            $('#impuesto').val(response.tax);
            }
         }
        );
  });
  
    </script>