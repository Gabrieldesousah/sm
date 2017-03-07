@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        @foreach($materials[0] as $material)
        <div class="col-lg-4">
            <div class="box-option">
                <div class="box-top">
                    <div class="box-header">
                    	<span class="box-title">{{ $material->content }}</span>
                    </div>
                </div>
                <a href="{{ url('/contents') }}/{{ $content->id }}" class="box-signup">Ver mais</a>
            </div>
        </div>
        @endforeach
        
    </div>
</div>
@endsection



