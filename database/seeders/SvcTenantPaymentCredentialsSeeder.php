<?php

namespace Systha\Core\Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Systha\Core\Models\Tenant;
use Systha\Core\Models\TenantPaymentCredential;


class SvcTenantPaymentCredentialsSeeder extends Seeder
{
    public function run(): void
    {
        $tenants = Tenant::all();

        foreach ($tenants as $tenant) {

            // Example providers (customize as needed)
            $providers = [
                [
                    'name' => 'Stripe',
                    'code' => 'stripe',
                    'credentials' => [
                        'api_key' => 'sk_live_' . Str::random(24),
                        'publishable_key' => 'pk_live_' . Str::random(24),
                    ],
                    'is_default' => true,
                    'is_active' => true,
                ],
                [
                    'name' => 'PayPal',
                    'code' => 'paypal',
                    'credentials' => [
                        'client_id' => Str::random(20),
                        'secret' => Str::random(40),
                    ],
                    'is_default' => false,
                    'is_active' => true,
                ],
            ];

            foreach ($providers as $provider) {
                TenantPaymentCredential::updateOrCreate(
                    [
                        'code' => $provider['code'],
                        'tenant_id' => $tenant->id,
                    ],
                    [
                        'name' => $provider['name'],
                        'credentials' => $provider['credentials'],
                        'is_default' => $provider['is_default'],
                        'is_active' => $provider['is_active'],
                    ]
                );
            }
        }
    }
}
