<?php

namespace Base;

use \Episode as ChildEpisode;
use \EpisodeQuery as ChildEpisodeQuery;
use \Exception;
use \PDO;
use Map\EpisodeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'episode' table.
 *
 *
 *
 * @method     ChildEpisodeQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildEpisodeQuery orderBySerialId($order = Criteria::ASC) Order by the serial_id column
 * @method     ChildEpisodeQuery orderBySourceId($order = Criteria::ASC) Order by the source_id column
 * @method     ChildEpisodeQuery orderBySeason($order = Criteria::ASC) Order by the season column
 * @method     ChildEpisodeQuery orderByNumber($order = Criteria::ASC) Order by the number column
 * @method     ChildEpisodeQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildEpisodeQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildEpisodeQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildEpisodeQuery groupById() Group by the id column
 * @method     ChildEpisodeQuery groupBySerialId() Group by the serial_id column
 * @method     ChildEpisodeQuery groupBySourceId() Group by the source_id column
 * @method     ChildEpisodeQuery groupBySeason() Group by the season column
 * @method     ChildEpisodeQuery groupByNumber() Group by the number column
 * @method     ChildEpisodeQuery groupByName() Group by the name column
 * @method     ChildEpisodeQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildEpisodeQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildEpisodeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEpisodeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEpisodeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEpisodeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEpisodeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEpisodeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEpisode findOne(ConnectionInterface $con = null) Return the first ChildEpisode matching the query
 * @method     ChildEpisode findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEpisode matching the query, or a new ChildEpisode object populated from the query conditions when no match is found
 *
 * @method     ChildEpisode findOneById(int $id) Return the first ChildEpisode filtered by the id column
 * @method     ChildEpisode findOneBySerialId(int $serial_id) Return the first ChildEpisode filtered by the serial_id column
 * @method     ChildEpisode findOneBySourceId(int $source_id) Return the first ChildEpisode filtered by the source_id column
 * @method     ChildEpisode findOneBySeason(string $season) Return the first ChildEpisode filtered by the season column
 * @method     ChildEpisode findOneByNumber(int $number) Return the first ChildEpisode filtered by the number column
 * @method     ChildEpisode findOneByName(string $name) Return the first ChildEpisode filtered by the name column
 * @method     ChildEpisode findOneByCreatedAt(string $created_at) Return the first ChildEpisode filtered by the created_at column
 * @method     ChildEpisode findOneByUpdatedAt(string $updated_at) Return the first ChildEpisode filtered by the updated_at column *

 * @method     ChildEpisode requirePk($key, ConnectionInterface $con = null) Return the ChildEpisode by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEpisode requireOne(ConnectionInterface $con = null) Return the first ChildEpisode matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEpisode requireOneById(int $id) Return the first ChildEpisode filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEpisode requireOneBySerialId(int $serial_id) Return the first ChildEpisode filtered by the serial_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEpisode requireOneBySourceId(int $source_id) Return the first ChildEpisode filtered by the source_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEpisode requireOneBySeason(string $season) Return the first ChildEpisode filtered by the season column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEpisode requireOneByNumber(int $number) Return the first ChildEpisode filtered by the number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEpisode requireOneByName(string $name) Return the first ChildEpisode filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEpisode requireOneByCreatedAt(string $created_at) Return the first ChildEpisode filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEpisode requireOneByUpdatedAt(string $updated_at) Return the first ChildEpisode filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEpisode[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEpisode objects based on current ModelCriteria
 * @method     ChildEpisode[]|ObjectCollection findById(int $id) Return ChildEpisode objects filtered by the id column
 * @method     ChildEpisode[]|ObjectCollection findBySerialId(int $serial_id) Return ChildEpisode objects filtered by the serial_id column
 * @method     ChildEpisode[]|ObjectCollection findBySourceId(int $source_id) Return ChildEpisode objects filtered by the source_id column
 * @method     ChildEpisode[]|ObjectCollection findBySeason(string $season) Return ChildEpisode objects filtered by the season column
 * @method     ChildEpisode[]|ObjectCollection findByNumber(int $number) Return ChildEpisode objects filtered by the number column
 * @method     ChildEpisode[]|ObjectCollection findByName(string $name) Return ChildEpisode objects filtered by the name column
 * @method     ChildEpisode[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildEpisode objects filtered by the created_at column
 * @method     ChildEpisode[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildEpisode objects filtered by the updated_at column
 * @method     ChildEpisode[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EpisodeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\EpisodeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'serial_db', $modelName = '\\Episode', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEpisodeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEpisodeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEpisodeQuery) {
            return $criteria;
        }
        $query = new ChildEpisodeQuery();
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
     * @return ChildEpisode|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = EpisodeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EpisodeTableMap::DATABASE_NAME);
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
     * @return ChildEpisode A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, serial_id, source_id, season, number, name, created_at, updated_at FROM episode WHERE id = :p0';
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
            /** @var ChildEpisode $obj */
            $obj = new ChildEpisode();
            $obj->hydrate($row);
            EpisodeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEpisode|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildEpisodeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EpisodeTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEpisodeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EpisodeTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildEpisodeQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(EpisodeTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(EpisodeTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EpisodeTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildEpisodeQuery The current query, for fluid interface
     */
    public function filterBySerialId($serialId = null, $comparison = null)
    {
        if (is_array($serialId)) {
            $useMinMax = false;
            if (isset($serialId['min'])) {
                $this->addUsingAlias(EpisodeTableMap::COL_SERIAL_ID, $serialId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($serialId['max'])) {
                $this->addUsingAlias(EpisodeTableMap::COL_SERIAL_ID, $serialId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EpisodeTableMap::COL_SERIAL_ID, $serialId, $comparison);
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
     * @return $this|ChildEpisodeQuery The current query, for fluid interface
     */
    public function filterBySourceId($sourceId = null, $comparison = null)
    {
        if (is_array($sourceId)) {
            $useMinMax = false;
            if (isset($sourceId['min'])) {
                $this->addUsingAlias(EpisodeTableMap::COL_SOURCE_ID, $sourceId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sourceId['max'])) {
                $this->addUsingAlias(EpisodeTableMap::COL_SOURCE_ID, $sourceId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EpisodeTableMap::COL_SOURCE_ID, $sourceId, $comparison);
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
     * @return $this|ChildEpisodeQuery The current query, for fluid interface
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

        return $this->addUsingAlias(EpisodeTableMap::COL_SEASON, $season, $comparison);
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
     * @return $this|ChildEpisodeQuery The current query, for fluid interface
     */
    public function filterByNumber($number = null, $comparison = null)
    {
        if (is_array($number)) {
            $useMinMax = false;
            if (isset($number['min'])) {
                $this->addUsingAlias(EpisodeTableMap::COL_NUMBER, $number['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($number['max'])) {
                $this->addUsingAlias(EpisodeTableMap::COL_NUMBER, $number['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EpisodeTableMap::COL_NUMBER, $number, $comparison);
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
     * @return $this|ChildEpisodeQuery The current query, for fluid interface
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

        return $this->addUsingAlias(EpisodeTableMap::COL_NAME, $name, $comparison);
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
     * @return $this|ChildEpisodeQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(EpisodeTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(EpisodeTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EpisodeTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildEpisodeQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(EpisodeTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(EpisodeTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EpisodeTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildEpisode $episode Object to remove from the list of results
     *
     * @return $this|ChildEpisodeQuery The current query, for fluid interface
     */
    public function prune($episode = null)
    {
        if ($episode) {
            $this->addUsingAlias(EpisodeTableMap::COL_ID, $episode->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the episode table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EpisodeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EpisodeTableMap::clearInstancePool();
            EpisodeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EpisodeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EpisodeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EpisodeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EpisodeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildEpisodeQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(EpisodeTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildEpisodeQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(EpisodeTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildEpisodeQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(EpisodeTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildEpisodeQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(EpisodeTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildEpisodeQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(EpisodeTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildEpisodeQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(EpisodeTableMap::COL_CREATED_AT);
    }

} // EpisodeQuery
