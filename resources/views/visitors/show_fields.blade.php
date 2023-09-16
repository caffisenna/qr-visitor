<!-- Booth Number Field -->
<div class="col-sm-12">
    {!! Form::label('booth_number', 'Booth Number:') !!}
    <p>{{ $visitors->booth_number }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $visitors->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $visitors->updated_at }}</p>
</div>

