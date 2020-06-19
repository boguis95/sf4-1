<?php

namespace App\Controller;
use Symfony\Component\Form;
use App\Form\ProductFormType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{


    /**
     * @Route("/product/list", name="product_list")
     */
    public function list(ProductRepository $repository)
    {


        return $this->render('product/list.html.twig', [
            'product_list'=>$repository->findAll()
        ]);
      }
    /**
     * @Route("product/add", name="product_add")
     */
        public function add(Request $request, EntityManagerInterface $em )
        {
            $productForm= $this->createForm(ProductFormType::class);

            $productForm->handleRequest($request);

            if($productForm -> isSubmitted() && $productForm->isValid() )
            {
                $product=$productForm->getData();

                $em->persist($product);
                $em->flush();

                return $this->redirectToRoute('product_list');

            }


            return $this->render('product/add.html.twig', [
                'product_form'=>$productForm->createView()
            ]);


        }
       /**
        * @Route("product/{id}edit", name="product_edit")
        */
        public function edit($id)
        {
            return $this->render('product/edit.html.twig',['id'=>$id]);
        }


}


