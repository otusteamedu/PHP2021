<?php

namespace App\Http\Controllers;

use OpenApi\Annotations\Contact;
use OpenApi\Annotations\Info;
use OpenApi\Annotations\Property;
use OpenApi\Annotations\Schema;
use OpenApi\Annotations\Server;

/**
 *
 * @Info(
 *     version="1.0.0",
 *     title="API",
 *     @Contact(
 *         email="profox@profox.pro",
 *         name="profox"
 *     )
 * )
 *
 * @Server(
 *     url="http://localhost"
 * )
 *
 * @Schema(
 *     schema="ApiResponse",
 *     type="object"
 * )
 *
 */

class SwaggerController
{

}
