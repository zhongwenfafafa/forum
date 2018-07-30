<?php

namespace App\Inspections;

use Exception;

class InvalidKeywords
{
    protected $keywords = [
        '你'
    ];

    public function detect($body)
    {
        foreach ($this->keywords as $invalidKeyword) {
            if (stripos($body, $invalidKeyword) !== false) {
                throw new Exception('Your reply contains spam.');
            }
        }
    }
}
