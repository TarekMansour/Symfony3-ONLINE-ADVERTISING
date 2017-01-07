<?php

namespace booksBundle\Controller;

use booksBundle\Entity\book;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * Book controller.
 *
 */
class bookController extends Controller
{
    /**
     * Lists all book entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $books = $em->getRepository('booksBundle:book')->findAll();

        return $this->render('book/index.html.twig', array(
            'books' => $books,
        ));
    }

    /**
     * Creates a new book entity.
     *
     */
    public function newAction(Request $request)
    {
        $book = new Book();
        $form = $this->createForm('booksBundle\Form\bookType', $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $book->upload();
            $em->persist($book);
            $em->flush($book);

            return $this->redirectToRoute('annonce_books_show', array('id' => $book->getId()));
        }

        return $this->render('book/new.html.twig', array(
            'book' => $book,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a book entity.
     *
     */
    public function showAction(book $book)
    {
        $deleteForm = $this->createDeleteForm($book);

        return $this->render('book/show.html.twig', array(
            'book' => $book,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing book entity.
     *
     */
    public function editAction(Request $request, book $book)
    {
        $deleteForm = $this->createDeleteForm($book);
        $editForm = $this->createForm('booksBundle\Form\bookType', $book);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('annonce_books_edit', array('id' => $book->getId()));
        }

        return $this->render('book/edit.html.twig', array(
            'book' => $book,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a book entity.
     *
     */
    public function deleteAction(Request $request, book $book)
    {
        $form = $this->createDeleteForm($book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($book);
            $em->flush($book);
        }

        return $this->redirectToRoute('annonce_books_index');
    }

    /**
     * Creates a form to delete a book entity.
     *
     * @param book $book The book entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(book $book)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('annonce_books_delete', array('id' => $book->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


    /**
     * Lists dashboard
     *
     */
    public function dashboardAction()
    {
        $repo = $this   ->getDoctrine()
                        ->getManager()
                        ->getRepository('booksBundle:book');

        $qb = $repo->createQueryBuilder('a');
        $qb->select('COUNT(a)');

        $count = $qb->getQuery()->getSingleScalarResult();

        return $this->render('book/dashboard.html.twig', array("nb" =>$count));
    }

    /**
    * @Security("has_role('ROLE_ADMIN')")
    */
   /* public function helloAction($name)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
        throw $this->createAccessDeniedException();
    }

    // the above is a shortcut for this
    $user = $this->get('security.token_storage')->getToken()->getUser();
    } */

}
