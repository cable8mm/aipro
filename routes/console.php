<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Laravel\Nova\Fields\Attachments\PruneStaleAttachments;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(new PruneStaleAttachments)->daily();

/**
 * @link https://laravel.com/docs/11.x/sanctum#token-expiration
 */
Schedule::command('sanctum:prune-expired --hours=24')->daily();
