<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('build-one', function () {
    while (true) {
        $build = \App\Build::orderBy('created_at', 'asc')
            ->whereNull('processing_at')
            ->whereNull('canceled_at')
            ->whereNull('failed_at')
            ->first();
        if (!$build) {
            sleep(1);
            continue;
        }
        $this->comment("Building $build->id");
        $build->update([
            'processing_at' => to_datetime('now'),
        ]);


        try {
            $input = escapeshellarg(storage_path("app/public/$build->input"));

            $this->comment("Cleaning previous project...");
            exec("rm -rf /builder/www", $stdout, $exit_code);
            if ($exit_code) throw new \Exception("Failed");

            exec("mkdir /builder/www", $stdout, $exit_code);
            if ($exit_code) throw new \Exception("Failed");

            $this->comment("Unzipping input...");
            exec("unzip $input -d /builder/www", $stdout, $exit_code);
            if ($exit_code) throw new \Exception("Failed");

            $this->comment("Running build script...");
            exec("bash /builder/build.sh", $stdout, $exit_code);
            if ($exit_code) throw new \Exception("Failed");

            $apk_release_path = '/builder/android/app/build/outputs/apk/release/app-release-unsigned.apk';
            $apk_debug_path = '/builder/android/app/build/outputs/apk/debug/app-debug.apk';
            if (!is_file($apk_release_path) || !is_file($apk_debug_path)) {
                throw new \Exception("Could not generate apk file");
            }
            copy($apk_release_path, storage_path("app/public/{$build->id}-release.apk"));
            copy($apk_debug_path, storage_path("app/public/{$build->id}-debug.apk"));

            $build->update([
                'built_at' => to_datetime('now'),
            ]);

            $this->comment("Built successfully!");

        } catch(\Exception $e) {
            $this->error("Error while building: {$e->getMessage()}");
            $build->update([
                'failed_at' => to_datetime('now'),
            ]);
            sleep(5);
        }
    }

})->describe('Display an inspiring quote');
