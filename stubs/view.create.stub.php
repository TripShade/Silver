@extends('admin::layouts.main')

@section('content')

	{!! Form::open(['route' => 'admin.{{modelNamePluralLowerCase}}.store', 'class' => 'form-horizontal']) !!}

		<div class="admin-section bg-lgrey p-0 modal-hidden">
			<div class="admin-container">
				@include('admin.partials.nav-settings')
			</div>
		</div>

		<div class="admin-section">
			<div class="admin-container">
				@include('admin.{{modelNamePluralLowerCase}}.partials.fields')
			</div>
		</div>

		<div class="admin-top">
			<div class="admin-container">
				<h1 class="admin-top-left">
					<a class="text-muted" href="{{ route('admin.engines.index') }}">{{modelNamePlural}}</a>
					<i class="fa fa-angle-right text-muted ml-5 mr-5"></i>
					Nieuwe {{modelName}}
				</h1>
				<div class="admin-top-right">
					<input class="btn btn-default" type="submit" name="save_and_close" accesskey="o" value="Opslaan en sluiten">
					<button type="submit" class="btn btn-primary">Opslaan</button>
				</div>
			</div>
		</div>

	{!! Form::close() !!}

@stop


@section('style')
@stop


@section('script')

	<script src="{{ asset(config('admin.wysiwyg.js')) }}"></script>
	<script>
		$('form.form-horizontal').areYouSure();
	</script>

@append
