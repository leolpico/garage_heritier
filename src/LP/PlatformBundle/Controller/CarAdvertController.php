<?php
/**
 * Created by PhpStorm.
 * User: Leo
 * Date: 21/11/2016
 * Time: 18:02
 */
namespace LP\PlatformBundle\Controller;

use LP\PlatformBundle\Entity\Car;
use LP\PlatformBundle\Form\CarType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class CarAdvertController extends Controller
{

    /**
     * @Route("/", name="lp_platform_index")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $listCarAdverts = $em->getRepository('LPPlatformBundle:Advert')->findCarAdverts();

        return $this->render('LPPlatformBundle:carAdvert:index.html.twig', array(
            'listCarAdverts' => $listCarAdverts
            ));
    }

    /**
     * @Route("/view/{id}", name="lp_platform_view", requirements={"id": "\d+"})
     */
    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $carAdvert = $em->getRepository('LPPlatformBundle:Advert')->find($id);

        if (null === $carAdvert) {
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }


        return $this->render('LPPlatformBundle:CarAdvert:view.html.twig',array(
            'id' => $id,
            'carAdvert' => $carAdvert,
            ));
    }

    /**
     * @Route("/add", name="lp_platform_add")
     */
    public function addAction(Request $request)
    {
        $car = new Car();
        $form = $this->get('form.factory')->create(carType::class, $car);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            // On crée l'évènement avec ses 2 arguments

            $em = $this->getDoctrine()->getManager();
            $em->persist($car);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

            return $this->redirectToRoute('lp_platform_view', array('id' => $car->getId()));
        }

        return $this->render('LPPlatformBundle:car:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

//
//    /**
//     * @Security("has_role('ROLE_ADMIN')")
//     * @Route("/edit/{id}", name="lp_platform_edit", requirements={"id": "\d+"})
//     */
//    public function editAction()
//    {
//
//        return $this->render('LPPlatformBundle:car:edit.html.twig'
//        );
//    }
//
//    /**
//     * @Security("has_role('ROLE_ADMIN')")
//     * @Route("/delete/{id}", name="lp_platform_delete", requirements={"id": "\d+"})
//     */
//    public function deleteAction()
//    {
//        return $this->render('@LPPlatform/car/delete.html.twig'
//        );
//    }
    }