<?php

use App\Models\Language;
use Illuminate\Support\Facades\Config;

function get_lanuages()
{
    return Language::select()->get();
}
function get_locale() {
 return Config::get('app.locale');
}