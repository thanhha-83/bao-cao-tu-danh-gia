<?php

namespace App\Filters;

class HighLightKeyword {
    public static function handleHighlight($html, $keywords)
    {
        foreach ($keywords as $keyword) {
            $html = str_replace($keyword->noiDung, '<span class="text-danger">'.$keyword->noiDung.'</span>', $html);
        }
        return $html;
    }
}
