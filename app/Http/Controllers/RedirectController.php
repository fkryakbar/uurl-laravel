<?php

namespace App\Http\Controllers;

use App\Jobs\IncrementViews;
use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RedirectController extends Controller
{
    public function index($back_half)
    {
        $url = Cache::remember('redirect-' . $back_half, now()->addDays(3), function () use ($back_half) {
            return Url::where('back_half', $back_half)->firstOrFail();
        });

        IncrementViews::dispatch($back_half);
        return redirect($url->secure_long_link());
    }
}
