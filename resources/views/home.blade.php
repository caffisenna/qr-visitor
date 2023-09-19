@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message')
        <div class="row">
            <form method="POST" action="{{ route('visitors.store') }}" id="myForm">
                @csrf
                <input type="text" name="booth_number" id="booth_number" oninput="checkInputLength(this)" required>
            </form>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    document.getElementById("booth_number").focus();
                });

                function checkInputLength(input) {
                    if (input.value.length === 6) {
                        document.getElementById('myForm').submit();
                    }
                }
            </script>
        </div>
    </div>
@endsection
