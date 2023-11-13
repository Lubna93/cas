<?php

namespace App\Controller;

use App\Entity\User;
use App\WsApogeeBundle\DependencyInjection\EtatIA;
use App\WsApogeeBundle\DependencyInjection\WsAdministratif;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    /**
     *
     * @Route("/main", name="main")
     * @param WsAdministratif $ws
     * @return Response
     */

    public function main(WsAdministratif $ws): Response
    {
		$ws->setFastResponse(true);

        $utilisateur = $this->get('security.token_storage')->getToken()->getUser();
        // $utilisateur->getUsername();

        $cursus = $ws->recupererCursusExterne($utilisateur);
        dump($cursus);

        $iaEtapesV2 = $ws->recupererIAEtapes_v2($utilisateur);
        dump($iaEtapesV2);

        $iaEtapesV3 = $ws->recupererIAEtapes_v3($utilisateur);
        dump($iaEtapesV3);

        $anneesIa = $ws->recupererAnneesIa($utilisateur, EtatIA::enCours());
        dump($anneesIa);

        $iaAnnuellesV2 = $ws->recupererIAAnnuelles_v2($utilisateur);
        dump($iaAnnuellesV2);

        // $cursus = $ws->recupererCursusExterne('21909929');
        // dump($cursus);

        // $iaEtapesV2 = $ws->recupererIAEtapes_v2('21909929');
        // dump($iaEtapesV2);

        // $iaEtapesV3 = $ws->recupererIAEtapes_v3('21909929');
        // dump($iaEtapesV3);

        // $anneesIa = $ws->recupererAnneesIa('21909929', EtatIA::enCours());
        // dump($anneesIa);

        // $iaAnnuellesV2 = $ws->recupererIAAnnuelles_v2('21909929');
        // dump($iaAnnuellesV2);

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'utilisateur' => $utilisateur,
            'iaAnnuellesV2' => $ws->recupererIAAnnuelles_v2($utilisateur),
            'iaEtapesV2' => $ws->recupererIAEtapes_v2($utilisateur),
            'iaEtapesV3' =>$ws->recupererIAEtapes_v3($utilisateur),
        ]);
    }

}
