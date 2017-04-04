<?php
namespace NoticeAppBundle\Controller;
use NoticeAppBundle\Entity\Nnotice;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
/**
 * Notice controller.
 *
 * @Route("notice")
 */
class NoticeController extends Controller
{
    /**
     * Lists all notices entities.
     *
     * @Route("/", name="notice_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $notice = $em->getRepository('NoticeAppBundle:Notice')->findAll();
        $categories = $em->getRepository('NoticeAppBundle:Categories')->findAll();
        return $this->render('@App/notice/index.html.twig', array(
            'notice' => $notice,
            'categories' => $categories
        ));
    }
    /**
     * Creates a new notice entity.
     *
     * @Route("/new", name="notice_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'bez logowania nie dodasz');
        $notice = new Advertisement();
        $form = $this->createForm('NoticeAppBundle\Form\NoticeType', $notice);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($notice);
            $em->flush($notice);
            return $this->redirectToRoute('notice_index');
        }
        return $this->render('@App/notice/new.html.twig', array(
            'notice' => $notice,
            'form' => $form->createView(),
        ));
    }
    /**
     * Finds and displays a notice entity.
     *
     * @Route("/{id}", name="notice_show")
     * @Method("GET")
     */
    public function showAction(Notice $notice)
    {
        return $this->render('@App/notice/show.html.twig', array(
            'notice' => $notice
        ));
    }
    /**
     * @Route("/category/{id}", name="category_show")
     * @Method("GET")
     */
    public function showCategoryAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $notice = $em->getRepository('NoticeAppBundle:Categories')->find($id)->getNotice();
        $categories = $em->getRepository('NoticeAppBundle:Categories')->findAll();
        return $this->render('@App/notice/index.html.twig', array(
            'categories' => $categories,
            'notice' => $notice
        ));
    }
    /**
     * Displays a form to edit an existing notice entity.
     *
     * @Route("/{id}/edit", name="notice_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Notice $notice)
    {
        $deleteForm = $this->createDeleteForm($notice);
        $editForm = $this->createForm('NoticeAppBundle\Form\NoticeType', $notice);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('notice_edit', array('id' => $notice->getId()));
        }
        return $this->render('@App/notice/edit.html.twig', array(
            'notice' => $notice,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a notice entity.
     *
     * @Route("/{id}", name="notice_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Notice $notice)
    {
        $form = $this->createDeleteForm($notice);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($notice);
            $em->flush($notice);
        }
        return $this->redirectToRoute('notice_index');
    }
    /**
     * Creates a form to delete a notice entity.
     *
     * @param Notice $notice The notice entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Notice $notice)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('notice_delete', array('id' => $notice->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}