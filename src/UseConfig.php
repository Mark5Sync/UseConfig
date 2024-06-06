<?php

namespace useconfig;

use Composer\ClassMapGenerator\ClassMapGenerator;

class UseConfig
{

    static function find($config, string $findInPath = './', ?string $endWith = null)
    {
        $map = ClassMapGenerator::createMap($findInPath);
        $result = [];

        foreach ($map as $class => $path) {
            if (!str_ends_with($class, $endWith ? $endWith : 'Config'))
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
