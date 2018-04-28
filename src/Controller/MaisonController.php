<?php

namespace App\Controller;

use App\Entity\Maison;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class MaisonController extends Controller
{
    /**
     * @Route("/maisons/{id}", name="maison_show")
     * @Method({"GET"})
     */

    public function showAction($id)
    {
        $maison = $this->getDoctrine()->getRepository(Maison::class)->find($id);

        if (!$maison) {
            $response = new Response('', Response::HTTP_NOT_FOUND);
        }
        else {
            $data = $this->get('jms_serializer')->serialize($maison, 'json');

            $response = new Response($data);
            $response->headers->set('Content-Type', 'application/json');
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->headers->set('Access-Control-Allow-Headers', '*');
        }

        return $response;
    }

    /**
     * @Route("/maisons", name="maison_add")
     * @Method({"POST"})
     */
    public function addAction(Request $request)
    {
        $data = $request->getContent();
        $article = $this->get('jms_serializer')->deserialize($data, Maison::class, 'json');

        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();

        return new Response('', Response::HTTP_CREATED);
    }

    /**
     * @Route("/maisons/{id}", name="maison_delete")
     * @Method({"DELETE"})
     */
    public function deleteAction($id)
    {
        $maison = $this->getDoctrine()->getRepository(Maison::class)->find($id);

        if (!$maison) {
            throw $this->createNotFoundException(sprintf(
                'Maison inconnue'
            ));
        }
        else
        {
            //$data = $this->get('jms_serializer')->serialize($maison, 'json');

            $em = $this->getDoctrine()->getManager();
            $em->remove($maison);
            $em->flush();
        }

        return new Response(null, Response::HTTP_OK);
    }

    /**
     * @Route("/maisons", name="maison_list")
     * @Method({"GET"})
     */
    public function listAction()
    {
        $maisons = $this->getDoctrine()->getRepository("App:Maison")->findAll();

        $data = $this->get('jms_serializer')->serialize($maisons, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Headers', '*');

        return $response;
    }


}