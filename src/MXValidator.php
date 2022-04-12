<?php

namespace Otus\Domain;

class MXValidator
{
    private array $emailsForVerification = [];

    private array $emailsAfterVerification = [];

    /**
     * @param string|array $emails
     * @return self
     */
    public function addEmails($emails): MXValidator
    {
        is_array($emails)
            ? $this->emailsForVerification = array_merge($this->emailsForVerification, $emails)
            : $this->emailsForVerification[] = $emails;

        return $this;
    }

    /**
     * Return array valid emails
     * @return array
     */
    public function handle(): array
    {
        foreach ($this->emailsForVerification as $email) {

            if (!$this->checkEmail($email)) {
                $this->emailsAfterVerification[$email] = false;
                continue;
            }

            $domain = $this->getDomain($email);

            (!$this->checkDNSRecord($domain) || !$this->checkMXRecord($domain))
                ? $this->emailsAfterVerification[$email] = false
                : $this->emailsAfterVerification[$email] = true;

        }

        return $this->validate();
    }

    /**
     * @param string $email
     * @return bool
     */
    private function checkEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @param string $domain
     * @return bool
     */
    private function checkMXRecord(string $domain): bool
    {
        $hosts = [];
        return getmxrr($domain, $hosts);
    }

    /**
     * @param string $domain
     * @return bool
     */
    private function checkDNSRecord(string $domain): bool
    {
        return checkdnsrr($domain, "NS");
    }


    /**
     * @param string $email
     * @return string
     */
    private function getDomain(string $email): string
    {
        return explode("@", $email)[1];
    }

    /**
     * @return array
     */
    private function getValidateResult(): array
    {
        return $this->emailsAfterVerification;
    }

    /**
     * Return list valid emails
     * @return array
     */
    private function validate(): array
    {
        return array_keys(array_filter($this->emailsAfterVerification, function ($passed, $email) {
            return $passed === true;
        }, ARRAY_FILTER_USE_BOTH));
    }
}