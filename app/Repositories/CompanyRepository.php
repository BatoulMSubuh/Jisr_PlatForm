<?php
namespace App\Repositories;

use App\Models\Company;
use App\Interfaces\CompanyRepositoryInterface;
use App\Models\User;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function create(array $data)
    {
        return Company::create($data);
    }

    public function getUnverifiedCompanies()
    {
        return Company::where('is_verified_by_admin', false)->get();
    }

     public function getCompanyByUserId($userId)
    {
        $user=User::findOrFail($userId);
        $company=Company::where('user_id', $userId)->first();
        return $company;
    }
}
