<?php

namespace Base;

use \Download as ChildDownload;
use \DownloadQuery as ChildDownloadQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\DownloadTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'download' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class Download implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\DownloadTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the serial_id field.
     *
     * @var        int
     */
    protected $serial_id;

    /**
     * The value for the source_id field.
     *
     * @var        int
     */
    protected $source_id;

    /**
     * The value for the season field.
     *
     * @var        string
     */
    protected $season;

    /**
     * The value for the episode_id field.
     *
     * @var        int
     */
    protected $episode_id;

    /**
     * The value for the name field.
     *
     * @var        string
     */
    protected $name;

    /**
     * The value for the size field.
     *
     * @var        string
     */
    protected $size;

    /**
     * The value for the number field.
     *
     * @var        int
     */
    protected $number;

    /**
     * The value for the eformat field.
     * HDTV|MKV
     * @var        string
     */
    protected $eformat;

    /**
     * The value for the type field.
     * ed2k|magnet|thunder
     * @var        string
     */
    protected $type;

    /**
     * The value for the url field.
     * 来源地址
     * @var        string
     */
    protected $url;

    /**
     * The value for the url_md5 field.
     * 来源地址索引
     * @var        string
     */
    protected $url_md5;

    /**
     * The value for the is_download field.
     * 是否下载过
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $is_download;

    /**
     * The value for the recode_at field.
     * 最后收录时间
     * @var        \DateTime
     */
    protected $recode_at;

    /**
     * The value for the created_at field.
     *
     * @var        \DateTime
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     *
     * @var        \DateTime
     */
    protected $updated_at;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->is_download = 0;
    }

    /**
     * Initializes internal state of Base\Download object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Download</code> instance.  If
     * <code>obj</code> is an instance of <code>Download</code>, delegates to
     * <code>equals(Download)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Download The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [serial_id] column value.
     *
     * @return int
     */
    public function getSerialId()
    {
        return $this->serial_id;
    }

    /**
     * Get the [source_id] column value.
     *
     * @return int
     */
    public function getSourceId()
    {
        return $this->source_id;
    }

    /**
     * Get the [season] column value.
     *
     * @return string
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * Get the [episode_id] column value.
     *
     * @return int
     */
    public function getEpisodeId()
    {
        return $this->episode_id;
    }

    /**
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [size] column value.
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Get the [number] column value.
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Get the [eformat] column value.
     * HDTV|MKV
     * @return string
     */
    public function getEformat()
    {
        return $this->eformat;
    }

    /**
     * Get the [type] column value.
     * ed2k|magnet|thunder
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the [url] column value.
     * 来源地址
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get the [url_md5] column value.
     * 来源地址索引
     * @return string
     */
    public function getUrlMd5()
    {
        return $this->url_md5;
    }

    /**
     * Get the [is_download] column value.
     * 是否下载过
     * @return int
     */
    public function getIsDownload()
    {
        return $this->is_download;
    }

    /**
     * Get the [optionally formatted] temporal [recode_at] column value.
     * 最后收录时间
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getRecodeAt($format = NULL)
    {
        if ($format === null) {
            return $this->recode_at;
        } else {
            return $this->recode_at instanceof \DateTime ? $this->recode_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTime ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->updated_at;
        } else {
            return $this->updated_at instanceof \DateTime ? $this->updated_at->format($format) : null;
        }
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return $this|\Download The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[DownloadTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [serial_id] column.
     *
     * @param int $v new value
     * @return $this|\Download The current object (for fluent API support)
     */
    public function setSerialId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->serial_id !== $v) {
            $this->serial_id = $v;
            $this->modifiedColumns[DownloadTableMap::COL_SERIAL_ID] = true;
        }

        return $this;
    } // setSerialId()

    /**
     * Set the value of [source_id] column.
     *
     * @param int $v new value
     * @return $this|\Download The current object (for fluent API support)
     */
    public function setSourceId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->source_id !== $v) {
            $this->source_id = $v;
            $this->modifiedColumns[DownloadTableMap::COL_SOURCE_ID] = true;
        }

        return $this;
    } // setSourceId()

    /**
     * Set the value of [season] column.
     *
     * @param string $v new value
     * @return $this|\Download The current object (for fluent API support)
     */
    public function setSeason($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->season !== $v) {
            $this->season = $v;
            $this->modifiedColumns[DownloadTableMap::COL_SEASON] = true;
        }

        return $this;
    } // setSeason()

    /**
     * Set the value of [episode_id] column.
     *
     * @param int $v new value
     * @return $this|\Download The current object (for fluent API support)
     */
    public function setEpisodeId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->episode_id !== $v) {
            $this->episode_id = $v;
            $this->modifiedColumns[DownloadTableMap::COL_EPISODE_ID] = true;
        }

        return $this;
    } // setEpisodeId()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return $this|\Download The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[DownloadTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [size] column.
     *
     * @param string $v new value
     * @return $this|\Download The current object (for fluent API support)
     */
    public function setSize($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->size !== $v) {
            $this->size = $v;
            $this->modifiedColumns[DownloadTableMap::COL_SIZE] = true;
        }

        return $this;
    } // setSize()

    /**
     * Set the value of [number] column.
     *
     * @param int $v new value
     * @return $this|\Download The current object (for fluent API support)
     */
    public function setNumber($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->number !== $v) {
            $this->number = $v;
            $this->modifiedColumns[DownloadTableMap::COL_NUMBER] = true;
        }

        return $this;
    } // setNumber()

    /**
     * Set the value of [eformat] column.
     * HDTV|MKV
     * @param string $v new value
     * @return $this|\Download The current object (for fluent API support)
     */
    public function setEformat($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->eformat !== $v) {
            $this->eformat = $v;
            $this->modifiedColumns[DownloadTableMap::COL_EFORMAT] = true;
        }

        return $this;
    } // setEformat()

    /**
     * Set the value of [type] column.
     * ed2k|magnet|thunder
     * @param string $v new value
     * @return $this|\Download The current object (for fluent API support)
     */
    public function setType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->type !== $v) {
            $this->type = $v;
            $this->modifiedColumns[DownloadTableMap::COL_TYPE] = true;
        }

        return $this;
    } // setType()

    /**
     * Set the value of [url] column.
     * 来源地址
     * @param string $v new value
     * @return $this|\Download The current object (for fluent API support)
     */
    public function setUrl($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->url !== $v) {
            $this->url = $v;
            $this->modifiedColumns[DownloadTableMap::COL_URL] = true;
        }

        return $this;
    } // setUrl()

    /**
     * Set the value of [url_md5] column.
     * 来源地址索引
     * @param string $v new value
     * @return $this|\Download The current object (for fluent API support)
     */
    public function setUrlMd5($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->url_md5 !== $v) {
            $this->url_md5 = $v;
            $this->modifiedColumns[DownloadTableMap::COL_URL_MD5] = true;
        }

        return $this;
    } // setUrlMd5()

    /**
     * Set the value of [is_download] column.
     * 是否下载过
     * @param int $v new value
     * @return $this|\Download The current object (for fluent API support)
     */
    public function setIsDownload($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->is_download !== $v) {
            $this->is_download = $v;
            $this->modifiedColumns[DownloadTableMap::COL_IS_DOWNLOAD] = true;
        }

        return $this;
    } // setIsDownload()

    /**
     * Sets the value of [recode_at] column to a normalized version of the date/time value specified.
     * 最后收录时间
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Download The current object (for fluent API support)
     */
    public function setRecodeAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->recode_at !== null || $dt !== null) {
            if ($this->recode_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->recode_at->format("Y-m-d H:i:s")) {
                $this->recode_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DownloadTableMap::COL_RECODE_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setRecodeAt()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Download The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->created_at->format("Y-m-d H:i:s")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DownloadTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Download The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s") !== $this->updated_at->format("Y-m-d H:i:s")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DownloadTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setUpdatedAt()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->is_download !== 0) {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : DownloadTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : DownloadTableMap::translateFieldName('SerialId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->serial_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : DownloadTableMap::translateFieldName('SourceId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->source_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : DownloadTableMap::translateFieldName('Season', TableMap::TYPE_PHPNAME, $indexType)];
            $this->season = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : DownloadTableMap::translateFieldName('EpisodeId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->episode_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : DownloadTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : DownloadTableMap::translateFieldName('Size', TableMap::TYPE_PHPNAME, $indexType)];
            $this->size = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : DownloadTableMap::translateFieldName('Number', TableMap::TYPE_PHPNAME, $indexType)];
            $this->number = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : DownloadTableMap::translateFieldName('Eformat', TableMap::TYPE_PHPNAME, $indexType)];
            $this->eformat = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : DownloadTableMap::translateFieldName('Type', TableMap::TYPE_PHPNAME, $indexType)];
            $this->type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : DownloadTableMap::translateFieldName('Url', TableMap::TYPE_PHPNAME, $indexType)];
            $this->url = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : DownloadTableMap::translateFieldName('UrlMd5', TableMap::TYPE_PHPNAME, $indexType)];
            $this->url_md5 = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : DownloadTableMap::translateFieldName('IsDownload', TableMap::TYPE_PHPNAME, $indexType)];
            $this->is_download = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : DownloadTableMap::translateFieldName('RecodeAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->recode_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : DownloadTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : DownloadTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 16; // 16 = DownloadTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Download'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DownloadTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildDownloadQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Download::setDeleted()
     * @see Download::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(DownloadTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildDownloadQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(DownloadTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior

                if (!$this->isColumnModified(DownloadTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(DownloadTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(DownloadTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                DownloadTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[DownloadTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . DownloadTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(DownloadTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(DownloadTableMap::COL_SERIAL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'serial_id';
        }
        if ($this->isColumnModified(DownloadTableMap::COL_SOURCE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'source_id';
        }
        if ($this->isColumnModified(DownloadTableMap::COL_SEASON)) {
            $modifiedColumns[':p' . $index++]  = 'season';
        }
        if ($this->isColumnModified(DownloadTableMap::COL_EPISODE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'episode_id';
        }
        if ($this->isColumnModified(DownloadTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(DownloadTableMap::COL_SIZE)) {
            $modifiedColumns[':p' . $index++]  = 'size';
        }
        if ($this->isColumnModified(DownloadTableMap::COL_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'number';
        }
        if ($this->isColumnModified(DownloadTableMap::COL_EFORMAT)) {
            $modifiedColumns[':p' . $index++]  = 'eformat';
        }
        if ($this->isColumnModified(DownloadTableMap::COL_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'type';
        }
        if ($this->isColumnModified(DownloadTableMap::COL_URL)) {
            $modifiedColumns[':p' . $index++]  = 'url';
        }
        if ($this->isColumnModified(DownloadTableMap::COL_URL_MD5)) {
            $modifiedColumns[':p' . $index++]  = 'url_md5';
        }
        if ($this->isColumnModified(DownloadTableMap::COL_IS_DOWNLOAD)) {
            $modifiedColumns[':p' . $index++]  = 'is_download';
        }
        if ($this->isColumnModified(DownloadTableMap::COL_RECODE_AT)) {
            $modifiedColumns[':p' . $index++]  = 'recode_at';
        }
        if ($this->isColumnModified(DownloadTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(DownloadTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO download (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'serial_id':
                        $stmt->bindValue($identifier, $this->serial_id, PDO::PARAM_INT);
                        break;
                    case 'source_id':
                        $stmt->bindValue($identifier, $this->source_id, PDO::PARAM_INT);
                        break;
                    case 'season':
                        $stmt->bindValue($identifier, $this->season, PDO::PARAM_STR);
                        break;
                    case 'episode_id':
                        $stmt->bindValue($identifier, $this->episode_id, PDO::PARAM_INT);
                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case 'size':
                        $stmt->bindValue($identifier, $this->size, PDO::PARAM_STR);
                        break;
                    case 'number':
                        $stmt->bindValue($identifier, $this->number, PDO::PARAM_INT);
                        break;
                    case 'eformat':
                        $stmt->bindValue($identifier, $this->eformat, PDO::PARAM_STR);
                        break;
                    case 'type':
                        $stmt->bindValue($identifier, $this->type, PDO::PARAM_STR);
                        break;
                    case 'url':
                        $stmt->bindValue($identifier, $this->url, PDO::PARAM_STR);
                        break;
                    case 'url_md5':
                        $stmt->bindValue($identifier, $this->url_md5, PDO::PARAM_STR);
                        break;
                    case 'is_download':
                        $stmt->bindValue($identifier, $this->is_download, PDO::PARAM_INT);
                        break;
                    case 'recode_at':
                        $stmt->bindValue($identifier, $this->recode_at ? $this->recode_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = DownloadTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getSerialId();
                break;
            case 2:
                return $this->getSourceId();
                break;
            case 3:
                return $this->getSeason();
                break;
            case 4:
                return $this->getEpisodeId();
                break;
            case 5:
                return $this->getName();
                break;
            case 6:
                return $this->getSize();
                break;
            case 7:
                return $this->getNumber();
                break;
            case 8:
                return $this->getEformat();
                break;
            case 9:
                return $this->getType();
                break;
            case 10:
                return $this->getUrl();
                break;
            case 11:
                return $this->getUrlMd5();
                break;
            case 12:
                return $this->getIsDownload();
                break;
            case 13:
                return $this->getRecodeAt();
                break;
            case 14:
                return $this->getCreatedAt();
                break;
            case 15:
                return $this->getUpdatedAt();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array())
    {

        if (isset($alreadyDumpedObjects['Download'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Download'][$this->hashCode()] = true;
        $keys = DownloadTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getSerialId(),
            $keys[2] => $this->getSourceId(),
            $keys[3] => $this->getSeason(),
            $keys[4] => $this->getEpisodeId(),
            $keys[5] => $this->getName(),
            $keys[6] => $this->getSize(),
            $keys[7] => $this->getNumber(),
            $keys[8] => $this->getEformat(),
            $keys[9] => $this->getType(),
            $keys[10] => $this->getUrl(),
            $keys[11] => $this->getUrlMd5(),
            $keys[12] => $this->getIsDownload(),
            $keys[13] => $this->getRecodeAt(),
            $keys[14] => $this->getCreatedAt(),
            $keys[15] => $this->getUpdatedAt(),
        );
        if ($result[$keys[13]] instanceof \DateTime) {
            $result[$keys[13]] = $result[$keys[13]]->format('c');
        }

        if ($result[$keys[14]] instanceof \DateTime) {
            $result[$keys[14]] = $result[$keys[14]]->format('c');
        }

        if ($result[$keys[15]] instanceof \DateTime) {
            $result[$keys[15]] = $result[$keys[15]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }


        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Download
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = DownloadTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Download
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setSerialId($value);
                break;
            case 2:
                $this->setSourceId($value);
                break;
            case 3:
                $this->setSeason($value);
                break;
            case 4:
                $this->setEpisodeId($value);
                break;
            case 5:
                $this->setName($value);
                break;
            case 6:
                $this->setSize($value);
                break;
            case 7:
                $this->setNumber($value);
                break;
            case 8:
                $this->setEformat($value);
                break;
            case 9:
                $this->setType($value);
                break;
            case 10:
                $this->setUrl($value);
                break;
            case 11:
                $this->setUrlMd5($value);
                break;
            case 12:
                $this->setIsDownload($value);
                break;
            case 13:
                $this->setRecodeAt($value);
                break;
            case 14:
                $this->setCreatedAt($value);
                break;
            case 15:
                $this->setUpdatedAt($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = DownloadTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setSerialId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setSourceId($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setSeason($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setEpisodeId($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setName($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setSize($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setNumber($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setEformat($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setType($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setUrl($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setUrlMd5($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setIsDownload($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setRecodeAt($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setCreatedAt($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setUpdatedAt($arr[$keys[15]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Download The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(DownloadTableMap::DATABASE_NAME);

        if ($this->isColumnModified(DownloadTableMap::COL_ID)) {
            $criteria->add(DownloadTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(DownloadTableMap::COL_SERIAL_ID)) {
            $criteria->add(DownloadTableMap::COL_SERIAL_ID, $this->serial_id);
        }
        if ($this->isColumnModified(DownloadTableMap::COL_SOURCE_ID)) {
            $criteria->add(DownloadTableMap::COL_SOURCE_ID, $this->source_id);
        }
        if ($this->isColumnModified(DownloadTableMap::COL_SEASON)) {
            $criteria->add(DownloadTableMap::COL_SEASON, $this->season);
        }
        if ($this->isColumnModified(DownloadTableMap::COL_EPISODE_ID)) {
            $criteria->add(DownloadTableMap::COL_EPISODE_ID, $this->episode_id);
        }
        if ($this->isColumnModified(DownloadTableMap::COL_NAME)) {
            $criteria->add(DownloadTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(DownloadTableMap::COL_SIZE)) {
            $criteria->add(DownloadTableMap::COL_SIZE, $this->size);
        }
        if ($this->isColumnModified(DownloadTableMap::COL_NUMBER)) {
            $criteria->add(DownloadTableMap::COL_NUMBER, $this->number);
        }
        if ($this->isColumnModified(DownloadTableMap::COL_EFORMAT)) {
            $criteria->add(DownloadTableMap::COL_EFORMAT, $this->eformat);
        }
        if ($this->isColumnModified(DownloadTableMap::COL_TYPE)) {
            $criteria->add(DownloadTableMap::COL_TYPE, $this->type);
        }
        if ($this->isColumnModified(DownloadTableMap::COL_URL)) {
            $criteria->add(DownloadTableMap::COL_URL, $this->url);
        }
        if ($this->isColumnModified(DownloadTableMap::COL_URL_MD5)) {
            $criteria->add(DownloadTableMap::COL_URL_MD5, $this->url_md5);
        }
        if ($this->isColumnModified(DownloadTableMap::COL_IS_DOWNLOAD)) {
            $criteria->add(DownloadTableMap::COL_IS_DOWNLOAD, $this->is_download);
        }
        if ($this->isColumnModified(DownloadTableMap::COL_RECODE_AT)) {
            $criteria->add(DownloadTableMap::COL_RECODE_AT, $this->recode_at);
        }
        if ($this->isColumnModified(DownloadTableMap::COL_CREATED_AT)) {
            $criteria->add(DownloadTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(DownloadTableMap::COL_UPDATED_AT)) {
            $criteria->add(DownloadTableMap::COL_UPDATED_AT, $this->updated_at);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildDownloadQuery::create();
        $criteria->add(DownloadTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Download (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setSerialId($this->getSerialId());
        $copyObj->setSourceId($this->getSourceId());
        $copyObj->setSeason($this->getSeason());
        $copyObj->setEpisodeId($this->getEpisodeId());
        $copyObj->setName($this->getName());
        $copyObj->setSize($this->getSize());
        $copyObj->setNumber($this->getNumber());
        $copyObj->setEformat($this->getEformat());
        $copyObj->setType($this->getType());
        $copyObj->setUrl($this->getUrl());
        $copyObj->setUrlMd5($this->getUrlMd5());
        $copyObj->setIsDownload($this->getIsDownload());
        $copyObj->setRecodeAt($this->getRecodeAt());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Download Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->serial_id = null;
        $this->source_id = null;
        $this->season = null;
        $this->episode_id = null;
        $this->name = null;
        $this->size = null;
        $this->number = null;
        $this->eformat = null;
        $this->type = null;
        $this->url = null;
        $this->url_md5 = null;
        $this->is_download = null;
        $this->recode_at = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
        } // if ($deep)

    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(DownloadTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     $this|ChildDownload The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[DownloadTableMap::COL_UPDATED_AT] = true;

        return $this;
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {

    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
