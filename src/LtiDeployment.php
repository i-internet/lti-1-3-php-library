<?php

namespace Packback\Lti1p3;

class LtiDeployment
{
    private $deploymentId;

    public static function new()
    {
        return new LtiDeployment();
    }

    public function getDeploymentId()
    {
        return $this->deploymentId;
    }

    public function setDeploymentId($deploymentId)
    {
        $this->deploymentId = $deploymentId;

        return $this;
    }
}
