@extends('admin::layouts.main')


@section('content')

	<div class="admin-section bg-lgrey p-0">
		<div class="admin-container">
			@include('admin.partials.nav-settings')
		</div>
	</div>

	<section class="admin-section">
		<div class="admin-container">
			<table id="resourceTable" class="table table-hover">
				<thead>
					<tr>
						<th>id</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</section>

<div class="admin-top">
		<div class="admin-container">
			<h1 class="admin-top-left">{{modelNamePlural}}</h1>
			<div class="admin-top-right">
				<a
					accesskey="n"
					type="button"
					class="btn btn-success"
					href="{{ route('admin.{{modelNamePluralLowerCase}}.create') }}"
					data-title="Nieuwe {{modelName}}"
				>
					Nieuwe {{modelName}}
				</a>
			</div>
		</div>
	</div>

@stop


@section('style')
@stop


@section('script')
	<script>
		$('#resourceTable').DataTable({
			processing: false,
			serverSide: true,
			stateSave: true,
			ajax: "{{ route('admin.{{modelNamePluralLowerCase}}.data') }}",
			columns: [
				{data: 'id'},
				{data: 'action', orderable: false, searchable: false}
			],
			"order": [[ 0, "asc" ]]
		});

		$('#resourceTable tbody').on('click', 'tr', function(e){
			if(e.target.localName == 'td')
			{
				var btn = $(this).find('.btn:first');
				if( $(e.target).prop("tagName").toLowerCase() == 'td' ){ btn[0].click(); }
			}
		});
	</script>
@stop