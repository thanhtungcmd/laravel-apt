<?php

namespace Modules\DreamPaladin\Domain\DTO;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class Simple extends Data
{

    public string $name;

    #[MapInputName('record_company')]
    public string $recordCompany;

}
