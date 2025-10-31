<?php


namespace App\Controller;

use Symfony\AI\Platform\Bridge\OpenAI\Embeddings;
use Symfony\AI\Platform\Bridge\OpenAI\Gpt;
use Symfony\AI\Platform\Bridge\OpenAI\PlatformFactory;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\TestFormType;

class TestController extends AbstractController
{
    #[Route('/test', name: 'test')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(TestFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $question =$form->get('question')->getData();
            dd($question);
        }
        // on rend la vue Twig et on lui passe une variable
        return $this->render('test.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}