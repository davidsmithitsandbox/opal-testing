<?php

namespace Tests\Feature\Console;

use Illuminate\Filesystem\Filesystem;
use Tests\TestCase;

class DeleteDirTest extends TestCase
{

    /** @test */
    public function deletes_a_directory(): void
    {
        $path       = $this->temp_dir;
        $Filesystem = new Filesystem;
        $Filesystem->makeDirectory($path, 0755, true);

        $this->artisan("delete:dir $path")
            ->expectsQuestion("Delete Directory: $path", 'true')
            ->expectsOutput("Directory Deleted: $path")
            ->assertExitCode(0);

        $Filesystem->deleteDirectory($path);
    }
}
