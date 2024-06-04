<?php

namespace useconfig;

use Composer\ClassMapGenerator\ClassMapGenerator;

class UseConfig
{

    static function find($config, string $findInPath = './')
    {
        $map = ClassMapGenerator::createMap($findInPath);
        $result = [];

        foreach ($map as $class => $path) {
            $reflection = new \ReflectionClass($class);

            if (!$reflection->isSubclassOf($config))
                continue;

            $result[] = $class;
        }

        return $result;
    }

}
