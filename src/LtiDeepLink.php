<?php

namespace Packback\Lti1p3;

use Firebase\JWT\JWT;
use Packback\Lti1p3\Interfaces\ILtiRegistration;

class LtiDeepLink
{
    private $registration;
    private $deploymentId;
    private $deepLinkSettings;

    public function __construct(ILtiRegistration $registration, string $deploymentId, array $deepLinkSettings)
    {
        $this->registration = $registration;
        $this->deploymentId = $deploymentId;
        $this->deepLinkSettings = $deepLinkSettings;
    }

    public function getResponseJwt($resources)
    {
        $messageJwt = [
            'iss' => $this->registration->getClientId(),
            'aud' => [$this->registration->getIssuer()],
            'exp' => time() + 600,
            'iat' => time(),
            'nonce' => 'nonce'.hash('sha256', random_bytes(64)),
            LtiConstants::deploymentId => $this->deploymentId,
            LtiConstants::MESSAGE_TYPE => 'LtiDeepLinkingResponse',
            LtiConstants::VERSION => LtiConstants::V1_3,
            LtiConstants::DL_CONTENT_ITEMS => array_map(function ($resource) { return $resource->toArray(); }, $resources),
            LtiConstants::DL_DATA => $this->deepLinkSettings['data'] ?? [],
        ];

        return JWT::encode($messageJwt, $this->registration->getToolPrivateKey(), 'RS256', $this->registration->getKid());
    }

    public function outputResponseForm($resources)
    {
        $jwt = $this->getResponseJwt($resources);
        /*
         * @todo Fix this
         */ ?>
        <form id="auto_submit" action="<?php echo $this->deepLinkSettings['deep_link_return_url']; ?>" method="POST">
            <input type="hidden" name="JWT" value="<?php echo $jwt; ?>" />
            <input type="submit" name="Go" />
        </form>
        <script>
            document.getElementById('auto_submit').submit();
        </script>
        <?php
    }
}
