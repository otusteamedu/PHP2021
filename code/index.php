<?php 
$m = new Memcached();
$m->addServer('memcached', 11211);
echo '<pre>'; print_r($m->getVersion()); echo '</pre>';

phpinfo();
