<?php

require 'vendor/autoload.php';

use function Codewithkyrian\Transformers\Pipelines\pipeline;


/**
 * A ideia é identificar nas conversas o score do sentimento de satisfação do cliente.
 */


$modelName = 'Xenova/distilbert-base-uncased-finetuned-sst-2-english';

$sentiment = pipeline('sentiment-analysis', $modelName);

// Conversa de um ticket (exemplo)
$conversation = [
    // Abertura do ticket
    ['role' => 'customer', 'text' => 'Hi, my order was supposed to arrive yesterday and it is still not here.'],
    ['role' => 'agent', 'text' => 'Hello! I am sorry for the delay. Let me check the shipment status for you.'],

    // Cliente começa a ficar mais irritado
    ['role' => 'customer', 'text' => 'This delay is really frustrating, I needed this product for today.'],
    ['role' => 'agent', 'text' => 'I understand your frustration and I apologize. I can see that the carrier had an operational issue.'],

    // Proposta de solução
    ['role' => 'agent', 'text' => 'We can prioritize your delivery for tomorrow and offer a partial refund for the shipping cost.'],
    ['role' => 'customer', 'text' => 'I am still upset, but I appreciate the partial refund.'],

    // Atualização de status
    ['role' => 'agent', 'text' => 'Your order is now out for delivery and should arrive this afternoon.'],
    ['role' => 'customer', 'text' => 'Okay, thank you for the update.'],

    // Entrega concluída
    ['role' => 'customer', 'text' => 'The package just arrived. The product is fine.'],
    ['role' => 'agent', 'text' => 'Great! I am glad it arrived. Is there anything else I can help you with?'],
    ['role' => 'customer', 'text' => 'No, that is all. Thanks for your help.'],

    // Fechamento
    ['role' => 'agent', 'text' => 'Thank you for your patience and for contacting our support. Have a great day!'],
];


function sentimentScore(array $item): float
{
    $label = strtoupper($item['label'] ?? '');
    $score = (float) ($item['score'] ?? 0);

    return match ($label) {
        'POSITIVE' => +1 * $score,
        'NEGATIVE' => -1 * $score,
        default => 0,
    };
}

function classifyTicket(float $avg): string
{
    if ($avg > 0.2) {
        return 'positivo'; // atendimento bom
    }

    if ($avg < -0.2) {
        return 'negativo'; // atendimento ruim
    }

    return 'neutro'; // misto / não dá pra cravar
}

$total = 0;
$count = 0;

foreach ($conversation as $turn) {
    // foca só no cliente para medir satisfação
    if ($turn['role'] !== 'customer') {
        continue;
    }

    $res = $sentiment($turn['text']);
    $item = is_array($res) && isset($res[0]) ? $res[0] : $res;

    $score = sentimentScore($item);
    $total += $score;
    $count++;

    echo "[{$turn['role']}] {$turn['text']}\n";
    echo " → {$item['label']} ({$item['score']}) | score numérico: {$score}\n\n";
}

$avg = $count > 0 ? $total / $count : 0;
$class = classifyTicket($avg);

echo "Score médio: {$avg}\n";
echo "Classificação final do atendimento: {$class}\n";
