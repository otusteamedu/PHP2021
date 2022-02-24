<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 21.02.2022
 * Time: 16:05
 */

namespace app\infrastructure;

use app\infrastructure\commands\EventCommand;
use Exception;

/**
 * Приложение
 *
 * Class App
 * @package ${NAMESPACE}
 */
class App
{
    /**
     * @param array $args
     * @return void
     * @throws Exception
     */
    public function run(array $args)
    {
        list(, $action) = $args;
        $command = new EventCommand();

        switch ($action) {
            case 'create':
                list(, , $name, $priority, $params) = $args;
                $command->create($name, $priority, $params);

                break;
            case 'clear':
                $command->clear();

                break;
            case 'trigger':
                list(, , $params) = $args;
                $command->trigger($params);

                break;
            default:
                throw new Exception('Unknown action');
        }
    }
}
