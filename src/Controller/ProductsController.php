<?php

namespace App\Controller;

use App\Entity\Products;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProductsController extends Controller
{
    /**
     * @Route("/products/list", name="products_list")
     * @Method({"GET"})
     * @return Response
     */
    public function index()
    {
        $products = $this->getDoctrine()->getRepository(products::class)->findAll();
        return $this->render('products/index.html.twig', array('products' => $products));
    }

    /**
     * @Route("/products/new",name="new_products")
     * @Method({"GET","POST"})
     */
    public function new(Request $request)
    {
        $products = new products();
        $form = $this->createFormBuilder($products)
            ->add('code', TextType::class, array('attr' => array('class' => 'form-control', 'maxlength' => 10, 'minlength' => 4, 'onkeypress' => "return ((event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || event.charCode == 8 || (event.charCode >= 48 && event.charCode <= 57));")))
            ->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'minlength' => 4)))
            ->add('description', TextareaType::class, array('attr' => array('class' => 'form-control')))
            ->add('mark', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('category', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('price', TextType::class, array('attr' => array('class' => 'form-control', 'onkeypress' => "return (event.charCode > 47 && event.charCode < 59);")))
            ->add('save', SubmitType::class, array('label' => 'Guardar', 'attr' => array('class' => 'btn btn-primary mt-3')))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $products = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($products);
            $entityManager->flush();
            return $this->redirectToRoute('products_list');
        }
        return $this->render('products/new.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/products/edit/{id}",name="edit_products")
     * @Method({"GET","POST"})
     */
    public function edit(Request $request, $id)
    {
        $products = $this->getDoctrine()->getRepository(products::class)->find($id);
        $form = $this->createFormBuilder($products)
            ->add('code', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('name', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('description', TextareaType::class, array('attr' => array('class' => 'form-control')))
            ->add('mark', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('category', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('price', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array('label' => 'Actualizar', 'attr' => array('class' => 'btn btn-primary mt-3')))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('products_list');
        }
        return $this->render('products/edit.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/products/{id}",name="products_show")
     */
    public function show($id)
    {
        $products = $this->getDoctrine()->getRepository(products::class)->find($id);
        return $this->render('products/show.html.twig', array('products' => $products));
    }

    /**
     * @Route("/products/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id)
    {
        $products = $this->getDoctrine()->getRepository(products::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($products);
        $entityManager->flush();
        $products = $this->getDoctrine()->getRepository(products::class)->findAll();
        return $this->render('products/index.html.twig', array('products' => $products));
    }
}