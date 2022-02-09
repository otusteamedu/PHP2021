<?php

namespace App\Infrastructure;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    private static $instances = [];

    private function __construct() { }

      public function getConfigTreeBuilder()
      {
          $treeBuilder = new TreeBuilder('app');
          $treeBuilder
              ->getRootNode()
              ->children()
                  ->arrayNode('queue')
                      ->children()
                          ->scalarNode('host')->end()
                          ->scalarNode('port')->end()
                          ->scalarNode('user')->end()
                          ->scalarNode('pass')->end()
                          ->scalarNode('vhost')->end()
                          ->scalarNode('exhange')->end()
                          ->scalarNode('queue')->end()
                          ->scalarNode('consumer')->end()
                          ->scalarNode('email')->end()
                      ->end()
                  ->end()
                  ->arrayNode('providers')
                    ->scalarPrototype()->end()
                  ->end()
              ->end();

          return $treeBuilder;
      }

    public static function getInstance()
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }
}