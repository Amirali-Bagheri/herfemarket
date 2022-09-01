@push ('head')
    <style>

        #otp-group input[type="text"] {
            background-color: transparent;
            border: none;
            border-bottom: 2px solid gray;
            display: inline-block;
            font-size: 20px;
            margin: 0 5px;
            width: 1.5rem;
            text-align: center;
        }

        #otp-group input[type="submit"] {
            background-color: #00cc66;
            border: 0;
            color: #fff;
            margin-top: 20px;
            padding: 10px;
            width: 100%;
        }
    </style>
@endpush

@push ('scripts')
    <script>

        $('#otp-group .inputs').keyup(function () {
            if (this.value.length == this.maxLength) {
                $(this).next('#otp-group .inputs').focus();
            }
            if (event.code === 'Backspace') {
                $(this).prev('#otp-group .inputs').focus();
                this.value = '';
            }

        });
        $('#otp-group  .inputs').last().keyup(function () {
            $('#submit').click();
        });

        document.addEventListener('livewire:load', function () {

            $('#otp-group .inputs').keyup(function () {
                if (this.value.length == this.maxLength) {
                    $(this).next('#otp-group .inputs').focus();
                }
                if (event.code === 'Backspace') {
                    $(this).prev('#otp-group .inputs').focus();
                    this.value = '';
                }

            });
            $('#otp-group  .inputs').last().keyup(function () {
                $('#submit').click();
            });

            // Livewire.emit('refreshComponent')
        });

    </script>
@endpush
