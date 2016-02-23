<?php

namespace Map;

use \Download;
use \DownloadQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'download' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class DownloadTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.DownloadTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'serial_db';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'download';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Download';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Download';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 16;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 16;

    /**
     * the column name for the id field
     */
    const COL_ID = 'download.id';

    /**
     * the column name for the serial_id field
     */
    const COL_SERIAL_ID = 'download.serial_id';

    /**
     * the column name for the source_id field
     */
    const COL_SOURCE_ID = 'download.source_id';

    /**
     * the column name for the season field
     */
    const COL_SEASON = 'download.season';

    /**
     * the column name for the episode_id field
     */
    const COL_EPISODE_ID = 'download.episode_id';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'download.name';

    /**
     * the column name for the size field
     */
    const COL_SIZE = 'download.size';

    /**
     * the column name for the number field
     */
    const COL_NUMBER = 'download.number';

    /**
     * the column name for the eformat field
     */
    const COL_EFORMAT = 'download.eformat';

    /**
     * the column name for the type field
     */
    const COL_TYPE = 'download.type';

    /**
     * the column name for the url field
     */
    const COL_URL = 'download.url';

    /**
     * the column name for the url_md5 field
     */
    const COL_URL_MD5 = 'download.url_md5';

    /**
     * the column name for the is_download field
     */
    const COL_IS_DOWNLOAD = 'download.is_download';

    /**
     * the column name for the recode_at field
     */
    const COL_RECODE_AT = 'download.recode_at';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'download.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'download.updated_at';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'SerialId', 'SourceId', 'Season', 'EpisodeId', 'Name', 'Size', 'Number', 'Eformat', 'Type', 'Url', 'UrlMd5', 'IsDownload', 'RecodeAt', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'serialId', 'sourceId', 'season', 'episodeId', 'name', 'size', 'number', 'eformat', 'type', 'url', 'urlMd5', 'isDownload', 'recodeAt', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(DownloadTableMap::COL_ID, DownloadTableMap::COL_SERIAL_ID, DownloadTableMap::COL_SOURCE_ID, DownloadTableMap::COL_SEASON, DownloadTableMap::COL_EPISODE_ID, DownloadTableMap::COL_NAME, DownloadTableMap::COL_SIZE, DownloadTableMap::COL_NUMBER, DownloadTableMap::COL_EFORMAT, DownloadTableMap::COL_TYPE, DownloadTableMap::COL_URL, DownloadTableMap::COL_URL_MD5, DownloadTableMap::COL_IS_DOWNLOAD, DownloadTableMap::COL_RECODE_AT, DownloadTableMap::COL_CREATED_AT, DownloadTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'serial_id', 'source_id', 'season', 'episode_id', 'name', 'size', 'number', 'eformat', 'type', 'url', 'url_md5', 'is_download', 'recode_at', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'SerialId' => 1, 'SourceId' => 2, 'Season' => 3, 'EpisodeId' => 4, 'Name' => 5, 'Size' => 6, 'Number' => 7, 'Eformat' => 8, 'Type' => 9, 'Url' => 10, 'UrlMd5' => 11, 'IsDownload' => 12, 'RecodeAt' => 13, 'CreatedAt' => 14, 'UpdatedAt' => 15, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'serialId' => 1, 'sourceId' => 2, 'season' => 3, 'episodeId' => 4, 'name' => 5, 'size' => 6, 'number' => 7, 'eformat' => 8, 'type' => 9, 'url' => 10, 'urlMd5' => 11, 'isDownload' => 12, 'recodeAt' => 13, 'createdAt' => 14, 'updatedAt' => 15, ),
        self::TYPE_COLNAME       => array(DownloadTableMap::COL_ID => 0, DownloadTableMap::COL_SERIAL_ID => 1, DownloadTableMap::COL_SOURCE_ID => 2, DownloadTableMap::COL_SEASON => 3, DownloadTableMap::COL_EPISODE_ID => 4, DownloadTableMap::COL_NAME => 5, DownloadTableMap::COL_SIZE => 6, DownloadTableMap::COL_NUMBER => 7, DownloadTableMap::COL_EFORMAT => 8, DownloadTableMap::COL_TYPE => 9, DownloadTableMap::COL_URL => 10, DownloadTableMap::COL_URL_MD5 => 11, DownloadTableMap::COL_IS_DOWNLOAD => 12, DownloadTableMap::COL_RECODE_AT => 13, DownloadTableMap::COL_CREATED_AT => 14, DownloadTableMap::COL_UPDATED_AT => 15, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'serial_id' => 1, 'source_id' => 2, 'season' => 3, 'episode_id' => 4, 'name' => 5, 'size' => 6, 'number' => 7, 'eformat' => 8, 'type' => 9, 'url' => 10, 'url_md5' => 11, 'is_download' => 12, 'recode_at' => 13, 'created_at' => 14, 'updated_at' => 15, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('download');
        $this->setPhpName('Download');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Download');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('serial_id', 'SerialId', 'INTEGER', true, null, null);
        $this->addColumn('source_id', 'SourceId', 'INTEGER', true, null, null);
        $this->addColumn('season', 'Season', 'VARCHAR', true, 24, null);
        $this->addColumn('episode_id', 'EpisodeId', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 200, null);
        $this->addColumn('size', 'Size', 'VARCHAR', true, 200, null);
        $this->addColumn('number', 'Number', 'INTEGER', true, null, null);
        $this->addColumn('eformat', 'Eformat', 'VARCHAR', true, 20, null);
        $this->addColumn('type', 'Type', 'VARCHAR', true, 20, null);
        $this->addColumn('url', 'Url', 'LONGVARCHAR', true, 2000, null);
        $this->addColumn('url_md5', 'UrlMd5', 'VARCHAR', true, 32, null);
        $this->addColumn('is_download', 'IsDownload', 'INTEGER', true, null, 0);
        $this->addColumn('recode_at', 'RecodeAt', 'TIMESTAMP', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false', ),
        );
    } // getBehaviors()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? DownloadTableMap::CLASS_DEFAULT : DownloadTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Download object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = DownloadTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = DownloadTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + DownloadTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DownloadTableMap::OM_CLASS;
            /** @var Download $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            DownloadTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = DownloadTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = DownloadTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Download $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DownloadTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(DownloadTableMap::COL_ID);
            $criteria->addSelectColumn(DownloadTableMap::COL_SERIAL_ID);
            $criteria->addSelectColumn(DownloadTableMap::COL_SOURCE_ID);
            $criteria->addSelectColumn(DownloadTableMap::COL_SEASON);
            $criteria->addSelectColumn(DownloadTableMap::COL_EPISODE_ID);
            $criteria->addSelectColumn(DownloadTableMap::COL_NAME);
            $criteria->addSelectColumn(DownloadTableMap::COL_SIZE);
            $criteria->addSelectColumn(DownloadTableMap::COL_NUMBER);
            $criteria->addSelectColumn(DownloadTableMap::COL_EFORMAT);
            $criteria->addSelectColumn(DownloadTableMap::COL_TYPE);
            $criteria->addSelectColumn(DownloadTableMap::COL_URL);
            $criteria->addSelectColumn(DownloadTableMap::COL_URL_MD5);
            $criteria->addSelectColumn(DownloadTableMap::COL_IS_DOWNLOAD);
            $criteria->addSelectColumn(DownloadTableMap::COL_RECODE_AT);
            $criteria->addSelectColumn(DownloadTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(DownloadTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.serial_id');
            $criteria->addSelectColumn($alias . '.source_id');
            $criteria->addSelectColumn($alias . '.season');
            $criteria->addSelectColumn($alias . '.episode_id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.size');
            $criteria->addSelectColumn($alias . '.number');
            $criteria->addSelectColumn($alias . '.eformat');
            $criteria->addSelectColumn($alias . '.type');
            $criteria->addSelectColumn($alias . '.url');
            $criteria->addSelectColumn($alias . '.url_md5');
            $criteria->addSelectColumn($alias . '.is_download');
            $criteria->addSelectColumn($alias . '.recode_at');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(DownloadTableMap::DATABASE_NAME)->getTable(DownloadTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(DownloadTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(DownloadTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new DownloadTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Download or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Download object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DownloadTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Download) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DownloadTableMap::DATABASE_NAME);
            $criteria->add(DownloadTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = DownloadQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            DownloadTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                DownloadTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the download table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return DownloadQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Download or Criteria object.
     *
     * @param mixed               $criteria Criteria or Download object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DownloadTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Download object
        }

        if ($criteria->containsKey(DownloadTableMap::COL_ID) && $criteria->keyContainsValue(DownloadTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.DownloadTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = DownloadQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // DownloadTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
DownloadTableMap::buildTableMap();
