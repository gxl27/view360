<?php
namespace App\Service\GlobalsettingsService;

use App\Entity\Menulist;
use App\Entity\Globalsettings;
use Doctrine\Persistence\ManagerRegistry;


class GlobalsettingsService
{
    private $gs;

    public function __construct(ManagerRegistry $managerRegistry) {

        // get active global settings from database
        $this->gs = $managerRegistry->getRepository(Globalsettings::class)->findLatest();
    
    }

    public function getGlobalsettings(){

        if(!$this->gs){

            return false;

        }

        return $this->gs;

    }

    public function closeWebsite(){

        if($this->gs->isCloseWebsite()){

            return true;
        }

        return false;
    }

    public function closeRegister(){

        if($this->gs->isCloseRegister()){
            
            return true;
        }

        return false;
    }

}