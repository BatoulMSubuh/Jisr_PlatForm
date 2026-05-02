<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdminService;
use App\Traits\ApiResponse;

class UserController extends Controller
{
    use ApiResponse;

    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService; 
    }

    public function getUnverifiedCompanies()
    {
        $companies = $this->adminService->getUnverifiedCompanies();

        return $this->success(
            'Unverified companies retrieved successfully.', 
            $companies 
        );
    }

    public function getCompanyDetails($userId)
    {
        $companyDetails = $this->adminService->getCompanyDetailsByUserId($userId);

        return $this->success(
            'Company details retrieved successfully.',  
            [
                'company' => $companyDetails['company'] ?? null,
                'documentation_file' => $companyDetails['documentation_file'] ?? null
            ] 
        );
    }

    public function verifyCompany($id)
    {
        if ($this->adminService->verifyCompany($id)) {
            return $this->success('Company verified successfully.');
        }

        return $this->error('Company not found or already verified.', [], 404);
    }

    // Other methods can be implemented later
}