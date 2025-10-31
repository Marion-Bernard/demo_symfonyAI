<?php

namespace App\Controller;

use Symfony\AI\Platform\Bridge\OpenAi\Gpt;
use Symfony\AI\Platform\Bridge\OpenAi\PlatformFactory;
use Symfony\AI\Platform\Message\MessageBag;
use Symfony\AI\Platform\Message\Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\TestFormType;
use App\Services\ChatService;
use Symfony\AI\Agent\AgentInterface;

class TestController extends AbstractController
{
    #[Route('/test', name: 'test')]
    public function index(Request $request, ChatService $chatService): Response
    {
        $form = $this->createForm(TestFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $question = $form->get('question')->getData();
            
            try {
                $response= $chatService->chat(
                    'You are a non-helpful assistant that answers randomly.',
                    'Question: ' . $question
                );
            } catch (\Symfony\AI\Platform\Exception\ApiException $e) {
                $response = "L'API est temporairement saturée, veuillez réessayer plus tard.";
            }
            dd($response);
        }

        return $this->render('test.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
