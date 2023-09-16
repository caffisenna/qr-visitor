{{-- {{ dd($counts) }} --}}
@extends('layouts.app')

@section('content')
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table" id="visitors-table">
                <thead>
                    <tr>
                        <th>ブース</th>
                        <th>通過人数</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($counts as $count)
                        <tr>
                            <td>{{ $count->booth_number }}</td>
                            <td>{{ $count->count_booth_number }}人</td>
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
@endsection
