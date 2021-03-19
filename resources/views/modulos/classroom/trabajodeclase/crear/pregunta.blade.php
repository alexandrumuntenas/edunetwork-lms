@extends('adminlte::page')

@section('title', 'Classroom < Edunetwork') @section('content') <div class="row">
    @include('modulos.classroom.componentes.cabecera')

    <div class="col" id="class_sidebar">
        @include('modulos.classroom.componentes.sidebar')
    </div>
    <div class="col">
        <form class="card" action="{{ url("/elearning/c/$hash/trabajodeclase/crear") }}" method="POST">
            <div class="card-header" id="class_message">
                <span class="card-title float-left">Crear nuevo material</span><span class="float-right"><button
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
            </div>
            <div class="card-footer">
                <span class="card-title float-left">Crear nuevo material</span><span class="float-right"><button
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

    </script>
@stop

@section('footer')
    Edunetwork v1.0
</> by duoestudios
@endsection
