<?php
namespace NoticeAppBundle\Controller;
use NoticeAppBundle\Entity\Categories;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
/**
 * Category controller.
 *
 * @Route("categories")
 */
class CategoriesController extends Controller
{
    /**
     * Lists all category entities.
     *
     * @Route("/", name="categories_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('NoticeAppBundle:Categories')->findAll();
        return $this->render('@App/categories/index.html.twig', array(
            'categories' => $categories,
        ));
    }
        /**
         * Creates a new category entity.
         *
         * @Route("/new", name="categories_new")
         * @Method({"GET", "POST"})
         */
        public function newAction(Request $request)
        {
            $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Access denied!');
            $category = new Categories();
            $form = $this->createForm('NoticeAppBundle\Form\CategoriesType', $category);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($category);
                $em->flush($category);
                return $this->redirectToRoute('admin_page');
            }
            return $this->render('@App/categories/new.html.twig', array(
                'category' => $category,
                'form' => $form->createView(),
            ));
        }
    /**
     * Finds and displays a category entity.
     *
     * @Route("/{id}", name="categories_show")
     * @Method("GET")
     */
    public function showAction(Categories $category)
    {
        $deleteForm = $this->createDeleteForm($category);
        return $this->render('@App/categories/show.html.twig', array(
            'category' => $category,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing category entity.
     *
     * @Route("/{id}/edit", name="categories_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Categories $category)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Access denied!');
        $deleteForm = $this->createDeleteForm($category);
        $editForm = $this->createForm('NNoticeAppBundle\Form\CategoriesType', $category);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('categories_edit', array('id' => $category->getId()));
        }
        return $this->render('@App/categories/edit.html.twig', array(
            'category' => $category,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a category entity.
     *
     * @Route("/{id}", name="categories_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Categories $category)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Access denied!');
        $form = $this->createDeleteForm($category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($category);
            $em->flush($category);
        }
        return $this->redirectToRoute('admin_page');
    }
    /**
     * Creates a form to delete a category entity.
     *
     * @param Categories $category The category entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Categories $category)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('categories_delete', array('id' => $category->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}