<?php

namespace App\Jobs;

use App\Models\Url;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class IncrementViews implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    public $backHalf;


    public function __construct($backHalf)
    {
        $this->backHalf = $backHalf;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $url = Url::where('back_half', $this->backHalf)->first();
        if ($url) {
            $url->increment('clicks', 1);
        }
    }
}
