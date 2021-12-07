<?php

namespace Packback\Lti1p3\MessageValidators;

use Packback\Lti1p3\Interfaces\IMessageValidator;
use Packback\Lti1p3\LtiConstants;
use Packback\Lti1p3\LtiException;

class DeepLinkMessageValidator implements IMessageValidator
{
    public function canValidate(array $jwtBody)
    {
        return $jwtBody[LtiConstants::MESSAGE_TYPE] === 'LtiDeepLinkingRequest';
    }

    public function validate(array $jwtBody)
    {
        if (empty($jwtBody['sub'])) {
            throw new LtiException('Must have a user (sub)');
        }
        if ($jwtBody[LtiConstants::VERSION] !== LtiConstants::V1_3) {
            throw new LtiException('Incorrect version, expected 1.3.0');
        }
        if (!isset($jwtBody[LtiConstants::ROLES])) {
            throw new LtiException('Missing Roles Claim');
        }
        if (empty($jwtBody[LtiConstants::DL_DEEP_LINK_SETTINGS])) {
            throw new LtiException('Missing Deep Linking Settings');
        }
        $deepLinkSettings = $jwtBody[LtiConstants::DL_DEEP_LINK_SETTINGS];
        if (empty($deepLinkSettings['deep_link_return_url'])) {
            throw new LtiException('Missing Deep Linking Return URL');
        }
        if (empty($deepLinkSettings['accept_types']) || !in_array('ltiResourceLink', $deepLinkSettings['accept_types'])) {
            throw new LtiException('Must support resource link placement types');
        }
        if (empty($deepLinkSettings['accept_presentation_document_targets'])) {
            throw new LtiException('Must support a presentation type');
        }

        return true;
    }
}
