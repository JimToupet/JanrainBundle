<?php

namespace Evario\JanrainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class JanrainSecurityController extends Controller
{

  /**
   * Janrain check login action
   * @Route("/janrain-check", name="janrain.check", options={"expose"=true})
   */
  public function janrain_checkAction()
  {

  }
}