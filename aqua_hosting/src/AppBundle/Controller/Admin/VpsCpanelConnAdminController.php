<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\VpsCpanelConn;
use AppBundle\Entity\VpsOs;
use AppBundle\Form\VpsCpanelConnFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/admin")
 */
class VpsCpanelConnAdminController extends Controller
{
    /**
     * @Route("/cpanelconn/{id}/new",name="admin_cpanelconn_new")
     */
    public function newAction(Request $request, VpsOs $vpsOs)
    {
        $form = $this->createForm(VpsCpanelConnFormType::class,
            null,
            array('attr' => array('id'=>$vpsOs->getId()))
        );

        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            $vpsCpanelConn = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($vpsCpanelConn);
            $em->flush();

            $this->addFlash('success', 'Cpanel added.');

            return $this->redirectToRoute('vps_single', array(
                'id' => $vpsOs->getId()
            ));
        }
        return $this->render('vps/admin/vpsCpanelConn/new.html.twig', [
            'cpanelForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/cpanelconn/{id}/delete",name="admin_cpanelconn_delete")
     */
    public function deleteAction(VpsCpanelConn $vpsCpanelConn)
    {
        $vpsOs_id = $vpsCpanelConn->getVpsos()->getId();

        $em = $this->getDoctrine()->getManager();
        $em->remove($vpsCpanelConn);
        $em->flush();
        $this->addFlash('success', 'Cpanel deleted.');

        return $this->redirectToRoute('vps_single', array(
            'id' => $vpsOs_id
        ));
    }
}
