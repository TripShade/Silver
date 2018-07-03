	<div class="form-group">
		<label for="name" class="col-sm-4 control-label required">Naam</label>
		<div class="col-sm-8">
			{!!  Form::text('name', null, ['class' => 'form-control', 'required']) !!}
		</div>
	</div>

	<!-- <div class="form-group">
		<label class="col-sm-4 control-label">Afbeelding</label>
		<div class="col-md-8">
			<div class="input-group">
				{!!  Form::text('image', null, ['class' => 'form-control', 'id' => 'veld_afbeelding']) !!}
				<span class="input-group-btn">
					<button
						type="button"
						class="btn btn-default"
						data-href="{{ route('admin.files.index') }}?field_id=veld_afbeelding&amp;type=2&amp;relative_url=1"
						data-title="Kies een bestand"
						data-target="#ajaxModal"
						data-toggle="modal"
						data-large="true"
					>
						Selecteer
					</button>
				</span>
			</div>
		</div>
	</div> -->

<!-- 	<div class="form-group">
		<label for="text" class="col-sm-4 control-label">Tekst</label>
		<div class="col-sm-8">
			{!!  Form::textarea('text', null, ['class' => 'form-control wysiwyg', 'rows' => 6]) !!}
		</div>
	</div> -->