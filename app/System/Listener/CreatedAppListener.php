<?php

declare(strict_types=1);

namespace App\System\Listener;
use Hyperf\Database\Model\Events\Event;
use Hyperf\Database\Model\Events\Saved;
use Hyperf\Event\Annotation\Listener;
use Hyperf\Event\Contract\ListenerInterface;

#[Listener]
class CreatedAppListener implements ListenerInterface
{
    public function listen(): array
    {
        return [
            Saved::class,
        ];
    }

    public function process(object $event): void
    {
        print_r("CreatedAppListener==============>");
        print_r($event);
        if ($event instanceof Event) {
            $model = $event->getModel();

        }

    }
}
