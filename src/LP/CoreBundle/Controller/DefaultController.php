<?php

namespace LP\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use LP\PlatformBundle\Entity\Advert;
use LP\CoreBundle\Model\Contact;
use LP\CoreBundle\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="lp_core_home")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $lastPromo = $em->getRepository('LPPlatformBundle:Advert')->findLastPromo();

        $listCarAdverts = $em->getRepository('LPPlatformBundle:Advert')->findCarAdverts(2);

        return $this->render('LPCoreBundle:Core:index.html.twig', array(
            'lastPromo' => $lastPromo,
            'listCarAdverts' => $listCarAdverts
        ));
    }

    /**
     * @Route("/about_us", name="lp_core_about_us")
     */
    public function aboutUsAction()
    {
        return $this->render('LPCoreBundle:Core:about_us.html.twig');
    }

    /**
     * @Route("/contact_us", name="lp_core_contact_us")
     */
    public function contactUsAction()
    {
        return $this->render('LPCoreBundle:Core:contact_us.html.twig');
    }


    /**
     * @Route("/contact", name="lp_core_contact")
     */
    public function NewsletterAction(Request $request)
    {

        $contact = new Contact();
        $form = $this->get('form.factory')->create(ContactType::class);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $request->getSession()->getFlashBag()->add('notice', 'Vous êtes maintenant abonné à notre newsletter !');

        }

        return $this->render('@LPCore/Core/contact.html.twig', array(
            'form' => $form->createView(),
        ));

    }

}
