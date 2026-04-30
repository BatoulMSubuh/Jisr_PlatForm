<?php
namespace App\Repositories;

use App\Models\Company;
use App\Interfaces\CompanyRepositoryInterface;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function create(array $data)
    {
        return Company::create($data);
    }
}
