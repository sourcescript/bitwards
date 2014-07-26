<?php  namespace Test\V1\API;

abstract class AbstractTransformer {
    public function transformCollection($collection)
    {
        return array_map([$this, 'transform'], $collection->all());
    }

    public abstract function transform($item);
}