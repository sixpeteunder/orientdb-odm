<?php

/*
 * This file is part of the Orient package.
 *
 * (c) Alessandro Nadalin <alessandro.nadalin@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Index class
 *
 * @package     Orient
 * @subpackage  Query
 * @author      Alessandro Nadalin <alessandro.nadalin@gmail.com>
 */

namespace Orient\Query\Command;

use Orient\Query\Command;

class Index extends Command
{  
  public function __construct($class, $property)
  {
    parent::__construct();
    
    $this->setToken('Class', $class);
    $this->setToken('Property', $property);
  }
}