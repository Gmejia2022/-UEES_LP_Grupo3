@extends('layouts.app')

@section('content')
<div class="container">

<form action="{{ url ('/personas/'.$personasE->id ) }}" method="post" enctype="multipart/form-data">
    @csrf
    {{ method_field('PATCH') }}

    @include('personas.form',['modo'=>'Actualización de ']);
    
</form>
</div>
@endsection