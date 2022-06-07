<?

namespace Src\Infrastructure;

class AnalyticSystem
{
    private int $param1;
    private int $param2;

    public function __construct(int $param1,int $param2)
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

        $msg = "param1={$this->param1},param2={$this->param2}". PHP_EOL;

        foreach ($keys as $key => $value) {
            foreach ($redis->revRangeByScore($value) as $rKey => $rValue) {
                $msg .= "{$rValue} - приоритет: {$rKey}".PHP_EOL;
                $eventsName[] = $rValue;
                $priorities[] = $rKey;
            }
        }

        if (empty($priorities)) $msg .= 'Нет соответствий'. PHP_EOL;
        arsort($priorities);

        $msg .= $eventsName[key($priorities)] ?: '';
        return $msg;
    }

    /**
     * @return string
     */
    private function resultRequest()
    {
        $result = $this->findEvent();
        if ($result) {
            return "Высший приоритет: {$result}".PHP_EOL;
        } else {
            return "Ничего нет".PHP_EOL;
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
            echo $this->resultRequest();
        } else {
            echo 'Ошибка'. PHP_EOL;
        }
    }
}