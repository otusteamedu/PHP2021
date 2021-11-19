<?php
/**
 * Description of ArticleRepository.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Yehor Herasymchuk <yehor@dotsplatform.com>
 */

namespace App\Services\Youtubechannel\Repositories;


use Illuminate\Support\Collection;

interface SearchYoutubechannelRepository
{

    public function search(string $q): Collection;

}
