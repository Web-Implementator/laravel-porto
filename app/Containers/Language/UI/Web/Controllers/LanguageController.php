<?php

declare(strict_types=1);

namespace App\Containers\Language\UI\Web\Controllers;

use App\Containers\Language\UI\Web\Requests\LanguageChangeRequest;
use App\Ship\Parents\Controllers\WebController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

final class LanguageController extends WebController
{
    /**
     * @param LanguageChangeRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function change(LanguageChangeRequest $request): Application|RedirectResponse|Redirector
    {
        $validated = $request->validated();

        $locale = $validated['locale'];

        if (!in_array($locale, ['en', 'ru'])) {
            abort(400);
        }

        session()->put('language', $locale);

        app()->setLocale($locale);

        return redirect(route('users-welcome-container'));
    }
}
