<?php

declare(strict_types=1);

namespace App\Containers\Language\UI\Web\Controllers;

use App\Containers\Language\UI\Web\Requests\LanguageChangeRequest;

use App\Ship\Generic\Controllers\WebController;

final class LanguageController extends WebController
{
    /**
     * @param LanguageChangeRequest $request
     * @return mixed
     */
    public function change(LanguageChangeRequest $request): mixed
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
