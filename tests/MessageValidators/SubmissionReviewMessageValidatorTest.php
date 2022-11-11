<?php

namespace Tests\MessageValidators;

use Packback\Lti1p3\MessageValidators\SubmissionReviewMessageValidator;
use Packback\Lti1p3\LtiConstants;
use Tests\TestCase;

class SubmissionReviewMessageValidatorTest extends TestCase
{
    public function testItCanValidate()
    {
        $jwtBody = [
            LtiConstants::MESSAGE_TYPE => LtiConstants::MESSAGE_TYPE_SUBMISSIONREVIEW
        ];
        
        $this->assertTrue(SubmissionReviewMessageValidator::canValidate($jwtBody));
    }

    public function testItCannotValidate()
    {
        $jwtBody = [
            LtiConstants::MESSAGE_TYPE => 'not a submission review'
        ];
        
        $this->assertFalse(SubmissionReviewMessageValidator::canValidate($jwtBody));
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
            LtiConstants::FOR_USER => 'user',
        ];
        
        $this->assertTrue(SubmissionReviewMessageValidator::validate($jwtBody));
    }
}
