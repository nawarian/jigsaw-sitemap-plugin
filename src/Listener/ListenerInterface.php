<?php

namespace Nawarian\Listener;

use TightenCo\Jigsaw\Jigsaw;

interface ListenerInterface
{
    public function handle(Jigsaw $app): void;
}
