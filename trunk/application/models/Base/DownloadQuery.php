<?php

namespace Base;

use \Download as ChildDownload;
use \DownloadQuery as ChildDownloadQuery;
use \Exception;
use \PDO;
use Map\DownloadTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'download' table.
 *
 *
 *
 * @method     ChildDownloadQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildDownloadQuery orderBySerialId($order = Criteria::ASC) Order by the serial_id column
 * @method     ChildDownloadQuery orderBySourceId($order = Criteria::ASC) Order by the source_id column
 * @method     ChildDownloadQuery orderBySeason($order = Criteria::ASC) Order by the season column
 * @method     ChildDownloadQuery orderByEpisodeId($order = Criteria::ASC) Order by the episode_id column
 * @method     ChildDownloadQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildDownloadQuery orderBySize($order = Criteria::ASC) Order by the size column
 * @method     ChildDownloadQuery orderByNumber($order = Criteria::ASC) Order by the number column
 * @method     ChildDownloadQuery orderByEformat($order = Criteria::ASC) Order by the eformat column
 * @method     ChildDownloadQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildDownloadQuery orderByUrl($order = Criteria::ASC) Order by the url column
 * @method     ChildDownloadQuery orderByUrlMd5($order = Criteria::ASC) Order by the url_md5 column
 * @method     ChildDownloadQuery orderByIsDownload($order = Criteria::ASC) Order by the is_download column
 * @method     ChildDownloadQuery orderByRecodeAt($order = Criteria::ASC) Order by the recode_at column
 * @method     ChildDownloadQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildDownloadQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildDownloadQuery groupById() Group by the id column
 * @method     ChildDownloadQuery groupBySerialId() Group by the serial_id column
 * @method     ChildDownloadQuery groupBySourceId() Group by the source_id column
 * @method     ChildDownloadQuery groupBySeason() Group by the season column
 * @method     ChildDownloadQuery groupByEpisodeId() Group by the episode_id column
 * @method     ChildDownloadQuery groupByName() Group by the name column
 * @method     ChildDownloadQuery groupBySize() Group by the size column
 * @method     ChildDownloadQuery groupByNumber() Group by the number column
 * @method     ChildDownloadQuery groupByEformat() Group by the eformat column
 * @method     ChildDownloadQuery groupByType() Group by the type column
 * @method     ChildDownloadQuery groupByUrl() Group by the url column
 * @method     ChildDownloadQuery groupByUrlMd5() Group by the url_md5 column
 * @method     ChildDownloadQuery groupByIsDownload() Group by the is_download column
 * @method     ChildDownloadQuery groupByRecodeAt() Group by the recode_at column
 * @method     ChildDownloadQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildDownloadQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildDownloadQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDownloadQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDownloadQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDownloadQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDownloadQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDownloadQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDownload findOne(ConnectionInterface $con = null) Return the first ChildDownload matching the query
 * @method     ChildDownload findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDownload matching the query, or a new ChildDownload object populated from the query conditions when no match is found
 *
 * @method     ChildDownload findOneById(int $id) Return the first ChildDownload filtered by the id column
 * @method     ChildDownload findOneBySerialId(int $serial_id) Return the first ChildDownload filtered by the serial_id column
 * @method     ChildDownload findOneBySourceId(int $source_id) Return the first ChildDownload filtered by the source_id column
 * @method     ChildDownload findOneBySeason(string $season) Return the first ChildDownload filtered by the season column
 * @method     ChildDownload findOneByEpisodeId(int $episode_id) Return the first ChildDownload filtered by the episode_id column
 * @method     ChildDownload findOneByName(string $name) Return the first ChildDownload filtered by the name column
 * @method     ChildDownload findOneBySize(string $size) Return the first ChildDownload filtered by the size column
 * @method     ChildDownload findOneByNumber(int $number) Return the first ChildDownload filtered by the number column
 * @method     ChildDownload findOneByEformat(string $eformat) Return the first ChildDownload filtered by the eformat column
 * @method     ChildDownload findOneByType(string $type) Return the first ChildDownload filtered by the type column
 * @method     ChildDownload findOneByUrl(string $url) Return the first ChildDownload filtered by the url column
 * @method     ChildDownload findOneByUrlMd5(string $url_md5) Return the first ChildDownload filtered by the url_md5 column
 * @method     ChildDownload findOneByIsDownload(int $is_download) Return the first ChildDownload filtered by the is_download column
 * @method     ChildDownload findOneByRecodeAt(string $recode_at) Return the first ChildDownload filtered by the recode_at column
 * @method     ChildDownload findOneByCreatedAt(string $created_at) Return the first ChildDownload filtered by the created_at column
 * @method     ChildDownload findOneByUpdatedAt(string $updated_at) Return the first ChildDownload filtered by the updated_at column *

 * @method     ChildDownload requirePk($key, ConnectionInterface $con = null) Return the ChildDownload by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDownload requireOne(ConnectionInterface $con = null) Return the first ChildDownload matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDownload requireOneById(int $id) Return the first ChildDownload filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDownload requireOneBySerialId(int $serial_id) Return the first ChildDownload filtered by the serial_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDownload requireOneBySourceId(int $source_id) Return the first ChildDownload filtered by the source_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDownload requireOneBySeason(string $season) Return the first ChildDownload filtered by the season column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDownload requireOneByEpisodeId(int $episode_id) Return the first ChildDownload filtered by the episode_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDownload requireOneByName(string $name) Return the first ChildDownload filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDownload requireOneBySize(string $size) Return the first ChildDownload filtered by the size column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDownload requireOneByNumber(int $number) Return the first ChildDownload filtered by the number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDownload requireOneByEformat(string $eformat) Return the first ChildDownload filtered by the eformat column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDownload requireOneByType(string $type) Return the first ChildDownload filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDownload requireOneByUrl(string $url) Return the first ChildDownload filtered by the url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDownload requireOneByUrlMd5(string $url_md5) Return the first ChildDownload filtered by the url_md5 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDownload requireOneByIsDownload(int $is_download) Return the first ChildDownload filtered by the is_download column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDownload requireOneByRecodeAt(string $recode_at) Return the first ChildDownload filtered by the recode_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDownload requireOneByCreatedAt(string $created_at) Return the first ChildDownload filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDownload requireOneByUpdatedAt(string $updated_at) Return the first ChildDownload filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDownload[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildDownload objects based on current ModelCriteria
 * @method     ChildDownload[]|ObjectCollection findById(int $id) Return ChildDownload objects filtered by the id column
 * @method     ChildDownload[]|ObjectCollection findBySerialId(int $serial_id) Return ChildDownload objects filtered by the serial_id column
 * @method     ChildDownload[]|ObjectCollection findBySourceId(int $source_id) Return ChildDownload objects filtered by the source_id column
 * @method     ChildDownload[]|ObjectCollection findBySeason(string $season) Return ChildDownload objects filtered by the season column
 * @method     ChildDownload[]|ObjectCollection findByEpisodeId(int $episode_id) Return ChildDownload objects filtered by the episode_id column
 * @method     ChildDownload[]|ObjectCollection findByName(string $name) Return ChildDownload objects filtered by the name column
 * @method     ChildDownload[]|ObjectCollection findBySize(string $size) Return ChildDownload objects filtered by the size column
 * @method     ChildDownload[]|ObjectCollection findByNumber(int $number) Return ChildDownload objects filtered by the number column
 * @method     ChildDownload[]|ObjectCollection findByEformat(string $eformat) Return ChildDownload objects filtered by the eformat column
 * @method     ChildDownload[]|ObjectCollection findByType(string $type) Return ChildDownload objects filtered by the type column
 * @method     ChildDownload[]|ObjectCollection findByUrl(string $url) Return ChildDownload objects filtered by the url column
 * @method     ChildDownload[]|ObjectCollection findByUrlMd5(string $url_md5) Return ChildDownload objects filtered by the url_md5 column
 * @method     ChildDownload[]|ObjectCollection findByIsDownload(int $is_download) Return ChildDownload objects filtered by the is_download column
 * @method     ChildDownload[]|ObjectCollection findByRecodeAt(string $recode_at) Return ChildDownload objects filtered by the recode_at column
 * @method     ChildDownload[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildDownload objects filtered by the created_at column
 * @method     ChildDownload[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildDownload objects filtered by the updated_at column
 * @method     ChildDownload[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class DownloadQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\DownloadQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'serial_db', $modelName = '\\Download', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDownloadQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDownloadQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildDownloadQuery) {
            return $criteria;
        }
        $query = new ChildDownloadQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildDownload|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = DownloadTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DownloadTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDownload A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, serial_id, source_id, season, episode_id, name, size, number, eformat, type, url, url_md5, is_download, recode_at, created_at, updated_at FROM download WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildDownload $obj */
            $obj = new ChildDownload();
            $obj->hydrate($row);
            DownloadTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildDownload|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildDownloadQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DownloadTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildDownloadQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DownloadTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDownloadQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(DownloadTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(DownloadTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DownloadTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the serial_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySerialId(1234); // WHERE serial_id = 1234
     * $query->filterBySerialId(array(12, 34)); // WHERE serial_id IN (12, 34)
     * $query->filterBySerialId(array('min' => 12)); // WHERE serial_id > 12
     * </code>
     *
     * @param     mixed $serialId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDownloadQuery The current query, for fluid interface
     */
    public function filterBySerialId($serialId = null, $comparison = null)
    {
        if (is_array($serialId)) {
            $useMinMax = false;
            if (isset($serialId['min'])) {
                $this->addUsingAlias(DownloadTableMap::COL_SERIAL_ID, $serialId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($serialId['max'])) {
                $this->addUsingAlias(DownloadTableMap::COL_SERIAL_ID, $serialId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DownloadTableMap::COL_SERIAL_ID, $serialId, $comparison);
    }

    /**
     * Filter the query on the source_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySourceId(1234); // WHERE source_id = 1234
     * $query->filterBySourceId(array(12, 34)); // WHERE source_id IN (12, 34)
     * $query->filterBySourceId(array('min' => 12)); // WHERE source_id > 12
     * </code>
     *
     * @param     mixed $sourceId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDownloadQuery The current query, for fluid interface
     */
    public function filterBySourceId($sourceId = null, $comparison = null)
    {
        if (is_array($sourceId)) {
            $useMinMax = false;
            if (isset($sourceId['min'])) {
                $this->addUsingAlias(DownloadTableMap::COL_SOURCE_ID, $sourceId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sourceId['max'])) {
                $this->addUsingAlias(DownloadTableMap::COL_SOURCE_ID, $sourceId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DownloadTableMap::COL_SOURCE_ID, $sourceId, $comparison);
    }

    /**
     * Filter the query on the season column
     *
     * Example usage:
     * <code>
     * $query->filterBySeason('fooValue');   // WHERE season = 'fooValue'
     * $query->filterBySeason('%fooValue%'); // WHERE season LIKE '%fooValue%'
     * </code>
     *
     * @param     string $season The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDownloadQuery The current query, for fluid interface
     */
    public function filterBySeason($season = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($season)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $season)) {
                $season = str_replace('*', '%', $season);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DownloadTableMap::COL_SEASON, $season, $comparison);
    }

    /**
     * Filter the query on the episode_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEpisodeId(1234); // WHERE episode_id = 1234
     * $query->filterByEpisodeId(array(12, 34)); // WHERE episode_id IN (12, 34)
     * $query->filterByEpisodeId(array('min' => 12)); // WHERE episode_id > 12
     * </code>
     *
     * @param     mixed $episodeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDownloadQuery The current query, for fluid interface
     */
    public function filterByEpisodeId($episodeId = null, $comparison = null)
    {
        if (is_array($episodeId)) {
            $useMinMax = false;
            if (isset($episodeId['min'])) {
                $this->addUsingAlias(DownloadTableMap::COL_EPISODE_ID, $episodeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($episodeId['max'])) {
                $this->addUsingAlias(DownloadTableMap::COL_EPISODE_ID, $episodeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DownloadTableMap::COL_EPISODE_ID, $episodeId, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDownloadQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DownloadTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the size column
     *
     * Example usage:
     * <code>
     * $query->filterBySize('fooValue');   // WHERE size = 'fooValue'
     * $query->filterBySize('%fooValue%'); // WHERE size LIKE '%fooValue%'
     * </code>
     *
     * @param     string $size The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDownloadQuery The current query, for fluid interface
     */
    public function filterBySize($size = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($size)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $size)) {
                $size = str_replace('*', '%', $size);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DownloadTableMap::COL_SIZE, $size, $comparison);
    }

    /**
     * Filter the query on the number column
     *
     * Example usage:
     * <code>
     * $query->filterByNumber(1234); // WHERE number = 1234
     * $query->filterByNumber(array(12, 34)); // WHERE number IN (12, 34)
     * $query->filterByNumber(array('min' => 12)); // WHERE number > 12
     * </code>
     *
     * @param     mixed $number The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDownloadQuery The current query, for fluid interface
     */
    public function filterByNumber($number = null, $comparison = null)
    {
        if (is_array($number)) {
            $useMinMax = false;
            if (isset($number['min'])) {
                $this->addUsingAlias(DownloadTableMap::COL_NUMBER, $number['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($number['max'])) {
                $this->addUsingAlias(DownloadTableMap::COL_NUMBER, $number['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DownloadTableMap::COL_NUMBER, $number, $comparison);
    }

    /**
     * Filter the query on the eformat column
     *
     * Example usage:
     * <code>
     * $query->filterByEformat('fooValue');   // WHERE eformat = 'fooValue'
     * $query->filterByEformat('%fooValue%'); // WHERE eformat LIKE '%fooValue%'
     * </code>
     *
     * @param     string $eformat The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDownloadQuery The current query, for fluid interface
     */
    public function filterByEformat($eformat = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($eformat)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $eformat)) {
                $eformat = str_replace('*', '%', $eformat);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DownloadTableMap::COL_EFORMAT, $eformat, $comparison);
    }

    /**
     * Filter the query on the type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE type = 'fooValue'
     * $query->filterByType('%fooValue%'); // WHERE type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDownloadQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $type)) {
                $type = str_replace('*', '%', $type);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DownloadTableMap::COL_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the url column
     *
     * Example usage:
     * <code>
     * $query->filterByUrl('fooValue');   // WHERE url = 'fooValue'
     * $query->filterByUrl('%fooValue%'); // WHERE url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $url The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDownloadQuery The current query, for fluid interface
     */
    public function filterByUrl($url = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($url)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $url)) {
                $url = str_replace('*', '%', $url);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DownloadTableMap::COL_URL, $url, $comparison);
    }

    /**
     * Filter the query on the url_md5 column
     *
     * Example usage:
     * <code>
     * $query->filterByUrlMd5('fooValue');   // WHERE url_md5 = 'fooValue'
     * $query->filterByUrlMd5('%fooValue%'); // WHERE url_md5 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $urlMd5 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDownloadQuery The current query, for fluid interface
     */
    public function filterByUrlMd5($urlMd5 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($urlMd5)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $urlMd5)) {
                $urlMd5 = str_replace('*', '%', $urlMd5);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DownloadTableMap::COL_URL_MD5, $urlMd5, $comparison);
    }

    /**
     * Filter the query on the is_download column
     *
     * Example usage:
     * <code>
     * $query->filterByIsDownload(1234); // WHERE is_download = 1234
     * $query->filterByIsDownload(array(12, 34)); // WHERE is_download IN (12, 34)
     * $query->filterByIsDownload(array('min' => 12)); // WHERE is_download > 12
     * </code>
     *
     * @param     mixed $isDownload The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDownloadQuery The current query, for fluid interface
     */
    public function filterByIsDownload($isDownload = null, $comparison = null)
    {
        if (is_array($isDownload)) {
            $useMinMax = false;
            if (isset($isDownload['min'])) {
                $this->addUsingAlias(DownloadTableMap::COL_IS_DOWNLOAD, $isDownload['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($isDownload['max'])) {
                $this->addUsingAlias(DownloadTableMap::COL_IS_DOWNLOAD, $isDownload['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DownloadTableMap::COL_IS_DOWNLOAD, $isDownload, $comparison);
    }

    /**
     * Filter the query on the recode_at column
     *
     * Example usage:
     * <code>
     * $query->filterByRecodeAt('2011-03-14'); // WHERE recode_at = '2011-03-14'
     * $query->filterByRecodeAt('now'); // WHERE recode_at = '2011-03-14'
     * $query->filterByRecodeAt(array('max' => 'yesterday')); // WHERE recode_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $recodeAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDownloadQuery The current query, for fluid interface
     */
    public function filterByRecodeAt($recodeAt = null, $comparison = null)
    {
        if (is_array($recodeAt)) {
            $useMinMax = false;
            if (isset($recodeAt['min'])) {
                $this->addUsingAlias(DownloadTableMap::COL_RECODE_AT, $recodeAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($recodeAt['max'])) {
                $this->addUsingAlias(DownloadTableMap::COL_RECODE_AT, $recodeAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DownloadTableMap::COL_RECODE_AT, $recodeAt, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDownloadQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(DownloadTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(DownloadTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DownloadTableMap::COL_CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDownloadQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(DownloadTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(DownloadTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DownloadTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildDownload $download Object to remove from the list of results
     *
     * @return $this|ChildDownloadQuery The current query, for fluid interface
     */
    public function prune($download = null)
    {
        if ($download) {
            $this->addUsingAlias(DownloadTableMap::COL_ID, $download->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the download table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DownloadTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DownloadTableMap::clearInstancePool();
            DownloadTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DownloadTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DownloadTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DownloadTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DownloadTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildDownloadQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(DownloadTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildDownloadQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(DownloadTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildDownloadQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(DownloadTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildDownloadQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(DownloadTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildDownloadQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(DownloadTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildDownloadQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(DownloadTableMap::COL_CREATED_AT);
    }

} // DownloadQuery
