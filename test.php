<?php

require 'vendor/autoload.php';

use function Codewithkyrian\Transformers\Pipelines\pipeline;


$summarizer = pipeline('summarization', 'Xenova/distilbart-cnn-6-6');


$article = <<<TEXT
The sun resides some 26,000 light-years from the Milky Way's center, in a tendril of our home galaxy known as the Orion Arm. Every 230 million years, the sun—and the solar system it carries with it—makes one orbit around the Milky Way's center. Though we can't feel it, the sun traces its orbit at an average velocity of 450,000 miles an hour.

The sun formed more than 4.5 billion years ago, when a cloud of dust and gas called a nebula collapsed under its own gravity. As it did, the cloud spun and flattened into a disk, with our sun forming at its center. The disk's outskirts later accreted into our solar system, including Earth and the other planets. Scientists have even managed to see these planet-birthing disks around our sun's distant young cousins.

Our home star is a yellow dwarf, a medium-size variety that's fairly common in our galaxy. The label “yellow” is misleading, though, since our sun burns a bright white. On Earth, the sun can take on warmer hues, especially at sunrise or sunset, because our planet's atmosphere scatters blue and green light the most.

From our perspective, “dwarf” might not be the best word for our sun, either. At about 864,000 miles (1.4 million kilometers) wide, the sun is 109 times wider than Earth, and it accounts for more than 99.8 percent of the solar system's total mass. If it was a hollow ball, more than a million Earths could fit inside it. But the sun isn't hollow: It's filled with scorching gases and soups of electrically charged particles called plasma. The sun's surface temperature is about 10,000 degrees Fahrenheit (5,500 degrees Celsius), and it's 27 million degrees Fahrenheit (15.5 million Celsius) at the core.

Deep in the sun's core, nuclear fusion converts hydrogen to helium, which generates energy. Particles of light called photons carry this energy through a spherical shell called the radiative zone to the top layer of the solar interior, the convection zone. There, hot plasmas rise and fall like the ooze in a lava lamp, which transfers energy to the sun's surface, called the photosphere.

It can take 170,000 years for a photon to complete its journey out of the sun, but once it exits, it zips through space at more than 186,000 miles a second. Solar photons reach Earth about eight minutes after they're freed from the sun's interior, crossing an average of 93 million miles to get here—a distance defined as one astronomical unit (AU).
TEXT;

$summary = $summarizer($article, maxNewTokens: 512, temperature: 0.7);

print_r($summary);




