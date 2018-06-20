<?php

namespace App\Controller;

use App\Entity\Etage;
use App\Entity\Maison;
use App\Entity\Ambiance;
use App\Entity\ObjetPiece;
use App\Entity\Piece;
use App\Entity\Utilisateur;
use App\Entity\ValeursObjet;
use App\Form\AmbianceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/api/utilisateurs/{id_u}/maisons/{id_m}/etages/{id_e}/pieces/{id_p}/ambiances")
 */
class AmbianceController extends Controller
{
    /**
     * @Route("", name="options_ambiance")
     * @Route("/{id}", name="optionsid_ambiance")
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
     * @Route("", name="ambiance_add")
     * @Method({"POST"})
     */
    public function addAction(Request $request)
    {
        $data = $request->getContent();
        $ambiance = $this->get('jms_serializer')->deserialize($data, Ambiance::class, 'json');
        
        $piece = $this->getDoctrine()->getRepository(Piece::class)->find($request->get('id_p'));
        $ambiance->setPiece($piece);

        $em = $this->getDoctrine()->getManager();
        $em->persist($ambiance);
        $em->flush();

        $data = $this->get('jms_serializer')->serialize($ambiance, 'json');

        $response = new Response($data, Response::HTTP_CREATED);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', '*');
        $response->headers->set('Access-Control-Allow-Headers', '*');

        return $response;
    }
    
    /**
     * @Route("/{id}", name="ambiance_edit")
     * @Method({"POST"})
     */
    public function editAction(Request $request)
    {
        $ambiance = $this->getDoctrine()->getManager()->getRepository(Ambiance::class)->find($request->get('id'));

        if (!$ambiance) {
            throw $this->createNotFoundException(
                $response = new Response('', Response::HTTP_NOT_FOUND)
            );
        }

        $data = $this->get('jms_serializer')->deserialize($request->getContent(), Ambiance::class, 'json');

        $form = $this->createForm(AmbianceType::class, $ambiance);
        $form->submit(array(
            "nom" => $data->getNom(),
            "ambiance" => $data->getAmbiance()
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
     * @Route("/{id}", name="ambiance_show")
     * @Method({"GET"})
     */
    public function showAction(Request $request)
    {
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->find($request->get('id_u'));
        $maison = $this->getDoctrine()->getRepository(Maison::class)->find($request->get('id_m'));
        $etage = $this->getDoctrine()->getRepository(Etage::class)->find($request->get('id_e'));
        $piece = $this->getDoctrine()->getRepository(Piece::class)->find($request->get('id_p'));
        $ambiance = $this->getDoctrine()->getRepository(Ambiance::class)->find($request->get('id'));

        if (!$ambiance) {
            throw $this->createNotFoundException(
                $response = new Response('', Response::HTTP_NOT_FOUND)
            );
        }
        else {
            if($etage != $ambiance->getPiece()->getEtage() || $maison != $ambiance->getPiece()->getEtage()->getMaison() || $utilisateur != $piece->getEtage()->getMaison()->getUtilisateur())
            {
                throw $this->createNotFoundException(
                    $response = new Response('', Response::HTTP_NOT_FOUND)
                );
            }
            else {
                $data = $this->get('jms_serializer')->serialize($ambiance, 'json');

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
     * @Route("/{id}", name="ambiance_delete")
     * @Method({"DELETE"})
     */
    public function deleteAction(Request $request)
    {
        $ambiance = $this->getDoctrine()->getRepository(Ambiance::class)->find($request->get('id'));
        
        if (!$ambiance) {
            throw $this->createNotFoundException(sprintf(
                'Ambiance inconnue'
            ));
        }
        else
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ambiance);
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
     * @Route("", name="ambiance_list")
     * @Method({"GET"})
     */
    public function listAction(Request $request)
    {
        $ambiances = $this->getDoctrine()->getRepository("App:Ambiance")->findBy(["piece" => $request->get('id_p')]);

        $data = $this->get('jms_serializer')->serialize($ambiances, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Headers', '*');

        return $response;
    }
}
