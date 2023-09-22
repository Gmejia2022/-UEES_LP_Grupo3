<!-- script para poder darle un click a la imagen y que se abra en una ventana emergente -->
<script>
    function openPopup(imageUrl) {
        var width = 800; // Ancho de la ventana emergente
        var height = 600; // Alto de la ventana emergente
        var left = (window.innerWidth - width) / 2;
        var top = (window.innerHeight - height) / 2;
        var options = 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left + ',resizable=yes';
        window.open(imageUrl, 'Image Popup', options);
        }
</script>

@extends('layouts.app')

@section('content')
<div class="container-fluid">

@if(Session::has('mensaje'))
    {{ Session::get('mensaje')}}
@endif

<h1> Maestro de Personas Registradas </h1>
<br>
<a href="{{ url('personas/create') }}" class="btn btn-success">Registrar Nueva Persona</a>
<br>
<br>

<div class="table-responsive">
<table class="table table-light table-bordered table-striped">
    
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Hoja de Vida</th>
            <th>Cedula</th>
            <th>Nombre </th>
            <th>Apellido </th>
            <th>Direccion</th>
            <th>Email</th>
            <th>Fecha_nacimiento</th>
            <th>Pais</th>
            <th>Ciudad</th>
            <th>Telefono</th>
            <th>Acciones</th>
        </tr>
    </thead>
                        
    <tbody>
        @foreach($PersonasL as $Personas)
        <tr>
            <td>{{ $Personas->id}}</td>
            <td>

                @if(isset($Personas->foto))
                        <a href="#" onclick="openPopup('{{ asset('storage').'/'.$Personas->foto }}'); return false;">
                        <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$Personas->foto }}" width= "100 alt="">
                        </a>
                @endif                
            </td>
            <td>
                @if(isset($Personas->hoja_vida))
                    <a href="{{ asset('storage').'/'.$Personas->hoja_vida }}" target="_blank">Abrir Archivo</a>
                @endif                

                <!-- Esta referencia permite ver la ruta del Archivo: {{ asset('storage').'/'.$Personas->foto }} -->
            </td>
            <td>{{ $Personas->cedula}}</td>
            <td>{{ $Personas->nombre}}</td>
            <td>{{ $Personas->apellido}}</td>
            <td>{{ $Personas->direccion}}</td>
            <td>{{ $Personas->email}}</td>
            <td>{{ $Personas->fecha_nacimiento}}</td>
            <td>{{ $Personas->pais}}</td>
            <td>{{ $Personas->ciudad}}</td>
            <td>{{ $Personas->telefono}}</td>

            <td>
                
                                                            
                <form action="{{ url('/personas/'.$Personas->id)}}" class="d-inline" method="post">
                @csrf
                {{ method_field('DELETE')}}

                <a href="{{ url('/personas/'.$Personas->id.'/edit')}}" class="btn btn-outline-warning" >Editar</a>
                <input type="submit"  class="btn btn-outline-danger" onclick="return confirm('Seguro Elimina este Registro?')"
                 value="Borrar">
                
                </form>                    
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!!  $PersonasL->links() !!}
</div>

</div>
@endsection
