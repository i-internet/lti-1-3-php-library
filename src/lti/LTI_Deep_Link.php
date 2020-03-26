<?php
namespace IMSGlobal\LTI;

use \Firebase\JWT\JWT;
class LTI_Deep_Link {

    private $registration;
    private $deployment_id;
    private $deep_link_settings;

    public function __construct($registration, $deployment_id, $deep_link_settings) {
        $this->registration = $registration;
        $this->deployment_id = $deployment_id;
        $this->deep_link_settings = $deep_link_settings;
    }

    public function get_response_jwt($resources) {
        $message_jwt = [
            "iss" => $this->registration->get_client_id(),
            "aud" => [$this->registration->get_issuer()],
            "exp" => time() + 600,
            "iat" => time(),
            "nonce" => 'nonce' . hash('sha256', random_bytes(64)),
            LTI_Constants::DEPLOYMENT_ID => $this->deployment_id,
            LTI_Constants::MESSAGE_TYPE => "LtiDeepLinkingResponse",
            LTI_Constants::VERSION => LTI_Constants::V1_3,
            LTI_Constants::DL_CONTENT_ITEMS => array_map(function($resource) { return $resource->to_array(); }, $resources),
            LTI_Constants::DL_DATA => $this->deep_link_settings['data'],
        ];
        return JWT::encode($message_jwt, $this->registration->get_tool_private_key(), 'RS256', $this->registration->get_kid());
    }

    public function output_response_form($resources) {
        $jwt = $this->get_response_jwt($resources);
        ?>
        <form id="auto_submit" action="<?= $this->deep_link_settings['deep_link_return_url']; ?>" method="POST">
            <input type="hidden" name="JWT" value="<?= $jwt ?>" />
            <input type="submit" name="Go" />
        </form>
        <script>
            document.getElementById('auto_submit').submit();
        </script>
        <?php
    }
}
