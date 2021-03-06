<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2017-02-27
 * Time: 18:58
 */

namespace PhpComp\LiteCache;

use PhpComp\LiteCache\Traits\BasicRedisAwareTrait;

/**
 * Class RedisClient
 * @package PhpComp\LiteCache
 * All the commands exposed by the client generally have the same signature as
 * described by the Redis documentation, but some of them offer an additional
 * and more friendly interface to ease programming which is described in the
 * following list of methods:
 * @method int    del(array | string $keys)
 * @method string dump($key)
 * @method int    exists($key)
 * @method int    expire($key, $seconds)
 * @method int    expireAt($key, $timestamp)
 * @method array  keys($pattern)
 * @method int    move($key, $db)
 * @method mixed  object($subCommand, $key)
 * @method int    persist($key)
 * @method int    pExpire($key, $milliseconds)
 * @method int    pExpireAt($key, $timestamp)
 * @method int    pTtl($key)
 * @method string randomKey()
 * @method mixed  rename($key, $target)
 * @method int    renameNx($key, $target)
 * @method array  scan($cursor, array $options = null)
 * @method array  sort($key, array $options = null)
 * @method int    ttl($key)
 * @method mixed  type($key)
 * @method int    append($key, $value)
 * @method int    bitCount($key, $start = null, $end = null)
 * @method int    bitOp($operation, $retKey, ...$keys)
 * @method array  bitField($key, $subCommand, ...$subCommandArg)
 * @method int    decr($key)
 * @method int    decrBy($key, $decrement)
 * @method string get($key)
 * @method int    getBit($key, $offset)
 * @method string getRange($key, $start, $end)
 * @method string getSet($key, $value)
 * @method int    incr($key)
 * @method int    incrBy($key, $increment)
 * @method string incrByFloat($key, $increment)
 * @method array  mGet(array $keys)
 * @method mixed  mSet(array $dictionary)
 * @method int    mSetNx(array $dictionary)
 * @method mixed  pSetEx($key, $milliseconds, $value)
 * @method mixed  //set($key, $value, $expireResolution = null, $expireTTL = null, $flag = null)
 * @method mixed  set($key, $value, $timeout = 0)
 * @method int    setBit($key, $offset, $value)
 * @method int    setEx($key, $seconds, $value)
 * @method int    setNx($key, $value)
 * @method int    setRange($key, $offset, $value)
 * @method int    strLen($key)
 * @method int    hDel($key, array $fields)
 * @method int    hExists($key, $field)
 * @method string hGet($key, $field)
 * @method array  hGetAll($key)
 * @method int    hIncrBy($key, $field, $increment)
 * @method string hIncrByFloat($key, $field, $increment)
 * @method array  hKeys($key)
 * @method int    hLen($key)
 * @method array  hMGet($key, array $fields)
 * @method mixed  hMSet($key, array $dictionary)
 * @method array  hScan($key, $cursor, array $options = null)
 * @method int    hSet($key, $field, $value)
 * @method int    hSetNx($key, $field, $value)
 * @method array  hVals($key)
 * @method int    hStrLen($key, $field)
 * @method array  bLPop(array $keys, $timeout)
 * @method array  bRPop(array $keys, $timeout)
 * @method array  bRPopLPush($source, $destination, $timeout)
 * @method string lIndex($key, $index)
 * @method int    lInsert($key, $whence, $pivot, $value)
 * @method int    lLen($key)
 * @method string lPop($key)
 * @method int    lPush($key, array $values)
 * @method int    lPushX($key, $value)
 * @method array  lRange($key, $start, $stop)
 * @method int    lRem($key, $count, $value)
 * @method mixed  lSet($key, $index, $value)
 * @method mixed  lTrim($key, $start, $stop)
 * @method string rPop($key)
 * @method string rPopLPush($source, $destination)
 * @method int    rPush($key, array $values)
 * @method int    rPushX($key, $value)
 * @method int    sAdd($key, array $members)
 * @method int    sCard($key)
 * @method array  sDiff(array $keys)
 * @method int    sDiffStore($destination, array $keys)
 * @method array  sInter(array $keys)
 * @method int    sInterStore($destination, array $keys)
 * @method int    sIsMember($key, $member)
 * @method array  sMembers($key)
 * @method int    sMove($source, $destination, $member)
 * @method string sPop($key, $count = null)
 * @method string sRandMember($key, $count = null)
 * @method int    sRem($key, $member)
 * @method array  sScan($key, $cursor, array $options = null)
 * @method array  sUnion(array $keys)
 * @method int    sUnionStore($destination, array $keys)
 * method int    zAdd($key, array $membersAndScoresDictionary)
 * @method int    zAdd($key, int $sScore, string $member)
 * @method int    zCard($key)
 * @method string zCount($key, $min, $max)
 * @method string zIncrBy($key, $increment, $member)
 * @method int    zInterStore($destination, array $keys, array $options = null)
 * @method array  zRange($key, $start, $end, $withScores = null)
 * @method array  zRangeByScore($key, $start, $end, array $options = array())
 * @method int    zRank($key, $member)
 * @method int    zRem($key, $member)
 * @method int    zRemRangeByRank($key, $start, $stop)
 * @method int    zRemRangeByScore($key, $min, $max)
 * @method array  zRevRange($key, $start, $end, $withScores = null)
 * @method array  zRevRangeByScore($key, $start, $end, array $options = array())
 * @method int    zRevRank($key, $member)
 * @method int    zUnionStore($destination, array $keys, array $options = null)
 * @method string zScore($key, $member)
 * @method array  zScan($key, $cursor, array $options = null)
 * @method array  zRangeByLex($key, $start, $stop, array $options = null)
 * @method array  zRevRangeByLex($key, $start, $stop, array $options = null)
 * @method int    zRemRangeByLex($key, $min, $max)
 * @method int    zLexCount($key, $min, $max)
 * @method int    pfAdd($key, array $elements)
 * @method mixed  pfMerge($destinationKey, array $sourceKeys)
 * @method int    pfCount(array $keys)
 * @method mixed  pubSub($subCommand, $argument)
 * @method int    publish($channel, $message)
 * @method mixed  discard()
 * @method array  exec()
 * @method mixed  multi()
 * @method mixed  unwatch()
 * @method mixed  watch($key)
 * @method mixed  eval($script, $numKeys, $keyOrArg1 = null, $keyOrArgN = null)
 * @method mixed  evalSha($script, $numKeys, $keyOrArg1 = null, $keyOrArgN = null)
 * @method mixed  script($subCommand, $argument = null)
 * @method mixed  auth($password)
 * @method string echo ($message)
 * @method mixed  ping($message = null)
 * @method mixed  select($database)
 * @method mixed  bgRewriteAOF()
 * @method mixed  bgSave()
 * @method mixed  client($subCommand, $argument = null)
 * @method mixed  config($subCommand, $argument = null)
 * @method int    dbSize()
 * @method mixed  flushAll()
 * @method mixed  flushDb()
 * @method array  info($section = null)
 * @method int    lastSave()
 * @method mixed  save()
 * @method mixed  slaveOf($host, $port)
 * @method mixed  slowLog($subCommand, $argument = null)
 * @method array  time()
 * @method array  command()
 * @method int    geoAdd($key, $longitude, $latitude, $member)
 * @method array  geoHash($key, array $members)
 * @method array  geoPos($key, array $members)
 * @method string geoDist($key, $member1, $member2, $unit = null)
 * @method array  geoRadius($key, $longitude, $latitude, $radius, $unit, array $options = null)
 * @method array  geoRadiusByMember($key, $member, $radius, $unit, array $options = null)
 */
class LiteRedis
{
    use BasicRedisAwareTrait;

    // ARGS: ($name, $mode, $config)
    const CONNECT = 'redis.connect';
    // ARGS: ($name, $mode)
    const DISCONNECT = 'redis.disconnect';
    // ARGS: ($method, array $args)
    const BEFORE_EXECUTE = 'redis.beforeExecute';
    // ARGS: ($method, array $data)
    const AFTER_EXECUTE = 'redis.afterExecute';

    protected function onConnect(): void
    {
        $this->fire(self::CONNECT, [$this]);
    }

    protected function onDisconnect(): void
    {
        $this->fire(self::DISCONNECT, [$this]);
    }

    protected function onBeforeExecute($method, $args): void
    {
        $this->fire(self::BEFORE_EXECUTE, [$method, $args]);
    }

    protected function onAfterExecute($method, $args, $ret): void
    {
        $this->fire(self::AFTER_EXECUTE, [$method, $args, $ret]);
    }

    /**
     * redis 中 key 是否存在
     * @param string $key
     * @return bool
     */
    public function hasKey($key): bool
    {
        return (bool)$this->exists($key);
    }

    /**************************************************************************
     * data relation map(set - 无序集合)
     **************************************************************************/

    /**
     * 获取集合的全部数据
     * @param string $key
     * @return array
     */
    public function getSetList(string $key): array
    {
        return $this->sMembers($key);
    }

    /**
     * 集合是否存在
     * @param $key
     * @return bool
     */
    public function hasSet(string $key): bool
    {
        return $this->sCard($key) > 0;
    }

    /**
     * 集合是否存在元素 $member
     * @param $key
     * @param $member
     * @return bool
     */
    public function isInSet(string $key, $member): bool
    {
        return $this->sIsMember($key, $member);
    }

    /**************************************************************************
     * data relation map(zset - 有序集合)
     **************************************************************************/

    /**
     * 有序集合是否存在
     * @param string $key
     * @return bool
     */
    public function hasZSet(string $key): bool
    {
        return $this->hasKey($key) && $this->zCard($key) > 0;
    }

    /**
     * 有序集合是否存在元素
     * @param string $key
     * @param $member
     * @return bool
     */
    public function isInZSet(string $key, $member): bool
    {
        return $this->zScore($key, $member) !== false;
    }

    /**
     * 将一个或多个 member 元素及其 score 值加入到有序集 key 当中
     * @param string $key redis key
     * @param int|array 为 integer 时 $targetId, 要结合 $score.
     *                  为 array 时，一次添加多个
     * e.g:
     * 1. add one
     *  ($key, $member, $score)
     * 2. add multi
     * [
     *   // 成员 member是唯一的
     *  'member1' => score1,
     *  'member2' => score2,
     * ]
     * @param null|int $score
     * @return int
     */
    public function addToZSet(string $key, $member, $score = null): int
    {
        if (!$key) {
            return 0;
        }

        if (\is_array($member)) {
            $rds = $this->multi();
            foreach ($member as $m => $s) {
                $rds->zAdd($key, $s, (string)$m);
            }
            /** @var array $result */
            $result = (array)$rds->exec();

            return \array_sum($result);
        }

        $score = \is_numeric($score) ? (int)$score : time();

        return $this->zAdd($key, $score, $member);
    }

    /**
     * @param array|\Iterator $data
     * e.g:
     *  [
     *      [score, member],
     *      [score1, member1],
     *      ...
     *  ]
     * @param $key
     * @param callable $scoreMemberHandler
     * @return int
     */
    public function addDataListToZSet(string $key, $data, callable $scoreMemberHandler): int
    {
        if (!$data || !$key) {
            return 0;
        }

        $rds = $this->multi();

        foreach ($data as $row) {
            list($score, $member) = $scoreMemberHandler($row);
            $rds->zAdd($key, $score, (string)$member);
        }

        $result = (array)$rds->exec();

        return \array_sum($result);
    }

    /**
     * 获取有序集合的数据列表
     *  按 score 值递增(从小到大)来排序。
     * @param $key
     * @param int $start
     * @param int $stop
     * @param bool $withScore
     * @return array
     */
    public function getZSetList($key, $start = 0, $stop = -1, $withScore = null): array
    {
        return $this->zRange($key, $start, $stop, $withScore);
    }

    /**
     * 获取有序集合的数据列表
     *  按 score 值递减(从大到小)来排列
     * @param $key
     * @param int $start
     * @param int $stop
     * @param bool $withScore
     * @return array
     */
    public function getRevZSetList($key, $start = 0, $stop = -1, $withScore = null): array
    {
        return $this->zRevRange($key, $start, $stop, $withScore);
    }

    /**************************************************************************
     * data list (list - 列表)
     **************************************************************************/

    /**
     * @param $key
     * @return bool
     */
    public function hasList(string $key): bool
    {
        return $this->hasKey($key) && $this->lLen($key);
    }

    /**
     * @param string $key
     * @param $element
     * @return int
     */
    public function addToList(string $key, $element): int
    {
        return $this->setList($key, $element);
    }

    /**
     * 获取列表数据
     *  默认取出全部
     * @param string $key
     * @param int $start 起始位置
     * @param int $stop 结束位置
     * @return array
     */
    public function getList(string $key, int $start = 0, int $stop = -1): array
    {
        // list:magazine:100:images 12 13 14
        return $this->lRange($key, $start, $stop);
    }

    /**
     * 设置列表数据
     * @param string $key
     * @param array $elements
     * @return int
     */
    public function setList(string $key, $elements): int
    {
        // list:magazine:100:images 12 13 14
        $int = 0;

        foreach ((array)$elements as $item) {
            $int = $this->rPush($key, $item);
        }

        return $int;
    }

    /**************************************************************************
     * data table (hash table - 哈希表)
     **************************************************************************/

    /**
     * @param string $key
     * @return bool
     */
    public function hasHTable(string $key): bool
    {
        return $this->hasKey($key) && $this->hLen($key) > 0;
    }

    /**
     * check hash table is empty or is not exists.
     * @param $key
     * @return bool
     */
    public function isEmptyHTable(string $key): bool
    {
        return 0 === $this->hLen($key);
    }

    /**
     * @param $key
     * @param $field
     * @return bool
     */
    public function isInHTable($key, $field): bool
    {
        return $this->hExists($key, $field);
    }

    /**
     * @param $key
     * @param $field
     * @param int $step
     * @return int
     */
    public function htIncrField(string $key, $field, int $step = 1): int
    {
        return $this->hIncrBy($key, $field, $step);
    }

    /**
     * @param string $key
     * @param string $field 计数field
     * @param int $step
     * @param bool $zeroLimit 最小为零限制 限制最小可以自减到 0
     * @return int
     */
    public function htDecrField(string $key, $field, int $step = 1, $zeroLimit = true): int
    {
        // fix: not allow lt 0
        if ($zeroLimit && ((int)$this->hGet($key, $field) <= 0)) {
            return 0;
        }

        return $this->hIncrBy($key, $field, -$step);
    }

    /**
     * 通过默认值来初始化一个 hash table
     * @param $key
     * @param array $fields
     * @param int $default
     * @return mixed
     */
    public function htInitByDefault(string $key, array $fields, $default = 0)
    {
        $data = \array_fill_keys($fields, $default);

        return $this->hMSet($key, $data);
    }

    /**
     * 获取hash table指定的一些字段的信息
     * @param string $key
     * @param array $fields
     * @param bool $valToInt 将所有的值转成int,在将hash table做为计数器时有用
     * @return array
     */
    public function htGetMulti(string $key, array $fields, $valToInt = false): array
    {
        $data = $this->hMGet($key, $fields);

        // if ($data && class_exists('\\Predis\\Client') && is_subclass_of($this->_redis, '\\Predis\\ClientInterface')) {
        //     $data = array_combine($fields, $data);
        // }

        if ($valToInt) {
            \array_walk($data, function (&$val) {
                $val = (int)$val;
            });
        }

        return $data;
    }

    /**
     * @param $key
     * @param bool $valToInt
     * @return array
     */
    public function htGetAll(string $key, $valToInt = false): array
    {
        $data = $this->hGetAll($key);

        if ($valToInt) {
            \array_walk($data, function (&$val) {
                $val = (int)$val;
            });
        }

        return $data;
    }

    /**************************************************************************
     * cache
     *************************************************************************/

    /**
     * 添加缓存 - key 不存在时才会添加
     * @param $key
     * @param string|array $value
     * @param int $seconds
     * @return int
     */
    public function addCache(string $key, $value, $seconds = 3600): int
    {
        $key = $this->getCacheKey($key);

        // return $this->set($key, serialize($value), 'EX', $seconds, 'NX');
        return $this->exists($key) ? 0 : $this->setCache($key, $value, $seconds);
    }

    /**
     * 设置缓存 - key 存在会直接覆盖原来的值，不存在即是添加
     * @param $key
     * @param $seconds
     * @param string|array $value 要存储的数据 可以是字符串或者数组
     * @return int
     */
    public function setCache(string $key, $value, $seconds = 3600): int
    {
        $key = $this->getCacheKey($key);

        // return $this->set($key, serialize($value), 'EX', $seconds);
        return $this->setEx($key, $seconds, \serialize($value));
    }

    /**
     * @param string $key
     * @param null $default
     * @return string
     */
    public function getCache(string $key, $default = null): string
    {
        $key = $this->getCacheKey($key);

        return ($data = $this->get($key)) ? \unserialize($data, ['allowed_classes' => false]) : $default;
    }

    /**
     * @param $key
     * @return int
     */
    public function hasCache(string $key): int
    {
        return $this->exists($this->getCacheKey($key));
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function delCache(string $key)
    {
        $key = $this->getCacheKey($key);
        $data = $this->get($key);
        $this->del($key);

        return $data;
    }

    /**
     * @param $key
     * @return string
     */
    public function getCacheKey(string $key): string
    {
        return $this->config['prefix'] . $key;
    }

    /**************************************************************************
     * getter/setter
     *************************************************************************/

    /**
     * @param null|string $section
     * Allow:
     * SERVER | CLIENTS | MEMORY | PERSISTENCE | STATS | REPLICATION | CPU | CLASTER | KEYSPACE | COMANDSTATS
     * @return array
     */
    public function getStats(string $section = null): array
    {
        // used_memory
        return $this->info($section);
    }
}
