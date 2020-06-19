<?php
namespace App\Controller;
use App\Entity\Product;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class HomeController extends AbstractController
{
    /**
     * On déclare des routes avec des annotations Route
     *
     * URL: localhost/route
     * URI: /route
     *
     * @Route("/", name="home")
     */
    public function index()
    {
# templates/        home.html.twig
        return $this->render('templates/home.html.twig', [
            'pseudo' => 'John Doe',
            'liste' => [
                'foo',
                'bar',
                'baz',
            ]
        ]);
    }

    /**
     * @Route("/test", name="test")
     */
    public function test(EntityManagerInterface $em)
    {
        $product = new Product();
        $product
            ->setName("jean")
            ->setDescription("joli jean")
            ->setPrice(79.99)
            ->setQuantity(50)
            ;
        dump($product);
        $em->persist($product);
        $em->flush($product);

        dd($product);
    }
}


