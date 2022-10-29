<?php

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\Response;

class ApplicationController
{
    #[Route('/app/index')]
    public function index(): Response
    {
        var_dump('test-test'); exit();
    }
}
