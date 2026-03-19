<?php

namespace Systha\Core\Commands;

use Illuminate\Console\Command;
use Systha\Core\Database\Seeders\SvcAdminSeeder;
use Systha\Core\Database\Seeders\SvcCompanySeeder;
use Systha\Core\Database\Seeders\SvcCustomerSeeder;
use Systha\Core\Database\Seeders\SvcEmailTemplateSeeder;
use Systha\Core\Database\Seeders\SvcServiceCategorySeeder;
use Systha\Core\Database\Seeders\SvcServiceGroupQuestionSeeder;
use Systha\Core\Database\Seeders\SvcServiceItemQuestionSeeder;
use Systha\Core\Database\Seeders\SvcTenantPaymentCredentialsSeeder;
use Systha\Core\Database\Seeders\SvcTenantSeeder;

class CoreSeedCommand extends Command
{
    protected $signature = 'core:seed';

    protected $description = 'Seed core data step-by-step (admin, categories+groups+items, group questions, item questions, tenants).';

    public function handle(): int
    {
        $this->components->info('Seeding core package data...');

        $this->runSeeder(SvcAdminSeeder::class, 'SvcAdminSeeder');
        $this->runSeeder(SvcServiceCategorySeeder::class, 'SvcServiceCategorySeeder');
        $this->runSeeder(SvcServiceGroupQuestionSeeder::class, 'SvcServiceGroupQuestionSeeder');
        $this->runSeeder(SvcServiceItemQuestionSeeder::class, 'SvcServiceItemQuestionSeeder');
        $this->runSeeder(SvcTenantSeeder::class, 'SvcTenantSeeder');
        $this->runSeeder(SvcCustomerSeeder::class, 'SvcCustomerSeeder');
        $this->runSeeder(SvcCompanySeeder::class, 'SvcCompanySeeder');
        $this->runSeeder(SvcEmailTemplateSeeder::class, 'SvcEmailTemplateSeeder');
        $this->runSeeder(SvcTenantPaymentCredentialsSeeder::class, 'SvcTenantPaymentCredentialsSeeder');

        $this->components->info('core:seed completed.');

        return self::SUCCESS;
    }

    private function runSeeder(string $class, string $label): void
    {
        $this->components->task("Running {$label}", function () use ($class): bool {
            $exitCode = $this->call('db:seed', [
                '--class' => $class,
                '--force' => true,
            ]);

            return $exitCode === self::SUCCESS;
        });
    }
}
