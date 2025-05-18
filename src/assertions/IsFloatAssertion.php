<?php
namespace Hegentopf\Assert\assertions;

class IsFloatAssertion extends AbstractAssertion {
    protected function check() {

        $this->assert->isNumeric();

    }
}