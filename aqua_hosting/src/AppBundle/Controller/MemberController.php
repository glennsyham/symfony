<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Members;
use AppBundle\Entity\MembersDetail;
use AppBundle\Form\MemberRegisterForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MemberController extends Controller
{
    /**
     * @Route("/register", name="member_register")
     */
    public function registerAction(Request $request)
    {
        $form = $this->createForm(MemberRegisterForm::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Members $member */

            $member = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($member);
            $em->flush();

            $this->addFlash('success', 'Welcome '. $member->getEmail());

            return $this->get('security.authentication.guard_handler')
                ->authenticateUserAndHandleSuccess(
                    $member,
                    $request,
                    $this->get('app.security.login_form_authenticator'),
                    'main'
                );
        }
        return $this->render('member/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
