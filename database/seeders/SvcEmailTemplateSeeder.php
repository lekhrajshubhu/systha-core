<?php

namespace Systha\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SvcEmailTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $path = __DIR__ . '/data/email_templates.json';
        if (!File::exists($path)) {
            return;
        }

        $raw = File::get($path);
        $templates = json_decode($raw, true);

        if (!is_array($templates)) {
            return;
        }

        foreach ($templates as $template) {
            if (!is_array($template) || empty($template['code'])) {
                continue;
            }

            DB::table('svc_email_templates')->updateOrInsert(
                ['code' => $template['code']],
                [
                    'tenant_id' => null,
                    'name' => $template['name'] ?? '',
                    'subject' => $template['subject'] ?? '',
                    'required_fields' => $template['required_fields'] ?? null,
                    'body' => $template['body'] ?? '',
                    'meta' => array_key_exists('meta', $template) ? json_encode($template['meta']) : null,
                    'is_active' => array_key_exists('is_active', $template) ? (bool) $template['is_active'] : true,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}
