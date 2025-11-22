<?php

require 'vendor/autoload.php';

use function Codewithkyrian\Transformers\Pipelines\pipeline;

$modelName = 'Xenova/distilbert-base-uncased-finetuned-sst-2-english';

// Cria o pipeline uma vez só
$sentiment = pipeline('sentiment-analysis', $modelName);

// Algumas mensagens de exemplo (pode repetir, não tem problema)
$messages = [
    'The delivery took too long, I am very upset.',
    'I am very disappointed, nobody helped me.',
    'Thank you for the quick response, the support was great.',
    'The package arrived damaged, I am really unhappy.',
    'Everything worked perfectly, I am very satisfied.',
];

// Quantas vezes rodar o benchmark
$iterations = 50;

echo "Rodando {$iterations} iterações...\n";

$start = microtime(true);

for ($i = 0; $i < $iterations; $i++) {
    foreach ($messages as $msg) {
        $res = $sentiment($msg);
        $item = is_array($res) && isset($res[0]) ? $res[0] : $res;

        // só pra garantir que o PHP não otimize fora
        if (!isset($item['label'])) {
            throw new RuntimeException('Pipeline retornou resultado inesperado');
        }
    }
}

$end = microtime(true);
$totalTime = $end - $start;
$perIteration = $totalTime / $iterations;

echo "Tempo total: {$totalTime} segundos\n";
echo "Tempo médio por iteração (lote de " . count($messages) . " mensagens): {$perIteration} segundos\n";
