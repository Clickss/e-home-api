<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/api/auth")
 */
class AuthentificationController extends Controller {
    
    /**
     * @Route("", name="authentification")
     * @Method({"POST"})
     */
    public function authentificationAction(Request $request)
    {
        var_dump($request);
        return 1;
    }
}
