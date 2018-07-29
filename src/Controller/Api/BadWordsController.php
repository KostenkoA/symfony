<?php

namespace App\Controller\Api;

use App\Entity\BadWord;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class BadWordsController extends FOSRestController
{
    /**
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     *
     * @Rest\Post("/bad-words")
     */
    public function postBadWords(Request $request)
    {
        $post = $request->request;

        $model = new BadWord();
        $model->setWord($post->get('bad_word'));
        $model->setScore($post->get('score'));

        $me = $this->getDoctrine()->getManager();
        $me->persist($model);
        $me->flush();

        return $this->view($model, Response::HTTP_CREATED);

    }

    /**
     * @param int $id
     * @return \FOS\RestBundle\View\View
     *
     * @Rest\Get("/bad-words/{id}")
     */
    public function getBadWord(int $id)
    {
        $model = $this->getDoctrine()
            ->getRepository(BadWord::class)
            ->findOneById($id)
        ;

        if (empty($model)){
            throw $this->createNotFoundException(\sprintf('Resource with ID "%d" not found!', $id));
        }

        return $this->view($model, Response::HTTP_OK);
    }

    /**
     * @return \FOS\RestBundle\View\View
     *
     * @Rest\Get("/bad-words")
     */
    public function getBadWords()
    {
        $badWords = $this->getDoctrine()
            ->getRepository(BadWord::class)
            ->findAll()
            ;

        $response = [];

        foreach ($badWords as $badWord){
            $response[] = [
                'data' => [
                    'type' => 'bad-words',
                    'id' => $badWord->getId(),
                    'attributes' => [
                        'bad-word' => $badWord->getWord(),
                        'score' => $badWord->getScore()
                    ],
                    'links' => [
                        'self' => \sprintf('/bad-words/%d', $badWord->getId())
                    ],
                ],
            ];
        }

        return $this->view($response, Response::HTTP_OK);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     *
     * @Rest\Patch("/bad-words/{id}")
     */
    public function patchBadWord(int $id, Request $request)
    {
        /**
         * @var BadWord $model
         */
        $model = $this->getDoctrine()
            ->getRepository(BadWord::class)
            ->findOneById($id)
            ;

        if (empty($model)){
            throw $this->createNotFoundException(\sprintf('Resource with ID "%d" not found!', $id));
        }

        $post = $request->request;
        $model->setWord($post->get('bad_word'));
        $model->setScore($post->get('score'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($model);
        $em->flush();


        return $this->view($model, Response::HTTP_OK);
    }

    /**
     * @param int $id
     * @return \FOS\RestBundle\View\View
     *
     * @Rest\Delete("/bad-words/{id}")
     */
    public function deleteBadWord(int $id)
    {
        $model = $this->getDoctrine()
            ->getRepository(BadWord::class)
            ->findOneById($id)
            ;

        if (empty($model)){
            throw $this->createNotFoundException(\sprintf('Resource with ID "%d" not found!', $id));
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($model);
        $em->flush();

        return $this->view([], Response::HTTP_NO_CONTENT);
    }
}