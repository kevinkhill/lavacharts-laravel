<?php

namespace Khill\Lavacharts\Laravel;

use Illuminate\Support\Facades\App;
use Khill\Lavacharts\Charts\ChartFactory;

/**
 * Blade Template Extensions
 *
 * Custom Blade directives for seamless integration into views.
 *
 * @package    Khill\Lavacharts
 * @subpackage Laravel
 * @author     Kevin Hill <kevinkhill@gmail.com>
 * @copyright  (c) 2016, KHill Designs
 * @link       http://github.com/kevinkhill/lavacharts GitHub Repository Page
 * @link       http://lavacharts.com                   Official Docs Site
 * @license    http://opensource.org/licenses/MIT MIT
 */
class BladeTemplateExtensions
{
    /**
     * Instance of the Blade Compiler
     *
     * \Illuminate\View\Compilers\BladeCompiler
     */
    private $blade;

    public function __construct()
    {
        $app = App::getFacadeApplication();

        $this->blade = $app['view']->getEngineResolver()->resolve('blade')->getCompiler();
    }

    /**
     * Register renderAll directive.
     *
     * This will enable a parameter-less method for rendering all defined charts.
     *
     * @since 3.1.0
     */
    public function registerRenderAllDirective()
    {
        $this->blade->directive('renderAll', function ($expression) {
            return "<?= Lava::renderAll(); ?>";
        });
    }

    /**
     * Register chart specific directives.
     *
     * This will enable using lowercased chart types as directives in templates
     *
     * @since 2.5.0
     */
    public function registerChartDirectives()
    {
        foreach (ChartFactory::getChartTypes() as $chart) {
            $this->blade->directive(strtolower($chart), function ($expression) use ($chart) {
                $expression = ltrim($expression, '(');

                return "<?= Lava::render('$chart', $expression; ?>";
            });
        }
    }
}
