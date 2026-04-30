<?php

namespace App\Services\Auth\Strategies;

use App\Events\UserRegistered;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\CompanyRepositoryInterface;
use App\Notifications\WelcomeNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CompanyRegisterStrategy implements RegisterStrategyInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepo,
        private CompanyRepositoryInterface $companyRepo
    ) {}

    public function register(array $data): array
    {
        return DB::transaction(function () use ($data) {

            $user = $this->userRepo->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            $user->assignRole('company');

            $company = $this->companyRepo->create([
                // 'user_id' => $user->id,
                'name' => $data['company_name'],
                'industry' => $data['industry'],
                'website' => $data['website'] ?? null,
                'location' => $data['location'] ?? null,
                'description' => $data['description'] ?? null,
            ]);
            $user->companies()->attach($company->id, [
    'role' => 'owner'
]);

            $token = $user->createToken('api-token')->plainTextToken;

          DB::afterCommit(function () use ($user, $company) {
        event(new UserRegistered(
        user: $user,
        profile: $company,
        role: 'company'
    ));
});


            return [
                'user' => $user,
                'company' => $company,
                'token' => $token,
            ];
        });
    }
}