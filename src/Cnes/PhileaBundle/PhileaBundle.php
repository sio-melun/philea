<?php
// src/Cnes/PhileaBundle/PhileaBundle.php
namespace Cnes\PhileaBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PhileaBundle extends Bundle
{
  public function getParent()
  {
    return 'FOSUserBundle';
  }
}





