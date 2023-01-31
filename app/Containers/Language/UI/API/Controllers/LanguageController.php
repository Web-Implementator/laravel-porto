<?php

declare(strict_types=1);

namespace App\Containers\Language\UI\API\Controllers;

use App\Containers\Language\UI\API\Requests\LanguageChangeRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

final class LanguageController extends ApiController
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
