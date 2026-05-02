<?php

namespace App\Services;

use App\Repositories\CompanyRepository;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class CompanyService
{
    protected $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * 
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUnverifiedCompanies()
    {
        return $this->companyRepository->getUnverifiedCompanies();
    }

   
    public function getCompanyDetailsByUserId($userId)
    {
        $company = $this->companyRepository->getCompanyByUserId($userId);

        if (!$company) {
            return null;
        }

        $pdfUrl = Storage::url($company->documentation_file); 

        return [
            'company' => $company, 
            'documentation_file' => $pdfUrl    
        ];
    }


     public function verifyCompany(int $companyId): bool
    {
       
            if($company = Company::findOrFail($companyId)){

            $company->is_verified_by_admin = true;
            $company->save();
            return true;
            }
            return false;
        }
    }
