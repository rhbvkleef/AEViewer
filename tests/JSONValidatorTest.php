<?php

use App\Helpers\AESystemJSONValidator as AEValidator;

class JSONValidatorTest extends TestCase {

    public function testAESystemJSONValidator() {
        $invalidMissingValueJSON = '[{"is_fluid":false,"size":1000,"is_craftable":false,"display_name":"Foobaritem","fingerprint":{"id":"9132","dmb":"0"}}]';
        $invalidSyntaxJSON = '[{"is_fluid":false,"size":1000,"is_craftable":false,"display_name":"Foobaritem","fingerprint":{"id":"9132""dmg":"0"}}]';
        $validJSON = '[{"is_fluid":false,"size":1000,"is_craftable":false,"display_name":"Foobaritem","fingerprint":{"id":"9132","dmg":"0"}}]';

        $this->assertFalse(AEValidator::validateItemList($invalidMissingValueJSON));
        $this->assertFalse(AEValidator::validateItemList($invalidSyntaxJSON));
        $this->assertTrue(AEValidator::validateItemList($validJSON));
    }
}
