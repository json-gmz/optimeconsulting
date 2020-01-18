<?php

namespace App\Controller;

use App\Entity\Categories;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CategoriesController extends Controller
{
    /**
     * @Route("/categories/list", name="categories_list")
     * @Method({"GET"})
     * @return Response
     */
    public function index()
    {
        $categories = $this->getDoctrine()->getRepository(categories::class)->findAll();
        return $this->render('categories/index.html.twig', array('categories' => $categories));
    }

    /**
     * @Route("/categories/new",name="new_categories")
     * @Method({"GET","POST"})
     */
    public function new(Request $request)
    {
        $categories = new categories();
        $form = $this->createFormBuilder($categories)
            ->add('code', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('name', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('description', TextareaType::class, array('attr' => array('class' => 'form-control')))
            ->add('active', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array('label' => 'Guardar', 'attr' => array('class' => 'btn btn-primary mt-3')))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $categories = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categories);
            $entityManager->flush();
            return $this->redirectToRoute('categories_list');
        }
        return $this->render('categories/new.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/categories/edit/{id}",name="edit_categories")
     * @Method({"GET","POST"})
     */
    public function edit(Request $request, $id)
    {
        $categories = $this->getDoctrine()->getRepository(categories::class)->find($id);
        $form = $this->createFormBuilder($categories)
            ->add('code', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('name', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('description', TextareaType::class, array('attr' => array('class' => 'form-control')))
            ->add('active', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array('label' => 'Actualizar', 'attr' => array('class' => 'btn btn-primary mt-3')))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('categories_list');
        }
        return $this->render('categories/edit.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/categories/{id}",name="categories_show")
     */
    public function show($id)
    {
        $categories = $this->getDoctrine()->getRepository(categories::class)->find($id);
        return $this->render('categories/show.html.twig', array('categories' => $categories));
    }

    /**
     * @Route("/categories/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id)
    {
        $categories = $this->getDoctrine()->getRepository(categories::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($categories);
        $entityManager->flush();
        $categories = $this->getDoctrine()->getRepository(categories::class)->findAll();
        return $this->render('categories/index.html.twig', array('categories' => $categories));
    }
}