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
            ->expectsOutput("Directory Deleted: $path")
            ->assertExitCode(0);

        $this->assertFalse($Filesystem->exists($this->temp_dir));

        $Filesystem->deleteDirectory($path);
    }

    /** @test */
    public function deletes_a_directory_interactive_yes(): void
    {
        $path       = $this->temp_dir;
        $Filesystem = new Filesystem;
        $Filesystem->makeDirectory($path, 0755, true);

        $this->artisan("delete:dir $path --i")
            ->expectsQuestion("Delete Directory: $path", 'y')
            ->expectsOutput("Directory Deleted: $path")
            ->assertExitCode(0);

        $this->assertFalse($Filesystem->exists($this->temp_dir));

        $Filesystem->deleteDirectory($path);
    }

    /** @test */
    public function deletes_a_directory_interactive_no(): void
    {
        $path       = $this->temp_dir;
        $Filesystem = new Filesystem;
        $Filesystem->makeDirectory($path, 0755, true);

        $this->artisan("delete:dir $path --i")
            ->expectsQuestion("Delete Directory: $path", null)
            ->expectsOutput('No action taken')
            ->assertExitCode(0);

        $this->assertTrue($Filesystem->exists($this->temp_dir));

        $Filesystem->deleteDirectory($path);
    }
}
