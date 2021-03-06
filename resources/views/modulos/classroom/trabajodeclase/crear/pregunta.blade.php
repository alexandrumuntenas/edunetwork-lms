@extends('adminlte::page')

@section('title', 'Classroom < Edunetwork') @section('content')<div class="h-100"><div class="row justify-content-center">
    @include('modulos.classroom.componentes.cabecera')

    <div class="col" id="class_sidebar">
        @include('modulos.classroom.componentes.sidebar')
    </div>
    <div class="col" style="max-width:712px">
        <form class="card" action="{{ url("/elearning/c/$hash/trabajodeclase/crear") }}" method="POST">
            <div class="card-header" id="class_title">
                <span class="card-title float-left">Crear nueva pregunta</span><span class="float-right"><button
                        class="btn btn-primary btn-sm" type="submit">Publicar</button></span>
            </div>
            <div class="card-body">
                @csrf
                <div class="form-group">
                    <label for="titulo">Pregunta</label>
                    <input class="form-control" name="pregunta" id="pregunta" required />
                </div>
                <div class="form-group">
                    <label for="contenido">Descripción (Opcional)</label>
                    <textarea class="form-control" id="contenido" name="contenido"></textarea>
                </div>
                <div class="form-group">
                    <label for="tema">Tema</label>
                    <select class="form-control" name="tema" id="tema">
                        <option value="0">Sin tema</option>
                        @foreach ($temas as $tema)
                            <option value="{{ $tema->id }}">{{ $tema->topic_data }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo de pregunta</label>
                    <select id="tipo" name="tipo" class="form-control">
                        <option value="number">Numérico</option>
                        <option value="text" selected>Respuesta corta</option>
                        <option value="textarea">Respuesta Larga</option>
                        <option value="color">Color</option>
                    </select>
                </div>
                <div class="numericfields" style="display: none" id="numericfields">
                    <div class="form-group">
                        <label for="min">Cantidad mínima (valor predeterminado: 0)</label>
                        <input type="number" class="form-control" id="min" name="min" />
                    </div>
                    <div class="form-group">
                        <label for="max">Cantidad máxima (valor predeterminado: 100)</label>
                        <input type="number" class="form-control" id="max" name="max" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="masrespuestas">¿Aceptar más de una respuesta?</label>
                    <input type="checkbox" value="masrespuestas" id="masrespuestas" name="masrespuestas" />
                </div>
                <div class="form-group">
                    <label for="puntos">Puntos</label>
                    <input type="number" class="form-control" value="100" id="puntos" name="puntos" />
                </div>
            </div>
            <div class="card-footer">
                <span class="card-title float-left">Crear nueva pregunta</span><span class="float-right"><button
                        class="btn btn-primary btn-sm" type="submit">Publicar</button></span>
            </div>
        </form>
    </div>

    </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('contenido');
        });
        $('select').change(function() {
            console.log($('option').val())
            if ($(this).val() == 'number') {
                $('.numericfields').show();
            } else {
                $('.numericfields').hide();
            }
        });

    </script>
@stop

@section('footer')
    Edunetwork v1.0
</> by duoestudios
@endsection
