<?php

namespace CodePress\CodeUser\Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Auth\AuthServiceProvider;
use Illuminate\Auth\Passwords\PasswordResetServiceProvider;

class AbstractTestCase extends TestCase
{

    public function migrate()
    {
        $this->artisan('migrate', [
            '--realpath' => realpath(__DIR__ . '/../src/resources/migrations')
        ]);
        $this->artisan('migrate', [
            '--realpath' => realpath(__DIR__ . '/../../codeuser/src/resources/migrations')
        ]);
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
        config([
            'auth'=> require __DIR__.'/../src/config/auth.php' 
        ]);
    }

    public function getPackageProviders()
    {
        return [
            AuthServiceProvider::class,
            PasswordResetServiceProvider::class
        ];
    }

}
