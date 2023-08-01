<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function changeLanguage($locale)
    {
        if (in_array($locale, config('app.available_locales'))) {
            session()->put('locale', $locale);
        }

        return back();
    }
}