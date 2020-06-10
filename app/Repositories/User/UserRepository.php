<?php
namespace App\Repositories\User;

use App\User;
use App\Contracts\User\UserContract;

use App\Repositories\BaseRepository;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Auth;

/**
 * Class UserRepository
 *
 * @package \App\Repositories
 */
class UserRepository extends BaseRepository implements UserContract
{

    /**
     * UserRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }



     /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findUserById(int $id)
    {
        try {
            return $this->findOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function findUserBy(array $where = [])
    {
        return $this->findBy($where);
    }



    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function findOneUserByOrFail(array $where = [])
    {
        return $this->findOneByOrFail($where);
    }




}
