<?php

namespace Tests\MessageValidators;

use Packback\Lti1p3\MessageValidators\DeepLinkMessageValidator;
use Packback\Lti1p3\LtiConstants;
use Tests\TestCase;

class DeepLinkMessageValidatorTest extends TestCase
{
    private static function validJwtBody()
    {
        return [
            'sub' => 'subscriber',
            LtiConstants::MESSAGE_TYPE => DeepLinkMessageValidator::getMessageType(),
            LtiConstants::VERSION => LtiConstants::V1_3,
            LtiConstants::ROLES => [],
            LtiConstants::DL_DEEP_LINK_SETTINGS => [
                'deep_link_return_url' => 'https://example.com',
                'accept_types' => [ 'ltiResourceLink' ],
                'accept_presentation_document_targets' => [ 'iframe' ],
            ],
        ];
    }

    public function testItCanValidate()
    {
        $this->assertTrue(DeepLinkMessageValidator::canValidate(static::validJwtBody()));
    }

    public function testItCannotValidate()
    {
        $jwtBody = static::validJwtBody();
        $jwtBody[LtiConstants::MESSAGE_TYPE] = 'some other type';

        $this->assertFalse(DeepLinkMessageValidator::canValidate($jwtBody));
    }

    public function testJwtBodyIsValid()
    {
        $this->assertTrue(DeepLinkMessageValidator::validate(static::validJwtBody()));
    }
}
