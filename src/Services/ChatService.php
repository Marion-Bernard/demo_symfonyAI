<?php 
namespace App\Services;

use Symfony\AI\Agent\AgentInterface;
use Symfony\AI\Platform\Message\Message;
use Symfony\AI\Platform\Message\MessageBag;

final readonly class ChatService
{
    public function __construct(
        private AgentInterface $agent,
    ) {
    }

    public function chat(string $context, string $userMessage): string
    {
        $messages = new MessageBag(
            Message::forSystem($context),
            Message::ofUser($userMessage),
        );

        $result = $this->agent->call($messages);

        return $result->getContent();
    }
}