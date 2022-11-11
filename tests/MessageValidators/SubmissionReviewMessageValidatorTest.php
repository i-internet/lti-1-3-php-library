<?php

namespace Tests\MessageValidators;

use Packback\Lti1p3\MessageValidators\SubmissionReviewMessageValidator;
use Packback\Lti1p3\LtiConstants;
use Tests\TestCase;

class SubmissionReviewMessageValidatorTest extends TestCase
{
    private static function validJwtBody()
    {
        return [
            'sub' => 'subscriber',
            LtiConstants::MESSAGE_TYPE => SubmissionReviewMessageValidator::getMessageType(),
            LtiConstants::VERSION => LtiConstants::V1_3,
            LtiConstants::ROLES => [],
            LtiConstants::RESOURCE_LINK => [
                'id' => 'unique-id',
            ],
            LtiConstants::FOR_USER => 'user',
        ];
    }

    public function testItCanValidate()
    {
        $this->assertTrue(SubmissionReviewMessageValidator::canValidate(static::validJwtBody()));
    }

    public function testItCannotValidate()
    {
        $jwtBody = static::validJwtBody();
        $jwtBody[LtiConstants::MESSAGE_TYPE] = 'some other type';

        $this->assertFalse(SubmissionReviewMessageValidator::canValidate($jwtBody));
    }

    public function testJwtBodyIsValid()
    {
        $this->assertTrue(SubmissionReviewMessageValidator::validate(static::validJwtBody()));
    }
}
