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

    </head>
    <body>
        <div style="margin-top: 15%;">        
        <div class="container d-flex h-100">
            <div class="row align-self-center w-100">
                <div class="col-6 mx-auto">
                    <div class="jumbotron">
                        <h3 class="display-4">Check URL</h1>
                        
                        <form action="home" method="POST" class="pb-5">
                        @csrf
                            <div class="input-group">
                                <input type="url" name="url" id="url" required>
                            </div>

                            <button type="submit">Check</button>
                        </form>

                        <div>
                            @if(!empty($message))
                                {{ $message }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </body>
</html>
