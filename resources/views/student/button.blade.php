<!-- dynamic-inputs.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Inputs with Laravel</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        .container {
            max-width: 600px;
            margin: auto;
        }

        .input-group {
            margin-bottom: 10px;
        }

        .remove-btn {
            margin-left: 5px;
            cursor: pointer;
            color: red;
        }

        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Add or Remove Dynamic Inputs</h2>
        <form action="{{ route('button.add') }}" method="post">
            @csrf

            <div class="row" id="dynamic-inputs-container">
                <!-- Default input -->
                @foreach (old('inputs', ['']) as $key => $value)
                    <div class="input-group">
                        <div>
                            <input type="text" name="inputs[]">
                            @error("inputs.$key")
                                <div class="error">{{ $message }}</div>
                            @enderror

                        </div>
                        <div>

                            <input type="file" name="name[]" >
                            @error("name.$key")
                            <div class="error">{{ $message }}</div>
                        @enderror
                        </div>
                        @if ($key > 0 )

                        <div>

                            <span class="remove-btn" onclick="removeInput(this)">Remove</span>
                        </div>
                        @endif
                    </div>
                    <div>

                    </div>
                @endforeach
            </div>

            <button type="button" onclick="addInput()">Add Input</button>



            <button type="submit">Submit</button>
        </form>
    </div>

    <script>
        // Function to add a new input field
        var i = 0;
        function addInput() {
            var newInput = `
            <div class="input-group">
                        <div>
                            <input type="text" name="inputs[]">


                        </div>
                        <div>

                            <input type="file" name="name[]" >

                        </div>
                        <div>

                            <span class="remove-btn" onclick="removeInput(this)">Remove</span>
                        </div>
                    </div>
            `;
            $('#dynamic-inputs-container').append(newInput);
        }

        // Function to remove the clicked input field
        function removeInput(btn) {
            $(btn).closest('.input-group').remove();
        }
    </script>

</body>
</html>
