<?php

namespace NoticeAppBundle\Controller;

use NoticeAppBundle\Entity\User;
use NoticeAppBundle\Entity\Advertisement;
use NoticeAppBundle\Entity\Categories;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction()
    {
        return $this->render('NoticeAppBundle::index.html.twig');
        //return $this->render('@App/index.html.twig');
    }

    /**
     * @Route("/admin", name="admin_page")
     * @Method("GET")
     */
    public function adminAction()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Access denied!');
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('NoticeAppBundle:User')->findAll();
        $categories = $em->getRepository('NoticeAppBundle:Categories')->findAll();
        return $this->render('@App/admin/index.html.twig', array(
            'users' => $users,
            'categories' => $categories,
        ));
    }
}