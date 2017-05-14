@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  <ul>
                    <li style="text-transform: capitalize;">{{ Auth::user()->name }}</li>
                    <li>{{ Auth::user()->email }}</li>
                    <li>{{ Auth::user()->college }} - {{ Auth::user()->state }}</li>
                    <li>{{ Auth::user()->course }}</li>
                  </ul>
                  <a href="{{ url('editprofile')}}">Editar dados</a> 
                  |
                  <a href="{{ url('editpass')}}">Editar senha</a> 
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Histórico</div>

                <div class="panel-body">
                  <ul>
                    @foreach($historic as $h)
                      <li>
                        <a href="{{ url('/material') }}/{{ $h->file_id }}">{{ $h->file_id }}</a>
                      </li>
                    @endforeach
                  </ul>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Compartilhados por você</div>

                <div class="panel-body">
                  <ul>
                    @foreach($shared as $s)
<?php
if($s->type == "exam")
{
    $type = "Prova";
}elseif($s->type == "list")
{
    $type = "Lista";
}elseif($s->type == "resume")
{
    $type = "Resumo";
}elseif($s->type == "answer")
{
    $type = "Gabarito";
}
?>
                      <li>
                        <a href="{{ url('/material') }}/{{ $s->id }}">{{ $type }} de {{ $s->content }}</a>
                      </li>
                    @endforeach
                  </ul>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Comentários feitos por você</div>

                <div class="panel-body">
                  <ul>
                    @foreach($commented as $c)
                      <li>
                        <a href="{{ url('/material') }}/{{ $c->material_id }}">{!! $c->body !!}</a>
                      </li>
                    @endforeach
                  </ul> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
