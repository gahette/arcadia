<?php

namespace App\Namer;

use App\Entity\Image;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\DirectoryNamerInterface;

/**
 * @implements DirectoryNamerInterface<Image>
 */
class ImageDirectoryNamer implements DirectoryNamerInterface
{
    /**
     * @param Image $object
     *
     * @throws \Exception
     */
    public function directoryName($object, PropertyMapping $mapping): string
    {
        $habitat = $object->getHabitat();
        $animal = $object->getAnimal();
        if (!is_null($animal)) {
            $habitat = $animal->getHabitat();
        }

        if (is_null($habitat)) {
            throw new \Exception('Habitat and Animal MUST not be empty in images');
        }

        $directoryName = $habitat->getSlug();

        if (!is_null($animal)) {
            $directoryName .= '/'.$animal->getId();
        }

        return (string) $directoryName;
    }
}
