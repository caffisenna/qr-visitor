<!-- Booth Number Field -->
<div class="form-group col-sm-6">
    <input type="hidden" name="uuid" value="{{ Str::uuid() }}">
    {!! Form::label('booth_number', 'QR(大文字):販売店(H)、工事店(K)、メーカー(S)、金融・管理・一般・EU(E)、ファシリティーズ(F)') !!}
    {!! Form::text('booth_number', null, ['class' => 'form-control', 'required']) !!}
</div>
