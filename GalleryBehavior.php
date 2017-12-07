<?php

namespace Creonit\PropelGalleryBehavior;

use Propel\Generator\Model\Behavior;
use Propel\Generator\Model\ForeignKey;

class GalleryBehavior extends Behavior
{

    protected $parameters = [
        'parameter' => 'gallery_id',
    ];

    protected function addGalleryColumn($columnName)
    {
        $table = $this->getTable();
        $table->addColumn([
            'name' => $columnName,
            'type' => 'integer'
        ]);

        $fk = new ForeignKey();
        $fk->setForeignTableCommonName('gallery');
        $fk->setForeignSchemaName($table->getSchema());
        $fk->setDefaultJoin('LEFT JOIN');
        $fk->setOnDelete(ForeignKey::SETNULL);
        $fk->setOnUpdate(ForeignKey::CASCADE);
        $fk->addReference($columnName, 'id');
        $table->addForeignKey($fk);
    }

    public function modifyTable()
    {
        $columns = explode(',', $this->getParameter('parameter'));
        foreach ($columns as $column) {
            $this->addGalleryColumn(trim($column));
        }
    }

}