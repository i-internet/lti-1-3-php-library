<?php

namespace Tests\MessageValidators;

use Packback\Lti1p3\MessageValidators\DeepLinkMessageValidator;
use Packback\Lti1p3\LtiConstants;
use Tests\TestCase;

class DeepLinkMessageValidatorTest extends TestCase
{
    public function testItCanValidate()
    {
        $jwtBody = [
            LtiConstants::MESSAGE_TYPE => LtiConstants::MESSAGE_TYPE_DEEPLINK
        ];
        
        $this->assertTrue(DeepLinkMessageValidator::canValidate($jwtBody));
    }

    public function testItCannotValidate()
    {
        $jwtBody = [
            LtiConstants::MESSAGE_TYPE => 'not a deep link'
        ];
        
        $this->assertFalse(DeepLinkMessageValidator::canValidate($jwtBody));
    }

    public function testJwtBodyIsValid()
    {
        $jwtBody = [
            'sub' => 'subscriber',
            LtiConstants::VERSION => LtiConstants::V1_3,
            LtiConstants::ROLES => [],
            LtiConstants::DL_DEEP_LINK_SETTINGS => [
                'deep_link_return_url' => 'https://example.com',
                'accept_types' => [ 'ltiResourceLink' ],
                'accept_presentation_document_targets' => [ 'iframe' ],
            ],
        ];
        
        $this->assertTrue(DeepLinkMessageValidator::validate($jwtBody));
    }
}
