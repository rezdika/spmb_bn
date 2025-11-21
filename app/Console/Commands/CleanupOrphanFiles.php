<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\PendaftarBerkas;

class CleanupOrphanFiles extends Command
{
    protected $signature = 'cleanup:orphan-files';
    protected $description = 'Clean up orphaned files';

    public function handle()
    {
        // Cleanup profile photos
        $files = Storage::disk('public')->files('profile_photos');
        $usedFiles = User::whereNotNull('foto_profile')->pluck('foto_profile')->toArray();
        
        $deleted = 0;
        foreach ($files as $file) {
            if (!in_array($file, $usedFiles)) {
                Storage::disk('public')->delete($file);
                $deleted++;
            }
        }
        
        // Cleanup berkas files
        $berkasFiles = Storage::disk('public')->files('berkas');
        $usedBerkas = PendaftarBerkas::pluck('url')->toArray();
        
        foreach ($berkasFiles as $file) {
            if (!in_array($file, $usedBerkas)) {
                Storage::disk('public')->delete($file);
                $deleted++;
            }
        }
        
        $this->info("Deleted {$deleted} orphaned files");
    }
}