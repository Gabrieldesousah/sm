@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Usuários mais ativos</div>
                <div class="panel-body">

                    @foreach($userData as $u)
                    <ul>
                    	<li>
                    		<b style="text-transform: capitalize;">
                    			{{$u->name}}:
                    		</b>
                    		{{$u->contActions}}
                    	</li>
                    </ul>
            		@endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection



