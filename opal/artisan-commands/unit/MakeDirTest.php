<?php

namespace Tests\Feature\Console;

use Illuminate\Filesystem\Filesystem;
use Tests\TestCase;

class MakeDirTest extends TestCase
{

    /** @test */
    public function makes_directory(): void
    {
        $path       = $this->temp_dir;
        $Filesystem = new Filesystem;
        $Filesystem->deleteDirectory($path);
        $this->artisan("make:dir $path")
            ->expectsOutput('Directory created: ' . $path)
            ->assertExitCode(0);
        $Filesystem->deleteDirectory($path);
    }

    /** @test */
    public function warns_of_existing_dir(): void
    {
        $path       = $this->temp_dir;
        $Filesystem = new Filesystem;
        $Filesystem->makeDirectory($path);
        $this->artisan("make:dir $path")
            ->expectsOutput('Directory already exists: ' . $path)
            ->assertExitCode(0);
        $Filesystem->deleteDirectory($path);
    }

    /** @test */
    public function makes_directory_i(): void
    {
        $path       = $this->temp_dir;
        $Filesystem = new Filesystem;
        $Filesystem->deleteDirectory($path);
        $this->artisan("make:dir $path --i")
            ->expectsQuestion('Path to Directory', $path)
            ->expectsOutput('Directory created: ' . $path)
            ->assertExitCode(0);
        $Filesystem->deleteDirectory($path);
    }

    /** @test */
    public function warns_of_existing_dir_i(): void
    {
        $path       = $this->temp_dir;
        $Filesystem = new Filesystem;
        $Filesystem->makeDirectory($path);
        $this->artisan("make:dir $path --i")
            ->expectsQuestion('Path to Directory', $path)
            ->expectsOutput('Directory already exists: ' . $path)
            ->assertExitCode(0);
        $Filesystem->deleteDirectory($path);
    }
}
