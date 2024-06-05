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
            if (!str_ends_with($class, 'Config'))
                continue;

            try {
                $reflection = new \ReflectionClass($class);
                if (!$reflection->isSubclassOf($config))
                    continue;
                $result[] = $class;
            } catch (\Throwable $th) {
            }
        }

        return $result;
    }
}
