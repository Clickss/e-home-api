<?php

namespace App\Controller;

use App\Entity\Objet;
use App\Entity\ObjetPiece;
use App\Entity\AttributObjet;
use App\Entity\ValeursObjet;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/api/objets/{id_o}/attributs")
 */
class AttributObjetController extends Controller
{
    /**
     * @Route("", name="options_attributobjet")
     * @Route("/{id}", name="optionsid_attributobjet")
     * @Method({"OPTIONS"})
     */
    public function optionsAction(Request $request)
    {
        $response = new Response(json_encode("Ok"), Response::HTTP_OK);

        $response->headers->set('Content-Type', 'text/plain');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', '*');
        $response->headers->set('Access-Control-Allow-Headers', '*');
        return $response;
    }

    /**
     * @Route("", name="attributobjet_add")
     * @Method({"POST"})
     */
    public function addAction(Request $request)
    {
        
        return new Response($data, Response::HTTP_CREATED);
    }

    /**
     * @Route("/{id}", name="attributobjet_show")
     * @Method({"GET"})
     */
    public function showAction(Request $request)
    {
        $attributObjet = $this->getDoctrine()->getRepository(AttributObjet::class)->find($request->get('id'));
        
        if ($attributObjet == null) {
            throw $this->createNotFoundException(
                $response = new Response('', Response::HTTP_NOT_FOUND)
            );
        }
        else {
            $data = $this->get('jms_serializer')->serialize($attributObjet, 'json');
            $response = new Response($data);
            $response->headers->set('Content-Type', 'application/json');
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->headers->set('Access-Control-Allow-Headers', '*');
        }
        
        return $response;
    }
    
    /**
     * @Route("/{id}", name="attributobjet_delete")
     * @Method({"DELETE"})
     */
    public function deleteAction(Request $request)
    {
        
        return new Response(null, Response::HTTP_OK);
    }

    /**
     * @Route("", name="attributobjet_list")
     * @Method({"GET"})
     */
    public function listAction(Request $request)
    {
        
        return new Response();
    }
}
