@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message')
        <h2>QRコードスキャン</h2>
        <p class="uk-text-danger">↓の入力ボックスにカーソルが点滅していることを確認してQRコードをスキャンしてください。</p>
        <div class="row">
            <form method="POST" action="{{ route('visitors.store') }}" id="myForm">
                @csrf
                <input type="text" name="booth_number" id="booth_number" oninput="limitInput(this)" maxlength="1" required
                    class="uk-input uk-form-large">
            </form>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var booth_numberInput = document.getElementById("booth_number");

                    booth_numberInput.addEventListener("blur", function() {
                        // フォーカスが外れた場合、再びフォーカスを設定します。
                        booth_numberInput.focus();
                    });

                    booth_numberInput.focus(); // ページ読み込み時にフォーカスを設定します。
                });

                function limitInput(input) {
                    var allowedCharacters = ['H', 'K', 'S', 'E', 'F'];
                    var inputValue = input.value.toUpperCase();

                    // 入力が許可された文字かどうかを確認し、許可されていない場合は削除します。
                    if (allowedCharacters.indexOf(inputValue) === -1) {
                        input.value = '';
                    }

                    if (input.value.length === 1) {
                        document.getElementById('myForm').submit();
                    }
                }
            </script>

            <script>
                setTimeout(function() {
                    var flashMessage = document.querySelector('.alert'); // Flashメッセージの要素を取得
                    if (flashMessage) {
                        flashMessage.remove(); // 要素を削除
                    }
                }, 5000); // 5秒後に削除する
            </script>
        </div>
    </div>
@endsection
