<?php

namespace SizeFix;

use pocketmine\entity\EntitySizeInfo;
use pocketmine\entity\Location;
use pocketmine\event\player\PlayerCreationEvent;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\NetworkSession;
use pocketmine\player\Player;
use pocketmine\player\PlayerInfo;
use pocketmine\Server;

class SizePlayer extends Player {

    public function setSwimming(bool $value = true) : void{
        $this->swimming = $value;
        $this->networkPropertiesDirty = true;
        $this->recalculateSize();
    }

    private function recalculateSize() : void{
        $size = $this->getInitialSizeInfo();
        if($this->isSwimming() || $this->isGliding()){
            $width = $size->getWidth();
            //we don't actually know an appropriate eye height for a swimming mob, but 2/3 should be good enough.
            $this->setSize((new EntitySizeInfo($width, $width, $width * 2 / 3))->scale($this->getScale()));
            $this->recalculateBoundingBox();
            return;
        }
        $this->setSize((new EntitySizeInfo(1.8, 0.6, 1.62))->scale($this->getScale()));
        $this->recalculateBoundingBox();
        $this->despawnFromAll();
        $this->spawnToAll();
    }
}