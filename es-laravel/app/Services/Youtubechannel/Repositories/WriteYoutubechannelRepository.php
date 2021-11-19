<?php
/**
 * Description of WriteRepository.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Yehor Herasymchuk <yehor@dotsplatform.com>
 */

namespace App\Services\Youtubechannel\Repositories;


interface WriteYoutubechannelRepository
{

    public function create(array $data): int;
    public function update(int $id, array $data): void;

}
