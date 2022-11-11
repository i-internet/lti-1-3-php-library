<?php

namespace Packback\Lti1p3\Interfaces;

interface IMessageValidator
{
    public static function getMessageType(): string;

    public static function validate(array $jwtBody): bool;

    public static function canValidate(array $jwtBody): bool;
}
