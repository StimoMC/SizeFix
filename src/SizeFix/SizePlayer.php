<?php

namespace SizeFix;

use pocketmine\entity\EntitySizeInfo;
use pocketmine\event\player\PlayerCreationEvent;
use pocketmine\player\Player;

class SizePlayer extends Player {

    public function setSwimming(bool $value = true): void
    {
        parent::setSwimming($value); // TODO: Change the autogenerated stub
    }

    private function recalculateSize() : void{
        $size = $this->getInitialSizeInfo();
        if($this->isSwimming() || $this->isGliding()){
            $width = $size->getWidth();
            //we don't actually know an appropriate eye height for a swimming mob, but 2/3 should be good enough.
            $this->setSize((new EntitySizeInfo($width, $width, $width * 2 / 3))->scale($this->getScale()));
        }else{
            $width = $size->getWidth();
            //we don't actually know an appropriate eye height for a swimming mob, but 2/3 should be good enough.
            $this->setSize((new EntitySizeInfo($width, $width, $width))->scale($this->getScale()));
        }
    }
}