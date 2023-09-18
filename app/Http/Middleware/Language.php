<?php

namespace App\Http\Middleware;

use App\Models\Language as LanguageModel;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Language
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user();
        $language = $user ? LanguageModel::find($user->getActualLanguageId()) : LanguageModel::findByCode('en')->firstOrFail();

        if (
            Session::has('locale') &&
            in_array(Session::get('locale'), ['en', 'pl']) &&
            mb_strtoupper($language->code) === mb_strtoupper(Session::get('locale'))
        ) {
            App::setLocale(Session::get('locale'));
        } else {
            App::setLocale(strtolower($language->getCode()));
        }

        return $next($request);
    }
}
