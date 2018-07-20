<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{
    /**
     * @Route("/product", name="product")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Product();
        $product->setName('Meizu');
        $product->setPrice(2500);
        $product->setTypeId(56);
        $product->setComment('Nice choice!');
        $product->setDescription('M6 3/32gb');

        $entityManager->persist($product);

        $entityManager->flush();

        return new Response('Saved new product with id'.$product->getId());
        
    }

    /**
     * @param $id
     * @Route ("/product/{id}", name="product_show")
     * @return Response
     */

    public function show($id)
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);

        if (!$product){
            throw $this->createNotFoundException(
                'No product found for id'.$id
            );
        }

        return new Response('Check out this great product - '.$product->getName());
    }

    /**
     *
     * @Route ("/product/edit/{id}")
     */
    public function update($id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product){
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $product->setName('New product name!');
        $entityManager->flush();

        return $this->redirectToRoute('product_show', [
            'id'=>$product->getId()
        ]);
    }

    /**
     * @return Response
     * @Route ("/showAll")
     * @var ProductRepository $repository
     */
    public function showAll()
    {/*
        $minPrice = 1000;


        $repository = $manager->getRepository(Product::class);
        $products = $repository->findAllGreaterThanPrice($minPrice);
        /*
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAll();
        */

        $manager = $this->getDoctrine()->getManager();
        $model = $manager->getRepository(Product::class)->findAll();
        dump($model);die;
        return  $this->render('product/dbProduct.html.twig', [
            'products' => $model
        ]);
    }
}
