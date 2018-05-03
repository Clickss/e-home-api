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
     * @Route("", name="authentification2")
     * @Method({"OPTIONS"})
     */
    public function authentificatioAction(Request $request)
    {
        $response = new Response(json_encode("llt"), Response::HTTP_CREATED);
        $response->headers->set('Content-Type', 'text/plain');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Headers', '*');
        return $response;
    }
    
    /**
     * @Route("", name="authentification")
     * @Method({"POST"})
     */
    public function authentificationAction(Request $request)
    {
        $response = new Response(json_encode("lol"), Response::HTTP_CREATED);
        $response->headers->set('Content-Type', 'text/plain');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Headers', '*');
        return $response;
    }
}
