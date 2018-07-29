<?php

namespace App\Controller\Web;

use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Michelf\MarkdownInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;

/**
 * @author Kostenko Anton <kostenko.antony@gmail.com>
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/homepage", name="homepage")
     */
    public function homepage()
    {
        return $this->render('article/homepage.html.twig');
    }

    /**
     * @Route("/news/{slug}")
     */
    public function show($slug, MarkdownInterface $markdown, AdapterInterface $cache)
    {
        $comments = [
            'I ate normal rock once. It did NOT taste like bacon!',
            'Woohoo! I\'m going on an all - asteroid diet!',
            'I like bacon too! Buy some from my site! bakinsomebacon.com',
        ];

        $articleContent = <<<EOF
Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,
lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit
labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow
turkey shank eu pork belly meatball non cupim.

Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur
laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,
capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing
picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt
occaecat lorem meatball prosciutto quis strip steak.

Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak
mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon
strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur
cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck
fugiat.
EOF;

        //$articleContent = $markdown->transform($articleContent);
       /*
        dump($cache);
        die;
*/
        $item = $cache ->getItem('markdown_'.md5($articleContent));

        if (!$item->isHit()){
            $item->set($markdown->transform($articleContent));
            $cache->save($item);
        }

        $articleContent = $item->get();



        return $this->render('article/show.html.twig',
            ['title' => \ucwords(\str_replace('-', ' ', $slug)),
                'slug' => $slug,
                'comments' => $comments,
                'articleContent' => $articleContent,
            ]);

    }

    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
     */
    public function toggleArticleHeart($slug, LoggerInterface $logger)
    {
        $logger->info('Article is being hearted');

        return $this->json(['hearts' => \rand(5, 100)]);
    }
}