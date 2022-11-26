<?php

namespace App\Exports;

class KeyValueSheetExport
//    implements
//    , WithTitle
{
    private $keys;
    private $values;
    public $collection;

    public function __construct(array $keys, array $values)
    {
        $this->values = $values;
        $this->keys = $keys;
    }

    public function collection()
    {
        return $this->collection;
    }

    public function headings(): array
    {
        return array_keys((array)$this->collection->first());
    }
}
