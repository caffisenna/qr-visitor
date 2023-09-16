<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="visitors-table">
            <thead>
                <tr>
                    <th>ブース</th>
                    <th>チェック</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($visitors as $visitors)
                    <tr>
                        <td>{{ $visitors->booth_number }}</td>
                        <td>{{ $visitors->created_at }}</td>
                        <td style="width: 120px">
                            {!! Form::open(['route' => ['visitors.destroy', $visitors->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                {!! Form::button('<i class="far fa-trash-alt"></i>', [
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'onclick' => "return confirm('Are you sure?')",
                                ]) !!}
                            </div>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            {{-- @include('adminlte-templates::common.paginate', ['records' => $visitors]) --}}
        </div>
    </div>
</div>
