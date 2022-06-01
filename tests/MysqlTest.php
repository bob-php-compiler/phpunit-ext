<?php

include 'phpunit-ext/loader.php';

class MysqlTest extends PHPUnit_DbUnit_Mysql_TestCase
{
    public function getDataSet()
    {
        return $this->createArrayDataSet(array(
            'phpunit_ext' => array(
                array('id' => 1, 'val' => 'A'),
                array('id' => 2, 'val' => 'B'),
                array('id' => 3, 'val' => 'C')
            )
        ));
    }

    public function testDataSet()
    {
        // FilterDataSet
        $expectedDataSet = $this->createArrayDataSet(array(
            'phpunit_ext' => array(
                array('id' => 1),
                array('id' => 2),
                array('id' => 3)
            )
        ));

        $dataSet = $this->getConnection()->createDataSet(array('phpunit_ext'));
        $filterDataSet = new PHPUnit_DbUnit_DataSet_FilterDataSet($dataSet);
        $filterDataSet->setExcludeColumnsForTable('phpunit_ext', array('val'));

        $this->assertDataSetsEqual($expectedDataSet, $filterDataSet);

        // QueryDataSet
        $expectedDataSet = $this->createArrayDataSet(array(
            'phpunit_ext' => array(
                array('id' => 1, 'val' => 'A'),
                array('id' => 2, 'val' => 'B'),
                array('id' => 3, 'val' => 'C')
            )
        ));

        $ds = new PHPUnit_DbUnit_DataSet_QueryDataSet($this->getConnection());
        $ds->addTable('phpunit_ext', 'SELECT * FROM phpunit_ext');

        $this->assertDataSetsEqual($expectedDataSet, $ds);
    }
}
