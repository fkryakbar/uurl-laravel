<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function title()
    {
        $parsedUrl = parse_url($this->long_link);

        if ($parsedUrl && isset($parsedUrl['host'])) {

            $host = $parsedUrl['host'];

            $parts = explode('.', $host);

            if (count($parts) > 2) {
                return $parts[count($parts) - 2] . '.' . $parts[count($parts) - 1];
            } else {
                return $host;
            }
        } else {
            return null;
        }
    }
}
