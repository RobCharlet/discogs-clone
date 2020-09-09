<?php

namespace App\Library\UI\Controller;

use Symfony\Component\HttpFoundation\Response;

class RecordController
{
    public function index() {
        return new Response('
        <html><body><h1>Title</h1></body></html>
        ');
    }
}