@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Pesquisas</div>
                <div class="panel-body">

                    @foreach($keywords as $keyword)

                    <ul>
                    	<li>
                    		<b style="text-transform: capitalize;">
                    			{{$keyword->keywords}}:
                    		</b>
                    		{{$keyword->ContKeywords}}
                    	</li>
                    </ul>
            		
            		@endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection



