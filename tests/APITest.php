<?php

use App\User;
use App\Helpers\APITokenGenerator as TokenGenerator;

use Illuminate\Foundation\Testing\DatabaseMigrations;

class APITest extends TestCase {
    use DatabaseMigrations;

    public function testAPI() {
        $tokengenerator = new TokenGenerator();
        $token = $tokengenerator->generate(32);
        User::create([
            'name' => 'testaccount',
            'email' => 'test@test.com',
            'password' => bcrypt('averyweakpassword'),
            'api_token' => $token,
        ]);

        $this->seeInDatabase('users', ['api_token' => $token]);

        $this->post(route('ae.api.post'), [])
        ->seeJson([
            'status' => 'fail',
            'reason' => 'auth'
        ])
        ->assertResponseStatus(401);

        $this->post(route('ae.api.post'), ['api_token' => $token])
        ->seeJson([
            'status' => 'fail',
            'reason' => 'MissingJSON'
        ])
        ->assertResponseStatus(400);

        $json = '[{"is_fluid":false,"size":1000,"is_craftable":false,"display_name":"Foobaritem","fingerprint":{"id":"9132","dmg":"0"}}]';

        $this->post(route('ae.api.post'), ['api_token' => $token, 'aeSystem' => $json])
        ->seeJson([
            'status' => 'success'
        ])
        ->assertResponseOk();

        $this->seeInDatabase('users', ['ae_system' => $json]);
    }
}
