<?php

namespace App\Repositories;

use App\Entities\Log;

class LogRepository extends RepositoryAbstract
{

    /**
     * LogRepository constructor.
     * @param Log $log
     */
    public function __construct(Log $log)
    {
        $this->setModel($log);
    }

    /**
     * Scope search with parameters
     *
     * @param array $params
     * @return mixed
     */
    public function scopeSearch($params = [])
    {
        $query = $this->getModel();

        if (array_key_exists('action', $params) && !empty($params['action'])) {
            $query = $query->where('action', $params['action']);
        }

        return $query;
    }

    /**
     * Search data by parameters
     *
     * @param array $params
     * @return mixed
     */
    public function search($params = [])
    {
        return $this->scopeSearch($params)
            ->latest()
            ->paginate($this->model->getPerPage());
    }

}
