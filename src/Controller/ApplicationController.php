<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\CommissionManager;

class ApplicationController extends AbstractController
{
    #[Route('/application/index')]
    public function index(CommissionManager $commissionManager): Response
    {
        $commissions = $commissionManager->getCommissions();

        return $this->render('app/index.html.twig', [
            'commissions' => $commissions
        ]);
    }
}
