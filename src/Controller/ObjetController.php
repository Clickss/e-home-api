<?php

namespace App\Controller;

use App\Entity\Etage;
use App\Entity\Maison;
use App\Entity\ObjetPiece;
use App\Entity\Piece;
use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/api/utilisateurs/{id_u}/maisons/{id_m}/etages/{id_e}/pieces/{id_p}/objets")
 */
class ObjetController extends Controller
{
    /**
     * @Route("", name="options_objet")
     * @Method({"OPTIONS"})
     */
    public function optionsAction(Request $request)
    {
        $response = new Response(json_encode("Ok"), Response::HTTP_OK);

        $response->headers->set('Content-Type', 'text/plain');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Headers', '*');
        return $response;
    }

    /**
     * @Route("/{id}", name="objet_show")
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
                $data = $this->get('jms_serializer')->serialize($objetPiece->getObjet(), 'json');

                $response = new Response($data);
                $response->headers->set('Content-Type', 'application/json');
                $response->headers->set('Access-Control-Allow-Origin', '*');
                $response->headers->set('Access-Control-Allow-Headers', '*');
            }
        }

        return $response;
    }

    /**
     * @Route("", name="objet_list")
     * @Method({"GET"})
     */
    public function listAction(Request $request)
    {
        $objetPieces = $this->getDoctrine()->getRepository("App:ObjetPiece")->findBy(["piece" => $request->get('id_p')]);

        $objets = array();
        foreach ($objetPieces as $objetPiece) {
            array_push($objets, $objetPiece->getObjet());
        }

        $data = $this->get('jms_serializer')->serialize($objets, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Headers', '*');

        return $response;
    }
}
