@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Usuários</div>
                <div class="panel-body">
                    <div class="table-container">
	                    <table class="table table-condensed table-hover table-striped table-bordered col-lg-12">
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->course }}</td>
                                <td>{{ $user->created_at }}</td>
                            </tr>
                            @endforeach
                        </table>
                        <div class="centered">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
