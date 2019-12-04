<?php

namespace App\Services;

use Vich\UploaderBundle\Naming\NamerInterface;
use Vich\UploaderBundle\Naming\OrignameNamer;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Gedmo\Sluggable\Util as Sluggable;

class VichCleanNamer implements NamerInterface
{
    /**
     * {@inheritdoc}
     */
    public function name($object, PropertyMapping $mapping): string
    {
        $namer = new OrignameNamer();
        $name = $namer->name($object, $mapping);
        $name = Sluggable\Urlizer::urlize($name, '_');

        $file = $mapping->getFile($object);
        $extension = substr($name, strrpos($name, '_') + 1);
        $name  = str_replace('_'.$extension, '.'.$extension, $name);

        return $name;
    }
}
