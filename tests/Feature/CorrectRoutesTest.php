<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Routing\Route;
use Illuminate\Routing\RouteCollectionInterface;
use Illuminate\Support\Str;
use Tests\TestCase;

class CorrectRoutesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $requiredRoutes = collect([
            ['uri' => '\/', 'controller' => 'MainController', 'method' => 'GET'],
            ['uri' => 'departments', 'controller' => 'DepartmentController', 'method' => 'GET'],
            ['uri' => 'departments\/{.+\}', 'controller' => 'DepartmentController', 'method' => 'GET'],
            ['uri' => 'departments\/{.+\}\/edit', 'controller' => 'DepartmentController', 'method' => 'GET'],
            ['uri' => 'departments\/create', 'controller' => 'DepartmentController', 'method' => 'GET'],
            ['uri' => 'departments', 'controller' => 'DepartmentController', 'method' => 'POST'],
            ['uri' => 'departments\/{.+\}', 'controller' => 'DepartmentController', 'method' => 'DELETE'],
            ['uri' => 'departments\/{.+\}', 'controller' => 'DepartmentController', 'method' => 'PUT'],
            ['uri' => 'courses', 'controller' => 'CourseController', 'method' => 'GET'],
            ['uri' => 'courses\/{.+\}', 'controller' => 'CourseController', 'method' => 'GET'],
            ['uri' => 'courses\/{.+\}\/edit', 'controller' => 'CourseController', 'method' => 'GET'],
            ['uri' => 'courses\/create', 'controller' => 'CourseController', 'method' => 'GET'],
            ['uri' => 'courses', 'controller' => 'CourseController', 'method' => 'POST'],
            ['uri' => 'courses\/{.+\}', 'controller' => 'CourseController', 'method' => 'DELETE'],
            ['uri' => 'courses\/{.+\}', 'controller' => 'CourseController', 'method' => 'PUT'],
        ]);

        /** @var RouteCollectionInterface $routes */
        $routes = app('router')->getRoutes();
        $routes = collect($routes->getRoutes())->map(function (Route $route)
        {

            return [
                'uri'        => $route->uri,
                'controller' => array_key_exists('controller', $route->action) ? $route->action['controller'] : null,
                'method'     => $route->methods()[0]
            ];
        })->reject(function ($route)
        {
            return $route['controller'] == null;
        });

        foreach ($requiredRoutes as $requiredRoute)
        {
            $pattern       = '/^' . $requiredRoute['uri'] . '$/';
            $foundRoute    = $routes->first(function ($route) use ($requiredRoute, $pattern)
            {
                return preg_match($pattern, $route['uri']) === 1 && $route['method'] == $requiredRoute['method'];
            });
            $replacedRoute = Str::replace('\\', '', preg_replace('/{.+}/', '*', $requiredRoute['uri']));
            $this->assertNotNull($foundRoute, "Expected a a route with the URI [$replacedRoute] with method [{$requiredRoute['method']}], but it wasn't found.");

            if ($foundRoute != null)
            {
                $foundControllerName = Str::match("/([a-zA-Z]+)@/", $foundRoute['controller']);
                $this->assertEqualsIgnoringCase($foundControllerName, $requiredRoute['controller'], "Expected route {$requiredRoute['method']} $replacedRoute to bind to a controller named [{$requiredRoute['controller']}], but it is bound to [$foundControllerName]");
            }
        }
    }

}
