<?php

use App\Helpers\APITokenGenerator as TokenGenerator;

class APITokenGeneratorTest extends TestCase {
  public function testAPITokenGenerator() {
    $generator = new TokenGenerator();
    $this->assertRegExp('/[a-zA-Z0-9]{32}/', $generator->generate());
  }
}
