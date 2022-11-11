<?php

namespace Packback\Lti1p3\Interfaces;

interface IMessageValidator
{
    public static function validate(array $jwtBody): bool;

    public static function canValidate(array $jwtBody): bool;
}
