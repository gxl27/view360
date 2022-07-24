<?php

namespace App\Controller;

use App\Service\GlobalsettingsService\GlobalsettingsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Security\Core\Security;
use Doctrine\Persistence\ManagerRegistry;

class BaseController extends AbstractController
{
    protected $paginator;
    protected $gs;
    
    // call the constructor for all controllers that extends BaseController
    public function __construct(PaginatorInterface $paginator, ManagerRegistry $managerRegistry)
    {
        // initialize Globalsettings data as a global service for all controllers
        $this->gs = new GlobalsettingsService($managerRegistry);

        if(!$this->gs->getGlobalsettings()){
            throw new \Exception("", 444);
        }

        // initialize Paginator as a global service
        $this->paginator = $paginator;

        if($this->gs->closeWebsite()){
          
            // if the website it's closed, throw and exception
            throw new \Exception("Website temporally closed", 445);
            
        }
        
    }

}