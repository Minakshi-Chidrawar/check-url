<?php

namespace App\Http\Controllers;

use App\shortUrl;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CheckURLController extends Controller
{
    public function checkUrl()
    {
        return view('checkUrl.home');
    }

    public function store(Request $request)
    {               
        $this->validate($request, [
            'url' => 'required|URL'
        ]);

        $url = $request->url;
        $splitUrl = parse_url($url);
        if (strPos(url('/'), $splitUrl['host']))
        {
            return back()->with('error', "This is already shortened URL with our database <br> $url");
        }

        $message =  $this->checkForTable($url);

        return view('checkUrl.home', compact('message'));
    }

    public function redirectUrl()
    {
        $shortenUrl = url()->full();
        $splitUrl = parse_url($shortenUrl);
        $path = substr($splitUrl['path'], 1) ?? '';

        if ($path === 'home')
        {
            return view('checkUrl.home');
        }

        $redirectUrl = ShortUrl::where('shortCode', $path)->first();

        if (!$redirectUrl)
        {
            abort(404,'Page not found');;
        }

        return redirect($redirectUrl->url);
    }

    public function checkForTable($url)
    {
        $random = $this->checkUrlExistInTable($url);
        $random = ((isset($random)) ? $random : $this->addUrlToTable($url));
        
        return  url('/') . '/' . $random;
    }

    public function addUrlToTable($url)
    {
        $random = $this->populateRandomString();
        $this->insertUrlintoTable($url, $random);

        return $random;
    }

    public function populateRandomString()
    {
        $random = Str::random(10);
        
        return $randomString;
    }

    public function checkUrlExistInTable($url)
    {
        $code = ShortUrl::select('shortCode')->where('url', $url)->first();

        if (!isset($code))
        {
            return null;
        }
        
        return $code->shortCode;
    }

    public function insertUrlintoTable($url, $random)
    {
        ShortUrl::create([
            'url' => $url,
            'shortCode' => $random,
            'hits' => 1,
        ]);
    }
}

// run npm install clipboard --save
// add  <script src="dist/clipboard.min.js"></script>