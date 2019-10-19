<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CheckURLController extends Controller
{
    public function checkUrl()
    {
        //echo ('it is in the expected loop');
        return view('checkUrl.home');
    }

    public function store(Request $request)
    {               
        $message = $this->Visit($request->url);

        if ((strpos($message, 'not') === 0) || (!strpos($message, 'not')))
        {
            $random = Str::random(25);
            $message = "Yes, this is what!";
        }

        return view('checkUrl.home', compact('message'));
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
}