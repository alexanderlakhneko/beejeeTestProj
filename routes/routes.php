<?php

use vendor\core\Router;

Router::add('^exercises/?(?P<action>[a-z-]+)?$', ['controller' => 'Exercises', 'action' => 'index']);
Router::add('^admin/?(?P<action>[a-z-]+)?$', ['controller' => 'Admin', 'action' => 'logout']);
Router::add('^$', ['controller' => 'Exercises', 'action' => 'index']);