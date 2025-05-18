<?php

namespace Hegentopf\Assert\assertions;

use Hegentopf\Assert\AssertException;

interface AssertionInterface {
    /**
     * @throws AssertException
     */
    public function assert();
}