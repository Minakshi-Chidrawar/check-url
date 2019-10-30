<form action="/" method="POST" id="InputUrl" autocomplete="off">
    @csrf
    <div class="row" id ="divTest">
        <div class="col-9">
            <div class="input-group input-group-lg">
                <input type="url" name="url" id="url" value="{{ Request::old('url') }}" placeholder="Shorten your link" class="form-control" required>
            </div>
        </div>
        <div class="col-3">
            <button type="submit" id="shorten" class="btn btn-primary btn-lg btn-block">Shorten</button>
        </div>
    </div>
</form>