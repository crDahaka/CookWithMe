<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('recipe_index', new Route(
    '/',
    array('_controller' => 'AppBundle:Recipe:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('recipe_show', new Route(
    '/{id}/show',
    array('_controller' => 'AppBundle:Recipe:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('recipe_new', new Route(
    '/new',
    array('_controller' => 'AppBundle:Recipe:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('recipe_edit', new Route(
    '/{id}/edit',
    array('_controller' => 'AppBundle:Recipe:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('recipe_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'AppBundle:Recipe:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

return $collection;
