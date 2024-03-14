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
        $long_link = $this->long_link;
        if (strpos($long_link, 'https://') !== 0 && strpos($long_link, 'http://') !== 0) {
            $long_link = 'https://' . $long_link;
        }

        $parsedUrl = parse_url($long_link);

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

    public function secure_long_link()
    {
        $long_link = $this->long_link;
        if (strpos($long_link, 'https://') !== 0 && strpos($long_link, 'http://') !== 0) {
            $long_link = 'https://' . $long_link;
        }

        return $long_link;
    }
}
