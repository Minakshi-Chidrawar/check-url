<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        @include('partials.headLink')
    </head>
    <body>
        <div style="margin-top: 15%;">        
            <div class="container">
                <h1 class="d-flex ml-3 text-left h-100">Shorten URL</h1>
                <div class=" d-flex justify-content-center h-100">
                    <div class="row align-items-center w-100">
                        <div class="col-12 m-auto">
                            <div class="jumbotron bg-blue">
                                @if(!empty($message))
                                    <div class="row">
                                        <div class="col-9">
                                            <div class="input-group input-group-lg">
                                                <input class="form-control" id="disabledInput" type="text" value="{{ $message }}">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <button onclick="copyFunction()" class="btn btn-primary btn-lg btn-block" id="copy">Copy</button>
                                        </div>
                                    </div>
                                @else
                                    @include('partials.shortenForm')
                                    @if ($message = Session::get('error'))
                                        <div class="alert alert-danger alert-block mt-3">
                                            <button type="button" class="close" data-dismiss="alert">×</button>	
                                                <strong>{!! $message !!}</strong>
                                        </div>
                                    @endif
                                @endif
                            </div>
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
