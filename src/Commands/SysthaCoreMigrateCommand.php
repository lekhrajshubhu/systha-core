<?php

namespace Systha\Core\Commands;

use Illuminate\Console\Command;

class SysthaCoreMigrateCommand extends Command
{
    protected $signature = 'systha:core:migrate {--force : Force the operation to run when in production}';

    protected $description = 'Run migrations with the shared systha core package loaded.';

    public function handle(): int
    {
        return (int) $this->call('migrate', [
            '--force' => (bool) $this->option('force'),
        ]);
    }
}
