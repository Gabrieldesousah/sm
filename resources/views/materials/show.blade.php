@extends('layouts.app')

@section('content')
<?php
if($material->type == "exam")
{
    $type = "Prova";
}elseif($material->type == "list")
{
    $type = "Lista";
}elseif($material->type == "resume")
{
    $type = "Resumo";
}elseif($material->type == "answer")
{
    $type = "Gabarito";
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $type }} de {{ $material->content }}</div>
                <div class="panel-body">
                    <p>
                    <b>Professor(a):</b> {{ $material->professor }}<br>
                    <b>Instituição:</b> {{ $material->college }}<br>
                    @if($material->description != '')
                        <b>Descrição:</b> {{ $material->description }}<br>
                    @endif
                    <hr>
                    <a href="{{ url('/file') }}/{{ $material->id }}/{{ $material->file }}">Visualizar</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



