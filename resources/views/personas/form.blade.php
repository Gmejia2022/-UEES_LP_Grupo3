
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

<h1> {{ $modo }} Persona</h1>

<div class = "form-group">
    <label for="Cedula"> Cedula de Identidad:</label>
    <input type="text" class = "form-control" name ="Cedula" value = "{{ isset($personasE->cedula)?$personasE->cedula:'' }}" id ="Cedula">
</div>

<div class = "form-group">
    <label for="Nombre"> Nombre:</label>
    <input type="text" class = "form-control" name = "Nombre" value = "{{ isset($personasE->nombre)?$personasE->nombre:'' }}" id = "Nombre">
</div>

<div class = "form-group">
    <label for="Apellido"> Apellido:</label>
    <input type="text" class = "form-control" name = "Apellido" value = "{{ isset($personasE->apellido)?$personasE->apellido:'' }}" id = "Apellido">
</div>

<div class = "form-group">
    <label for="Direccion"> Direccion:</label>
    <input type="text" class = "form-control" name = "Direccion" value = "{{ isset($personasE->direccion)?$personasE->direccion:'' }}" id = "Direccion">
</div>

<div class="form-group">
    <label for="Email">Correo Electrónico:</label>
    <input type="text" class="form-control" name="Email" value="{{ isset($personasE->email) ? $personasE->email : '' }}" id="Email">
</div>

<div class = "form-group">
    <label for="fecha_nacimiento"> Fecha de Nacimiento:</label>
    <input type="date" class = "form-control" name = "fecha_nacimiento" value = "{{ isset($personasE->fecha_nacimiento)?$personasE->fecha_nacimiento:'' }}" id = "fecha_nacimiento">
</div>

<div class = "form-group">
    <label for="Pais"> Pais:</label>
    <input type="text" class = "form-control" name = "Pais" value = "{{ isset($personasE->pais)?$personasE->pais:'' }}" id = "Pais">
</div>

<div class = "form-group">
    <label for="Ciudad"> Ciudad:</label>
    <input type="text" class = "form-control" name = "Ciudad" value = "{{ isset($personasE->ciudad)?$personasE->ciudad:'' }}" id = "Ciudad">
</div>

<div class = "form-group">
    <label for="Telefono"> Telefono:</label>
    <input type="text" class = "form-control" name = "Telefono" value = "{{ isset($personasE->telefono)?$personasE->telefono:'' }}" id ="Telefono">
</div>

<div class = "form-group">
    <br>    
    @if(isset($personasE->foto))
    
        <!-- Comentario: {{ $personasE->foto }} -->
        <a href="#" onclick="openPopup('{{ asset('storage').'/'.$personasE->foto }}'); return false;">
            <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$personasE->foto }}" width= "100 alt="">
        </a>
        
        <br>
    @endif    
    
    <div class="btn-group" role="group" aria-label="Importacion">    

    <!-- Cambia el tipo de botón a "button" y personaliza el texto -->
    <input class = "btn btn-outline-info" type="button" value="Selecciona Archivo de Foto" onclick="document.getElementById('Foto').click();" style="cursor: pointer;">

    <!-- Agrega un campo oculto de tipo "file" -->
    <input type="file" name="Foto" id="Foto" style="display: none;">

    @if(isset($personasE->hoja_vida))
        <!-- Comentario: {{ $personasE->hoja_vida }} -->
    @endif
    <br>
    <br>    
    
    <!-- Cambia el tipo de botón a "button" y personaliza el texto -->
    <input class = "btn btn-outline-info"  type="button" value="Seleccion archivo Hoja de Vida" onclick="document.getElementById('hoja_vida').click();" style="cursor: pointer;">
    </div>
</div>
    <!-- Agrega un campo oculto de tipo "file" -->
    <input type="file" name="hoja_vida" id="hoja_vida" style="display: none;">  
<br>
<div class="btn-group" role="group" aria-label="Selecciones su Opcion">    
    <input class = "btn btn-success" type="submit" value= "{{$modo}} Persona" >        
    <a class = "btn btn-primary" href="{{ url('personas/') }}"> Regresar</a>
</div>