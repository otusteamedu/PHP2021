<?php


namespace App\StringTester\Controllers;

use App\StringTester\Services\StringTester;
use AppCore\Controllers\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

class StringTesterController extends ControllerBase
{
    public function testAction()
    {
        $request = $this->request;
        if ($request->isMethod("POST")) {
            if (!empty($input = $request->request->get('string'))) {
                $result = StringTester::testString($input);
                if (!$result) {
                    $response = new Response(null, Response::HTTP_BAD_REQUEST, ['Custom-Header' => 'String is not valid']);
                    return $response;
                }
                return $this->render('tpl/result.html', [
                    'title' => 'Test String Result',
                    'test_new_string_text' => 'test another string',
                    'result' => "Valid"
                ]);
            }
        }
        return $this->render('tpl/form.html', ['title' => 'testString', 'SUBMIT_NAME' => 'Test']);
    }

}