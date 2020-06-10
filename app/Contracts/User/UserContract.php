<?php

namespace App\Contracts\User;

/**
 * Interface AdsContract
 * @package App\Contracts
 */
interface UserContract
{
	/**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */

    /**
     * @param int $id
     * @return mixed
     */
    public function findUserById(int $id);

    public function findUserBy(array $where = []);

    public function findOneUserByOrFail(array $where = []);
}
