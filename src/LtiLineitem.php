<?php

namespace Packback\Lti1p3;

class LtiLineitem
{
    private $id;
    private $scoreMaximum;
    private $label;
    private $resourceId;
    private $resourceLinkId;
    private $tag;
    private $startDateTime;
    private $endDateTime;

    public function __construct(array $lineitem = null)
    {
        $this->id = $lineitem['id'] ?? null;
        $this->scoreMaximum = $lineitem['scoreMaximum'] ?? null;
        $this->label = $lineitem['label'] ?? null;
        $this->resourceId = $lineitem['resourceId'] ?? null;
        $this->resourceLinkId = $lineitem['resourceLinkId'] ?? null;
        $this->tag = $lineitem['tag'] ?? null;
        $this->startDateTime = $lineitem['startDateTime'] ?? null;
        $this->endDateTime = $lineitem['endDateTime'] ?? null;
    }

    public function __toString()
    {
        // Additionally, includes the call back to filter out only NULL values
        return json_encode(array_filter([
            'id' => $this->id,
            'scoreMaximum' => $this->scoreMaximum,
            'label' => $this->label,
            'resourceId' => $this->resourceId,
            'resourceLinkId' => $this->resourceLinkId,
            'tag' => $this->tag,
            'startDateTime' => $this->startDateTime,
            'endDateTime' => $this->endDateTime,
        ], '\Packback\Lti1p3\Helpers\Helpers::checkIfNullValue'));
    }

    /**
     * Static function to allow for method chaining without having to assign to a variable first.
     */
    public static function new()
    {
        return new LtiLineitem();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;

        return $this;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function setLabel($value)
    {
        $this->label = $value;

        return $this;
    }

    public function getScoreMaximum()
    {
        return $this->scoreMaximum;
    }

    public function setScoreMaximum($value)
    {
        $this->scoreMaximum = $value;

        return $this;
    }

    public function getResourceId()
    {
        return $this->resourceId;
    }

    public function setResourceId($value)
    {
        $this->resourceId = $value;

        return $this;
    }

    public function getResourceLinkId()
    {
        return $this->resourceLinkId;
    }

    public function setResourceLinkId($value)
    {
        $this->resourceLinkId = $value;

        return $this;
    }

    public function getTag()
    {
        return $this->tag;
    }

    public function setTag($value)
    {
        $this->tag = $value;

        return $this;
    }

    public function getStartDateTime()
    {
        return $this->startDateTime;
    }

    public function setStartDateTime($value)
    {
        $this->startDateTime = $value;

        return $this;
    }

    public function getEndDateTime()
    {
        return $this->endDateTime;
    }

    public function setEndDateTime($value)
    {
        $this->endDateTime = $value;

        return $this;
    }
}
