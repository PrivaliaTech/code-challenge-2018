<?php

namespace AppBundle\Domain\Repository;

use AppBundle\Domain\Entity\Contest\Match;

/**
 * Interface to a repository of Match entities
 *
 * @package AppBundle\Domain\Repository
 */
interface MatchRepositoryInterface
{
    /**
     * Reads a match from the database
     *
     * @param string $uuid
     * @return Match
     */
    public function readMarch(string $uuid): Match;

    /**
     * Persists a match in the database
     *
     * @param Match $match
     * @param bool $autoFlush
     * @return MatchRepositoryInterface
     */
    public function persistMatch(Match $match, bool $autoFlush = false): MatchRepositoryInterface;

    /**
     * Removes a match
     *
     * @param mixed $match
     * @return MatchRepositoryInterface
     */
    public function removeMatch($match): MatchRepositoryInterface;
}
