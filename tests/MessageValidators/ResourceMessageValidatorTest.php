<?php

namespace Tests\MessageValidators;

use Packback\Lti1p3\MessageValidators\ResourceMessageValidator;
use Packback\Lti1p3\LtiConstants;
use Tests\TestCase;

class ResourceMessageValidatorTest extends TestCase
{
    public function testItCanValidate()
    {
        $jwtBody = [
            LtiConstants::MESSAGE_TYPE => LtiConstants::MESSAGE_TYPE_RESOURCE
        ];
        
        $this->assertTrue(ResourceMessageValidator::canValidate($jwtBody));
    }

    public function testItCannotValidate()
    {
        $jwtBody = [
            LtiConstants::MESSAGE_TYPE => 'not a resource'
        ];
        
        $this->assertFalse(ResourceMessageValidator::canValidate($jwtBody));
    }

    public function testJwtBodyIsValid()
    {
        $jwtBody = [
            'sub' => 'subscriber',
            LtiConstants::VERSION => LtiConstants::V1_3,
            LtiConstants::ROLES => [],
            LtiConstants::RESOURCE_LINK => [
                'id' => 'unique-id',
            ],
        ];
        
        $this->assertTrue(ResourceMessageValidator::validate($jwtBody));
    }
}
