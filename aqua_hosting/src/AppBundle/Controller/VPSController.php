<?php

namespace AppBundle\Controller;

use AppBundle\Entity\VpsCpanelConn;
use AppBundle\Entity\VpsOs;
use AppBundle\Form\VpsHostingForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

//when adding controller dont forget to add  extends Controller dont copy paste use auto complete
class VPSController extends Controller
{

    /**
     * @Route("/vps",name="vps_show")
     * @Method("Get")
     */
    public function showAction()
    {
        $form = $this->createForm(VpsHostingForm::class);

        return $this->render('vps/vps.html.twig', [
            'vpsHostingForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/vps",name="vps_save")
     * @Method("Post")
     */
    public function vpsSaveAction(Request $request)
    {
        $form = $this->createForm(VpsHostingForm::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $vpsHosting = $form->getData();

            //save
            $em = $this->getDoctrine()->getManager();

            $vpsmembers = $em->find('AppBundle:Members', $this->getUser()->getId());
            $vpsHosting->setMembers($vpsmembers);
            $em->persist($vpsHosting);
            $em->flush();
            $this->addFlash('success', 'VPS added.');

            return $this->redirectToRoute('homepage');
        }
        
        return $this->render('vps/vps.html.twig', [
            'vpsHostingForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/vps/ops",name="vps_ops")
     * @Method("Get")
     */
    public function getOperatingSystem()
    {
        $operating_systems = [];
        $em = $this->getDoctrine()->getManager();

        $cache = $this->get('doctrine_cache.providers.host_cache');
        $key = md5('getOperatingSystem');
        if ($cache->contains($key)) {
            $data = $cache->fetch($key);
        } else {
            $vpsos = $em->getRepository('AppBundle:VpsOs')
                ->findBy(array(), array('sort_order' => 'ASC'));

            foreach ($vpsos as $os) {
                $conns = [];
                /** @var VpsCpanelConn $conn */
                foreach ($os->getOscpanelconn() as $conn) {
                    $conns[] = $conn->getVpscpanelId();
                }
                $operating_systems[] =
                    [
                        'id' => $os->getId(),
                        'name' => $os->getName(),
                        'server_id' => $os->getServerId(),
                        'platform_id' => $os->getPlatformId(),
                        'sort_order' => $os->getSortOrder(),
                        'cpanel_conn' => $conns,
                    ];
            }

            $data = [
                'osystems' => $operating_systems,
                'cpanels' => $this->getCPanel(),
                'databases' => $this->getDB(),
                'remote_backups' => $this->getRemoteBackup(),
                'packages' => $this->getPackages(),
            ];
            $cache->save($key, $data);
        }
        return new JsonResponse($data);
    }

    public function getCPanel()
    {
        $cp = [];

        $em = $this->getDoctrine()->getManager();

        $cpanels = $em->getRepository('AppBundle:VpsCpanel')
            ->findBy(array(), array('id' => 'ASC'));

        foreach ($cpanels as $cpanel) {
            $cp[] = [
                'id' => $cpanel->getId(),
                'description'=>$cpanel->getVpsCpanelDesc(),
                'price'=>$cpanel->getVpsCpanelPrice(),
            ];
        }
        return  $cp;
    }

    public function getDB()
    {
        $db = [];
        $em = $this->getDoctrine()->getManager();

        $databases = $em->getRepository('AppBundle:VpsDatabase')
            ->findBy(array(), array('id' => 'ASC'));

        foreach ($databases  as $database) {
            $db[$database->getPlatform()][] = [
                'id' => $database->getId(),
                'description'=>$database->getDesc(),
                'price'=>$database->getPrice()

            ];
        }
        return  $db;
    }

    public function getRemoteBackup()
    {
        $rb = [];
        $em = $this->getDoctrine()->getManager();

        $remote_backups = $em->getRepository('AppBundle:RemoteBackup')
            ->findBy(array(), array('id' => 'ASC'));
        foreach ($remote_backups as $remote_backup) {
            $rb[] = [
                'id'=>$remote_backup->getId(),
                'description'=>$remote_backup->getDescription(),
                'price'=>$remote_backup->getPrice(),
            ];
        }

        return  $rb;
    }

    public function getPackages()
    {
        $pg = [];
        $em = $this->getDoctrine()->getManager();

        $packages = $em->getRepository('AppBundle:VpsPackages')
            ->findBy(array(), array('id' => 'ASC'));

        foreach ($packages  as $package) {
            $pg[$package->getType()] = [
                'description'=>$package->getDesc(),
                'unit'=>$package->getUnit(),
                'price'=>$package->getPrice(),
            ];
        }
        return  $pg;
    }
}
