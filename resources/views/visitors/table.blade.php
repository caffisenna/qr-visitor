<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="visitors-table">
            <thead>
                <tr>
                    <th>ブース</th>
                    <th>チェック</th>
                    <th>削除</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($visitors as $visitor)
                    <tr>
                        {{-- <td>{{ $visitors->booth_number }}</td> --}}
                        <td>
                            @switch($visitor->booth_number)
                                @case('H')
                                    販売店
                                @break

                                @case('K')
                                    工事店
                                @break

                                @case('S')
                                    メーカー
                                @break

                                @case('E')
                                    金融・管理・一般・EU
                                @break

                                @case('F')
                                    ファシリティーズ
                                @break
                            @endswitch
                        </td>
                        <td>{{ $visitor->created_at }}</td>
                        <td style="width: 120px">
                            {!! Form::open(['route' => ['visitors.destroy', $visitor->id], 'method' => 'delete']) !!}
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
            @include('adminlte-templates::common.paginate', ['records' => $visitors])
        </div>
    </div>
</div>
