<?php

use App\Helpers\AESystemJSONValidator as AEValidator;

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    public function testAESystemJSONValidator() {
      $invalidMissingValueJSON = '[{"is_fluid":false,"size":1000,"is_craftable":false,"display_name":"Foobaritem","fingerprint":{"id":"9132","dmb":"0"}}]';
      $invalidSyntaxJSON = '[{"is_fluid":false,"size":1000,"is_craftable":false,"display_name":"Foobaritem","fingerprint":{"id":"9132""dmg":"0"}}]';
      $validJSON = '[{"is_fluid":false,"size":1000,"is_craftable":false,"display_name":"Foobaritem","fingerprint":{"id":"9132","dmg":"0"}}]';

      $this->assertFalse(AEValidator::validateItemList($invalidMissingValueJSON));
      $this->assertFalse(AEValidator::validateItemList($invalidSyntaxJSON));
      $this->assertTrue(AEValidator::validateItemList($validJSON));
    }

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication() {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }
}
