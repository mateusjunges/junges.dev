<?php

namespace App\Modules\Docs\Support\Highlighting;

use Tempest\Highlight\Languages\JavaScript\JavaScriptLanguage;

class JsxLanguage extends JavaScriptLanguage
{
    public function getName(): string
    {
        return 'jsx';
    }

    public function getInjections(): array
    {
        return [
            ...parent::getInjections(),
        ];
    }
}
