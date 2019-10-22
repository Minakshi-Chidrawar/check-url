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

        $message = $this->Visit($request->url);

        if ((strpos($message, 'not') === 0) || (!strpos($message, 'not')))
        {
            $random = Str::random(25);
            $this->insertUrlintoTable($request->url, $random);
            $shortenUrl = url('/') . '/' . $random;

            $message = $shortenUrl;
        }

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
        //dd($redirectUrl);

        return redirect($redirectUrl->url);
    }

    //returns true, if domain is availible, false if not
    public function Visit($url)
    {
        if(!($this->isValidURL($url)))
        {
            return "Please provide a valid URL";
        }

        $splitUrl = parse_url($url);
        $protocol = $splitUrl['scheme'] ?? '';
        $protocol = $protocol ? $protocol . "://" : '';
        $host = $splitUrl['host'] ?? '';
        $path = $splitUrl['path'] ?? '';


        $robots = $protocol . $host .'/robots.txt';
        $exists   = false;
        
        if (!$exists && in_array('curl', get_loaded_extensions())) {
            
            $ch = curl_init();   
             
            curl_setopt($ch, CURLOPT_URL, $robots);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT_MS, 2000);
            curl_exec($ch);

            $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($response === 200)
            {
                $exists = true;
                return "$url does appear to exist.";
            }            
            curl_close($ch);            
        }
        
        if (!$exists && function_exists('get_headers'))
        {            
            if(is_array(@get_headers($robots)))
            {
                return "$url does appear to exist.";
            }         
        }

        return "$url does not appear to exist.";
    }

    public function isValidURL($url)
    {
        // Remove all illegal characters from a url
        $url = filter_var($url, FILTER_SANITIZE_URL);

        // Validate url
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            return true;
        } else {
            return false;
        }
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