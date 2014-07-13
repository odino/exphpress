<?php

namespace Exphpress;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Boots a brand new application.
 */
function app(Request $req = null, Response $res = null) {
  return new App($req ?: Request::createFromGlobals(), $res ?: new Response());
}