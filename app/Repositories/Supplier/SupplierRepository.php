<?php

namespace App\Repositories\Supplier;

use App\Repositories\BaseRepository;
use App\Models\Supplier;

class SupplierRepository extends BaseRepository implements SupplierRepositoryInterface
{
    public function getModel()
    {
        return Supplier::class;
    }
}
