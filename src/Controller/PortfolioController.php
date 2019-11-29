<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PortfolioController extends AbstractController
{

    public function portfolio()
    {
        return $this->render('portfolio/portfolio.html.twig', [
            'controller_name' => 'PortfolioController',
        ]);
    }

    public function project01()
    {
        return $this->render('portfolio/first-project.html.twig', [
            'controller_name' => 'PortfolioController',
        ]);
    }

}
