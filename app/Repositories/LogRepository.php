<?php

namespace App\Repositories;

use App\Entities\Log;

class LogRepository
{

    /**
     * @return mixed
     */
    public function search()
    {
        // return Log::actionType()->latest()->paginate();
        return Log::latest()->paginate();
    }

}
