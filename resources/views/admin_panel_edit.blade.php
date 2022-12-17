<x-app-layout>
    <!-- Bootstrap -->
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
                              <form action="/admin_panel/{{$productos->id}}" method="POST">    
                                @csrf
                                @method('PUT')
                               <div class="mb-3">
                                 <label for="" class="form-label">Producto</label>
                                 <input id="name" name="name" type="text" class="form-control" value="{{$productos->name}}">    
                               </div>
                               <div class="mb-3">
                                 <label for="" class="form-label">Precio</label>
                                 <input id="price" name="price" type="text" class="form-control" value="{{$productos->price}}">
                               </div>
                               <div class="mb-3">
                                <label for="" class="form-label">Impuesto</label>
                                <input id="tax" name="tax" type="text" class="form-control" value="{{$productos->tax}}">
                              </div>
                               
                               <a href="/dashboard" class="btn btn-outline-warning" style="width: 200px; width: 200px;"><strong>Cancelar</strong></a>
                               <button class="btn btn-outline-primary" style="width: 200px; width: 200px;"><strong>Guardar</strong></button>
                             </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
