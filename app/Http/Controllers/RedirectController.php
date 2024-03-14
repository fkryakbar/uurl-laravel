<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function index($back_half)
    {
        $url = Url::where('back_half', $back_half)->firstOrFail();
        $url->increment('clicks', 1);
        return redirect($url->long_link);
    }
}
