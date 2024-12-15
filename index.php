<?php

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(CONF_URL_BASE);

$router->namespace("Source\Controllers");

$router->group(null);
$router->get("/", "Form:home", "form.home");
$router->post("/create", "Form:create", "form.create");
$router->post("/delete", "Form:delete", "form.delete");

$router->group("ops");
$router->get("/{errcode}", function ($data) {
	echo "<h1> Erro {$data["errcode"]}</h1>";
});

$router->dispatch();

if ($router->error()) {
	$router->redirect("/ops/{$router->error()}");
}
