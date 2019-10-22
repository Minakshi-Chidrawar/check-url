<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    </head>
    <body>
        <div style="margin-top: 15%;">        
        <div class="container d-flex justify-content-center h-100">
            <div class="row align-items-center w-100">
                <div class="col-12 mx-auto">
                    <div class="jumbotron bg-blue">
                        @if(!empty($message))
                            <div class="row">
                                <div class="col-10">
                                    <div class="input-group input-group-lg">
                                        <input class="form-control" id="disabledInput" type="text" value="{{ $message }}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <button onclick="copyFunction()" class="btn btn-primary btn-lg">Copy</button>
                                </div>
                            </div>
                        @else
                            <form action="/" method="POST" class="pb-5" id="InputUrl" autocomplete="off">
                            @csrf
                                <div class="row" id ="divTest">
                                    <div class="col-9">
                                        <div class="input-group input-group-lg">
                                            <input type="url" name="url" id="url" placeholder="Shorten your link" class="form-control" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" id="shorten" class="btn btn-primary btn-lg">Shorten</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        </div>
        <script>
            function copyFunction()
            {
                var copyText = document.getElementById("disabledInput");
                copyText.select();
                copyText.setAttribute('readonly', true);
                copyText.setSelectionRange(0, 99999);
                document.execCommand('copy');
            }
        </script>
    </body>
</html>
