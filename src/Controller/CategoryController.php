<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class CategoryController extends Controller
{
    /**
     * @Route("/category", name="category")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Category::class);
        $roots = $repo->getRootNodes();
        $root = reset($roots);

        $qb = $repo->createQueryBuilder('cat');
        $qb
            ->select('cat')
            ->where('cat.parent =:parent')
            ->setParameter('parent', $root);


        $categories = $qb->getQuery()->execute();

        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/category/{id}", name="category_show")
     */
    public function showAction($id)
    {

        $repo = $this->getDoctrine()->getRepository(Category::class);
        $qb = $repo->createQueryBuilder('cat');
        $qb
            ->leftJoin('cat.subcategories', 'subcat')
            ->leftJoin('cat.products' ,'p')
            ->select('cat, subcat, p')
            ->where('cat.id = :id')
            ->setParameter('id', $id);
        $category= $qb->getQuery()->getOneOrNullResult();

        if (!$category) {
            throw $this->createNotFoundException('Category with id #'. $id. 'not found');

        }


        return $this->render('category/show.html.twig', [
            'category' => $category,
        ]);
    }
    public function menu(EntityManagerInterface $em)
    {
        $repo = $em->getRepository(Category::class);
        $tree = $repo->childrenHierarchy();

    return  $this->render('category/menu.html.twig',[
            'tree' => $tree
        ]);
    }

}
