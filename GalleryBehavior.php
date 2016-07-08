<?php

namespace Creonit\PropelGalleryBehavior;

use Propel\Generator\Model\Behavior;
use Propel\Generator\Model\ForeignKey;

class GalleryBehavior extends Behavior
{

    public function modifyTable()
    {
        $table = $this->getTable();

        $table->addColumn([
            'name' => 'gallery_id',
            'type' => 'integer'
        ]);

        $fk = new ForeignKey();
        $fk->setForeignTableCommonName('gallery');
        $fk->setForeignSchemaName($table->getSchema());
        $fk->setDefaultJoin('LEFT JOIN');
        $fk->setOnDelete(ForeignKey::SETNULL);
        $fk->setOnUpdate(ForeignKey::CASCADE);
        $fk->addReference('gallery_id', 'id');
        $table->addForeignKey($fk);

    }

}