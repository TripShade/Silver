
	<div class="text-right">
		<a
			class="btn btn-muted btn-lg"
			type="button"
			href="{{ $edit }}"
			data-title="Wijzig {{ $subject or 'item' }}"
		>
			<i class="fa fa-pencil"></i>
		</a>&nbsp;<button
			class="btn btn-muted btn-lg"
			type="button"
			data-href="{{ $delete }}"
			data-title="Verwijder {{ $subject or 'item' }}"
			data-target="#deleteModal"
			data-toggle="modal"
		>
			<i class="fa fa-trash"></i>
		</button>
	</div>