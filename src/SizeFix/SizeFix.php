<?php

namespace SizeFix;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerCreationEvent;
use pocketmine\plugin\PluginBase;

class SizeFix extends PluginBase implements Listener {

    public function onEnable(): void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onCreation(PlayerCreationEvent $event){
        $event->setPlayerClass(SizePlayer::class);
    }
}