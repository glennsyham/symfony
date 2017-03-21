<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\VpsOs;
use AppBundle\Form\VpsOsFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/admin")
 */
class VpsOsAdminController extends Controller
{

    /**
     * @Route("/vps",name="admin_vps_list")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $vpsOs = $em->getRepository('AppBundle:VpsOs')
            ->findBy(array(), array('platform_id' => 'ASC','sort_order' => 'ASC'));

        return $this->render('vps/admin/vpsOs/list.html.twig',
            [
                'vpsos_list' => $vpsOs,
            ]);
    }

    /**
     * @Route("/vps/new",name="admin_vps_new")
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(VpsOsFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $vpsOs = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($vpsOs);
            $em->flush();

            $this->addFlash('success', 'Operating System added.');

            return $this->redirectToRoute('admin_vps_list');
            ;
        }
        return $this->render('vps/admin/vpsOs/new.html.twig', [
            'vpsForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/vps/{id}/edit",name="admin_vps_edit")
     */
    public function editAction(Request $request, VpsOs $vpsOs)
    {
        $form = $this->createForm(VpsOsFormType::class, $vpsOs);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $vpsOs = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($vpsOs);
            $em->flush();

            $this->addFlash('success', 'Operating System edited.');

            return $this->redirectToRoute('admin_vps_list');
        }
        return $this->render('vps/admin/vpsOs/new.html.twig', [
            'vpsForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/vps/{id}/delete",name="admin_vps_delete")
     */
    public function deleteAction(VpsOs $vpsOs)
    {
        $vpsCpanelConns = $vpsOs->getOscpanelconn();
        $em = $this->getDoctrine()->getManager();
        foreach ($vpsCpanelConns as $vpsCpanelConn) {
            $em->remove($vpsCpanelConn);
        }
        $em->remove($vpsOs);
        $em->flush();
        $this->addFlash('success', 'Operating System deleted.');

        return $this->redirectToRoute('admin_vps_list');
    }
    /**
     * @Route("/vps/single/{id}",name="vps_single")
     */
    public function singleAction(VpsOs $vpsOs)
    {
        return $this->render('vps/admin/vpsOs/single.html.twig',
            [
                'vpsos' => $vpsOs,
            ]);
    }
}
