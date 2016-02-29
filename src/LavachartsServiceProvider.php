<?php

namespace Khill\Lavacharts\Laravel;

use \Khill\Lavacharts\Lavacharts;
use \Illuminate\Support\ServiceProvider;
use \Illuminate\Foundation\AliasLoader;

/**
 * Lavacharts Service Provider
 *
 * Registers Lavacharts with Laravel while also registering the Facade and Template extensions.
 * The Alias is also automatically loaded so you can access Lavacharts with the "Lava::" syntax
 *
 *
 * @package    Khill\Lavacharts
 * @subpackage Laravel
 * @author     Kevin Hill <kevinkhill@gmail.com>
 * @copyright  (c) 2015, KHill Designs
 * @link       http://github.com/kevinkhill/lavacharts GitHub Repository Page
 * @link       http://lavacharts.com                   Official Docs Site
 * @license    http://opensource.org/licenses/MIT MIT
 */
class LavachartsServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        require(__DIR__.'/BladeTemplateExtensions.php');

        $bladeExtensions = new BladeTemplateExtensions();

        $bladeExtensions->registerChartDirectives();
        $bladeExtensions->registerRenderAllDirective();
    }

    public function register()
    {
        $this->app['lavacharts'] = $this->app->share(
            function () {
                return new Lavacharts;
            }
        );

        $this->app->booting(
            function () {
                $loader = AliasLoader::getInstance();
                $loader->alias('Lava', 'Khill\Lavacharts\Laravel\LavachartsFacade');
            }
        );
    }

    public function provides()
    {
        return ['lavacharts'];
    }
}
