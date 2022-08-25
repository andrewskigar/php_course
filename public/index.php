<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();

$currency = $request->query->keys() ? current($request->query->keys()) : 'bitcoin';
if (! in_array($currency, ['bitcoin', 'eth'])) {
    $redirectResponse = new RedirectResponse($request->getSchemeAndHttpHost());
    $redirectResponse->send();
}

$template = include_once __DIR__ . '/../templates/cur.template.php';

$response = new Response();
$response->setContent($template);
$response->headers->set('Content-Type', 'text/html');
$response->headers->setCookie(new Cookie('x-developer', 'Andrew Skigar'));
$response->setStatusCode(Response::HTTP_OK);

$response->send();
