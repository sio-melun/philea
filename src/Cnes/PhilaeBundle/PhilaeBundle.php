<?php
// src/Cnes/PhilaeBundle/PhilaeBundle.php
namespace Cnes\PhilaeBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PhilaeBundle extends Bundle
{
  public function getParent()
  {
    return 'FOSUserBundle';
  }
}





