<?php

namespace Tests\Exam;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * Package Installation test
 * - On this test your will require to install and
 *   set up the package http://www.laravel-auditing.com
 *
 * 1. Install the package
 * 2. Make sure that is working on a User Model
 *
 * @package Tests\Feature\Exam
 */
class d_PackageInstallationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Install Laravel Auditing Package
     *
     * @test
     */
    public function install_a_package()
    {
        $output = null;
        exec('composer show', $output);

        $this->assertCount(1, array_filter($output, function ($item) {
            return Str::contains($item, 'owen-it/laravel-auditing');
        }));
    }

    /**
     * Set up a package following the documentation
     * - Activate the package for User Model
     * ----------------------------------------------------------------------
     * For this test, make sure that you change the following configuration:
     * audit.console = true;
     * @test
     */
    public function setup_package()
    {
        config(['audit.console' => true]);

        $user       = \App\Models\User::factory()->create();
        $user->name = 'Joe Doe';
        $user->save();

        $this->assertCount(2, $user->audits);
    }
}
