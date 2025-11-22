# PHP Sentiment Analysis Demo com TransformersPHP e Docker

Mini projeto de estudo para testar **modelos de PNL (Processamento de Linguagem Natural)** em PHP, usando a biblioteca [TransformersPHP](https://github.com/codewithkyrian/transformers-php).

Ele demonstra dois casos de uso:

1. **Análise de sentimento** de mensagens de atendimento  
   → modelo `Xenova/distilbert-base-uncased-finetuned-sst-2-english`
2. **Resumo de texto (summarization)**  
   → modelo `Xenova/distilbart-cnn-6-6`

A ideia principal é ler textos (ex.: mensagens de clientes, artigos) e aplicar modelos de IA localmente, dentro de um container PHP.


---

## Tecnologias usadas

- **PHP 8.3 (CLI)**  
- **TransformersPHP** (`codewithkyrian/transformers`)
- **Docker** (imagem `php:8.3-cli`)
- **ONNX Runtime via FFI** (usado internamente pela lib)
- **Opcional**: JIT habilitado para melhor desempenho em cenários mais pesados

---

## Estrutura do projeto

```text
.
├─ Dockerfile
├─ composer.json
├─ composer.lock
├─ vendor/               # gerado pelo Composer (ignorado no git)
├─ test.php              # exemplo de análise de sentimento
├─ test-ticket.php       # exemplo mais real de conversa de ticket (sentimento médio)
├─ benchmark.php         # script para testar desempenho
└─ test-summarizer.php   # exemplo de sumarização de texto
