<?php

namespace App\Controller;

use App\Entity\Etage;
use App\Entity\Maison;
use App\Entity\Objet;
use App\Entity\ObjetPiece;
use App\Entity\Piece;
use App\Entity\Programmation;
use App\Entity\Utilisateur;
use App\Entity\ValeursObjet;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/api/utilisateurs/{id_u}/maisons/{id_m}/etages/{id_e}/pieces/{id_p}/objets/{id_o}/programmations")
 */
class ProgrammationController extends Controller
{
    /**
     * @Route("", name="options_programmation")
     * @Route("/{id}", name="optionsid_programmation")
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
     * @Route("", name="programmation_add")
     * @Method({"POST"})
     */
    public function addAction(Request $request)
    {
        $data = $request->getContent();
        $programmation = $this->get('jms_serializer')->deserialize($data, Programmation::class, 'json');

        $objetpiece = $this->getDoctrine()->getRepository(ObjetPiece::class)->find($request->get('id_o'));
        $programmation->setObjetPiece($objetpiece);

        $em = $this->getDoctrine()->getManager();
        $em->persist($programmation);
        $em->flush();

        $data = $this->get('jms_serializer')->serialize($programmation, 'json');

        $response = new Response($data, Response::HTTP_CREATED);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', '*');
        $response->headers->set('Access-Control-Allow-Headers', '*');

        return $response;
    }
    
    /**
     * @Route("/{id}", name="programmation_show")
     * @Method({"GET"})
     */
    public function showAction(Request $request)
    {
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->find($request->get('id_u'));
        $maison = $this->getDoctrine()->getRepository(Maison::class)->find($request->get('id_m'));
        $etage = $this->getDoctrine()->getRepository(Etage::class)->find($request->get('id_e'));
        $piece = $this->getDoctrine()->getRepository(Piece::class)->find($request->get('id_p'));
        $objetPiece = $this->getDoctrine()->getRepository(ObjetPiece::class)->findOneBy(["piece" => $request->get('id_p'), "objet" => $request->get('id')]);

        if (!$objetPiece) {
            throw $this->createNotFoundException(
                $response = new Response('', Response::HTTP_NOT_FOUND)
            );
        }
        else {
            if($etage != $objetPiece->getPiece()->getEtage() || $maison != $objetPiece->getPiece()->getEtage()->getMaison() || $utilisateur != $piece->getEtage()->getMaison()->getUtilisateur())
            {
                throw $this->createNotFoundException(
                    $response = new Response('', Response::HTTP_NOT_FOUND)
                );
            }
            else {
                $data = $this->get('jms_serializer')->serialize($objetPiece, 'json');

                $response = new Response($data, Response::HTTP_OK);
                $response->headers->set('Content-Type', 'application/json');
                $response->headers->set('Access-Control-Allow-Origin', '*');
                $response->headers->set('Access-Control-Allow-Methods', '*');
                $response->headers->set('Access-Control-Allow-Headers', '*');
            }
        }

        return $response;
    }
    
    /**
     * @Route("/{id}", name="programmation_delete")
     * @Method({"DELETE"})
     */
    public function deleteAction(Request $request)
    {
        $programmation = $this->getDoctrine()->getRepository(Programmation::class)->find($request->get('id'));
        
        if (!$programmation) {
            throw $this->createNotFoundException(sprintf(
                'Programmation inconnue'
            ));
        }
        else
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($programmation);
            $em->flush();
        }

        $response = new Response(null, Response::HTTP_OK);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', '*');
        $response->headers->set('Access-Control-Allow-Headers', '*');
                
        return $response;
    }

    /**
     * @Route("", name="programmation_list")
     * @Method({"GET"})
     */
    public function listAction(Request $request)
    {
        $programmations = $this->getDoctrine()->getRepository("App:Programmation")->findBy(["objet_piece" => $request->get('id_o')]);

        $data = $this->get('jms_serializer')->serialize($programmations, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', '*');
        $response->headers->set('Access-Control-Allow-Headers', '*');

        return $response;
    }
}
