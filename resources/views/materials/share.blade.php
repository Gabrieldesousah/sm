@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Compartilhar</div>
                <div class="panel-body">

                @if (session('status'))
			        <div class="alert alert-success">
			            {{ session('status') }}
			        </div>
			    @endif

                @if (Auth::guest())
                    <div class="alert alert-danger">
                    Você não está cadastrado, faça login para gerenciar melhor seus documentos:
				    <br>
				    <a data-toggle="modal" data-target="#ModalLogin" href="#ModalLogin">Entrar</a></center>
				    </div>
                    
                @endif

                <form action="{{ url('/materials/store') }}" method="post" enctype="multipart/form-data">
					<label for="type">O que você vai compartilhar? </label><br>
					<select class="input-large form-control" name="type">
						<option value="exam" selected="selected">Prova</option>
						<option value="list">Lista de exercícios</option>
						<option value="answers">Gabaritos e resoluções</option>
						<option value="resume">Resumos e explicações</option>
					</select>

					<label for="professor">Professor(necessário): </label><br>
					<input class="input-large form-control" name="professor" id="professor" value="" placeholder="Nome do professor" type="text" required>


					<label for="content">Disciplina: </label><br>
					<input class="input-large form-control" name="content" id="content" value="" placeholder="Disciplina, ex: Cálculo I" type="text" required>

					<label for="area">Área: </label><br>
					<select class="input-large form-control" name="area">
						<option value="Exatas" selected="selected">Exatas</option>
						<option value="Humanas">Humanas</option>
						<option value="Biologicas">Biológicas</option>
					</select>


					<label for="text">Tópicos, curso e descrição: </label><br>
					<input class="input-large form-control" type='text' name='description' placeholder="ex. 1° ou 2° prova; Produto vetorial, matrizes; eng. civil.."/>


					<label for="college">O material é de qual universidade? </label><br>
					<select class="input-large form-control" name="college">
						<option value="UFG" selected="selected">UFG</option>
						<option value="UEG">UEG</option>
						<option value="IFG">IFG</option>
						<option value="PUC">PUC</option>
						<option value="UNIP">UNIP</option>
						<option value="Uni-ANHANGUERA">Uni-ANHANGUERA</option>
						<option value="Uni-EVANGÉLICA">Uni-EVANGÉLICA</option>
						<option value="ALFA">ALFA</option>
						<option value="PADRÃO">PADRÃO</option>
						<option value="Outras">Outras</option>
					</select>


					<label for="file">Arquivo:</label><br>
					<input class="input-large form-control" type="file" name="file">
					
					<?php 
					if (Auth::guest()){
						$user_id = "";
					} else {
						$user_id = Auth::user()->id;
					}
					?>
					<input type="hidden" name="user_id" value="{{ $user_id }}">

					<br>
					{{ csrf_field() }}
					<div class="centered">
						<input class="btn btn-default" type="submit" value="Enviar">
					</div>
				</form>

				<br><br>
                <div class="alert alert-info">baixar camscanner</div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection