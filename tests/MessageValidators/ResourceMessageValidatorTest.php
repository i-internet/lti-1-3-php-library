<?php

namespace Tests\MessageValidators;

use Packback\Lti1p3\MessageValidators\ResourceMessageValidator;
use Packback\Lti1p3\LtiConstants;
use Tests\TestCase;

class ResourceMessageValidatorTest extends TestCase
{
    private static function validJwtBody()
    {
        return [
            'sub' => 'subscriber',
            LtiConstants::MESSAGE_TYPE => ResourceMessageValidator::getMessageType(),
            LtiConstants::VERSION => LtiConstants::V1_3,
            LtiConstants::ROLES => [],
            LtiConstants::RESOURCE_LINK => [
                'id' => 'unique-id',
            ],
        ];
    }

    public function testItCanValidate()
    {
        $this->assertTrue(ResourceMessageValidator::canValidate(static::validJwtBody()));
    }

    public function testItCannotValidate()
    {
        $jwtBody = static::validJwtBody();
        $jwtBody[LtiConstants::MESSAGE_TYPE] = 'some other type';

        $this->assertFalse(ResourceMessageValidator::canValidate($jwtBody));
    }

    public function testJwtBodyIsValid()
    {
        $this->assertTrue(ResourceMessageValidator::validate(static::validJwtBody()));
    }
}
