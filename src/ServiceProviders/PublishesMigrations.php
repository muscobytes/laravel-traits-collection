<?php
/**
 * PublishesMigrations
 *
 * This is modified version of the original
 * @link https://github.com/DarkGhostHunter/Laratraits
 *
 * The following traits is intended for package developers. This will find
 * all migrations properly named located in the default `database/migrations`
 * directory, and it will proceed to register each of them as publishable.
 *
 *
 *     public function boot(): void
 *     {
 *         $this->publishMigrations();
 *     }
 *
 */

namespace Muscobytes\Laravel\TraitsCollection\ServiceProviders;

use Generator;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;

/**
 * @property Application $app
 * @method void publishes(array $paths, mixed $groups = null)
 */
trait PublishesMigrations
{
    /**
     * Searches migrations and publishes them as assets.
     * @see https://darkghosthunter.medium.com/laravel-packages-load-or-publish-migrations-119db770c870
     *
     * @param string $directory
     * @return void
     * @throws BindingResolutionException
     */
    protected function registerMigrations(string $directory): void
    {
        if ($this->app->runningInConsole()) {
            $generator = function(string $directory): Generator {
                $i = 0;
                foreach ($this->app->make('files')->allFiles($directory) as $file) {
                    yield $file->getPathname() => $this->app->databasePath(
                        preg_replace(
                            pattern: '/([0-9]{4}_[0-9]{2}_[0-9]{2}_[0-9]{6})/',
                            replacement: now()->addSeconds(++$i)->format('Y_m_d_His'),
                            subject: $file->getFilename()
                        )
                    );
                }
            };

            $this->publishes(iterator_to_array($generator($directory)), 'migrations');
        }
    }
}