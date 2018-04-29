<?php

namespace App\Controller;

use App\Entity\Maison;
use App\Form\MaisonType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/api")
 */
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
     * @Route("/maisons/{id}", name="maison_edit")
     * @Method({"PUT"})
     */
    public function editAction(Request $request)
    {
        $maison = $this->getDoctrine()->getManager()->getRepository(Maison::class)->find($request->get('id'));

        if (!$maison) {
            throw $this->createNotFoundException(
                $response = new Response('', Response::HTTP_NOT_FOUND)
            );
        }

        $data = $this->get('jms_serializer')->deserialize($request->getContent(), Maison::class, 'json');

        $form = $this->createForm(MaisonType::class, $maison);
        $form->submit(array(
            "nom" => $data->getNom(),
            "etages" => $data->getEtages()
        ));

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return new Response(null, Response::HTTP_OK);
        } else {
            return new Response(null, Response::HTTP_NOT_MODIFIED);
        }


    }

    /**
     * @Route("/maisons", name="maison_add")
     * @Method({"PUT"})
     */
    public function addAction(Request $request)
    {
        $data = $request->getContent();
        $maison = $this->get('jms_serializer')->deserialize($data, Maison::class, 'json');

        $em = $this->getDoctrine()->getManager();
        $em->persist($maison);
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