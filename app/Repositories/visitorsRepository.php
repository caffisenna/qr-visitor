<?php

namespace App\Repositories;

use App\Models\visitors;
use App\Repositories\BaseRepository;

class visitorsRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'booth_number'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return visitors::class;
    }
}
