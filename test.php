<?php

require 'vendor/autoload.php';

use function Codewithkyrian\Transformers\Pipelines\pipeline;


$summarizer = pipeline('summarization', 'Xenova/distilbart-cnn-6-6');


$article = <<<TEXT
Black holes are among the most mysterious cosmic objects, much studied but not fully understood. These objects aren’t really holes. They’re huge concentrations of matter packed into very tiny spaces. A black hole is so dense that gravity just beneath its surface, the event horizon, is strong enough that nothing – not even light – can escape. The event horizon isn’t a surface like Earth’s or even the Sun’s. It’s a boundary that contains all the matter that makes up the black hole.

There is much we don’t know about black holes, like what matter looks like inside their event horizons. However, there is a lot that scientists do know about black holes.
Black holes can be big or small. The smallest black holes are only a few times more massive than our Sun. The biggest black holes, called supermassive black holes, have masses that are millions or even billions of times the mass of our Sun. Scientists think that every large galaxy has a supermassive black hole at its center, including our own Milky Way galaxy.

Black holes form in different ways. The most common way is from the collapse of massive stars.
When a massive star runs out of fuel, it can no longer hold up against the pull of its own gravity. The star’s core collapses, and if the core’s mass is more than about three times the mass of our Sun, it can form a black hole.
Black holes can also form when huge clouds of gas collapse under their own gravity or when very dense star clusters collapse.
TEXT;

$summary = $summarizer($article, maxNewTokens: 300, temperature: 0.7);

print_r($summary);




