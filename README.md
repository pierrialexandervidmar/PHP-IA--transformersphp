# PHP Sentiment Analysis Demo com TransformersPHP e Docker

Mini projeto de estudo para testar **modelos de PNL (Processamento de Linguagem Natural)** em PHP, usando a biblioteca [TransformersPHP](https://github.com/codewithkyrian/transformers-php) e o modelo:

> `Xenova/distilbert-base-uncased-finetuned-sst-2-english`  
> (modelo de análise de sentimento – POSITIVE / NEGATIVE)

A ideia é bem simples:  
ler mensagens de atendimento (ex: tickets de suporte) e calcular se o sentimento geral do cliente foi **positivo**, **negativo** ou **neutro**, podendo ser usado futuramente para indicadores de satisfação.

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
├─ vendor/              # gerado pelo Composer
├─ test.php             # exemplo simples de análise de sentimento
└─ benchmark.php        # script para testar desempenho em várias iterações
