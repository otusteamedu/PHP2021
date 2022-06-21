<?php

namespace Src;

class App
{
    public function run(): void
    {
        try {
            if (Validator::String($_POST['string'])) {
                Response::success();
            } else {
                Response::fail();
            }
        } catch (\Exception $e) {
            Response::fail();
        }
    }
}