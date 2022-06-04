<?

namespace Src\Infrastructure;

class AnalyticSystem
{
    private int $param1;
    private int $param2;

    public function __construct($param1, $param2)
    {
        $this->param1 = $param1;
        $this->param2 = $param2;
    }

    /**
     * @return mixed
     */
    private function findEvent()
    {
        $redis = new RedisTasks();

        $keys = $eventsName = $priorities = [];
        $keys[] = "param:1:{$this->param1}:param:2:{$this->param2}";
        $keys[] = "param:1:{$this->param1}";
        $keys[] = "param:2:{$this->param2}";

        echo "param1={$this->param1},param2={$this->param2}". PHP_EOL;

        foreach ($keys as $key => $value) {
            foreach ($redis->revRangeByScore($value) as $rKey => $rValue) {
                echo "{$rValue} - приоритет: {$rKey}".PHP_EOL;
                $eventsName[] = $rValue;
                $priorities[] = $rKey;
            }
        }

        if (empty($priorities)) echo 'Нет соответсвий'. PHP_EOL;
        arsort($priorities);

        return $eventsName[key($priorities)];
    }

    /**
     * @return void
     */
    private function resultRequest(): void
    {
        $result = $this->findEvent();
        if ($result) {
            echo "Высший приоритет: {$result}".PHP_EOL;
        } else {
            echo "Ничего нет".PHP_EOL;
        }
    }

    /**
     * @return void
     */
    public function run(): void
    {
        $jsonToRedis = new ParseJsonToRedis();
        $result = $jsonToRedis->run();

        if ($result) {
            $this->resultRequest();
        } else {
            echo 'Ошибка'. PHP_EOL;
        }
    }
}