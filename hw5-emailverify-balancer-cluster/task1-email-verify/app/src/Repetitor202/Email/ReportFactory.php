<?php


namespace Repetitor202\Email;


class ReportFactory
{
    private array $validators = [];

    public final function validateList(array $emails): void
    {
        foreach ($emails as $email) {
            $emailReport = $email;

            foreach($this->validators as $validator){
                if($validator instanceof IValidator){
                    $emailReport .= ' ' . $validator->doReport($email) . ' ';
                }
            }

            echo $emailReport . PHP_EOL;
        }
    }

    public function setValidators(array $validators): void
    {
        foreach ($validators as $validator) {
            $class = __NAMESPACE__ . '\\' . ucfirst($validator) . 'Validator';
            if (class_exists($class)) {
                array_push($this->validators, new $class());
            }
        }
    }
}