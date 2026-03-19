<?php

namespace Systha\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Systha\Core\Models\Person;
use Systha\Core\Models\TenantCustomer;
use Systha\Core\Models\Tenant;

class SvcCustomerSeeder extends Seeder
{
    public function run(): void
    {
        $tenants = Tenant::query()->orderBy('id')->get();
        if ($tenants->isEmpty()) {
            return;
        }

        $sharedCustomers = [
            [
                'first_name' => 'Chris',
                'last_name' => 'Miller',
                'phone' => '+1-555-2001',
                'email' => 'chris@shared.com',
            ],
            [
                'first_name' => 'Taylor',
                'last_name' => 'Nguyen',
                'phone' => '+1-555-2002',
                'email' => 'taylor@shared.com',
            ],
            [
                'first_name' => 'Jordan',
                'last_name' => 'Patel',
                'phone' => '+1-555-2003',
                'email' => 'jordan@shared.com',
            ],
        ];

        $names = [
            'Alex Johnson', 'Morgan Smith', 'Casey Williams', 'Riley Brown', 'Avery Davis',
            'Drew Garcia', 'Jamie Martinez', 'Quinn Hernandez', 'Parker Lopez', 'Reese Gonzalez',
            'Dakota Wilson', 'Cameron Anderson', 'Rowan Thomas', 'Harper Taylor', 'Emerson Moore',
            'Logan Jackson', 'Skyler Martin', 'Payton Lee', 'Sage Perez', 'Blake Thompson',
        ];

        $passwordHash = Hash::make('password');

        foreach ($tenants as $index => $tenant) {
            $isFirstThree = $index < 3;
            $seededCustomers = [];

            if ($isFirstThree) {
                foreach ($sharedCustomers as $profile) {
                    $seededCustomers[] = $this->upsertCustomerWithAccount($tenant, $profile, $passwordHash, true);
                }
            }

            $uniqueCount = $isFirstThree ? 3 : 6;
            for ($i = 1; $i <= $uniqueCount; $i++) {
                $sequence = $i + ($index * 10);
                [$firstName, $lastName] = $this->splitName($names[$sequence % count($names)]);
                $profile = [
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'phone' => sprintf('+1-555-%04d', 3000 + $sequence),
                    'email' => $this->generateUniqueTenantEmail($tenant, $firstName, $sequence),
                ];
                $seededCustomers[] = $this->upsertCustomerWithAccount($tenant, $profile, $passwordHash, false);
            }
        }
    }

    private function upsertCustomerWithAccount(
        Tenant $tenant,
        array $profile,
        string $passwordHash,
        bool $isShared
    ): Person {
        $customer = Person::query()->firstOrCreate(
            [
                'email' => $profile['email'],
            ],
            [
                'first_name' => $profile['first_name'],
                'last_name' => $profile['last_name'],
                'phone' => $profile['phone'],
                'meta' => [
                    'seeded' => true,
                    'shared' => $isShared,
                ],
            ]
        );

        TenantCustomer::query()->updateOrCreate(
            [
                'person_id' => $customer->id,
                'tenant_id' => $tenant->id,
            ],
            [
                'first_name' => $profile['first_name'],
                'last_name' => $profile['last_name'],
                'username' => $this->buildCustomerUsername($profile['first_name']),
                'email' => $profile['email'],
                'password' => $passwordHash,
                'status' => 'active',
                'last_login_at' => null,
            ]
        );

        return $customer;
    }

    private function generateUniqueTenantEmail(Tenant $tenant, string $firstName, int $sequence): string
    {
        $base = strtolower(preg_replace('/[^a-z0-9]/', '', $firstName) ?: 'customer');

        for ($attempt = 0; $attempt < 20; $attempt++) {
            $suffix = str_pad((string) random_int(0, 999), 3, '0', STR_PAD_LEFT);
            $email = "{$base}{$suffix}@customer.com";

            $exists = TenantCustomer::query()
                ->where('tenant_id', $tenant->id)
                ->where('email', $email)
                ->exists();

            if (!$exists) {
                return $email;
            }
        }

        $fallbackSuffix = str_pad((string) ($sequence % 1000), 3, '0', STR_PAD_LEFT);
        return "{$base}{$fallbackSuffix}@customer.com";
    }

    private function splitName(string $name): array
    {
        $parts = array_values(array_filter(explode(' ', trim($name))));
        $firstName = $parts[0] ?? 'Customer';
        $lastName = $parts[1] ?? 'User';

        return [$firstName, $lastName];
    }

    private function buildCustomerUsername(string $firstName): string
    {
        $base = $this->normalizeUsernamePart($firstName);

        return 'c_' . $base;
    }

    private function normalizeUsernamePart(string $value): string
    {
        $normalized = strtolower(preg_replace('/[^a-z0-9]/i', '', $value) ?? '');

        return $normalized !== '' ? $normalized : 'customer';
    }
}
