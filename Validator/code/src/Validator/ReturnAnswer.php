<?php

namespace Validator;

interface ReturnAnswer
{
    public function success();

    public function failed(string $error);
}