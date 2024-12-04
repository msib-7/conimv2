<?php

namespace App\Repositories\Eloquent\Osr;

use App\Models\System\OneSheetReport;
use App\Repositories\Osr\ShowDataOsrRepositoryInterface;
use TimWassenburg\RepositoryGenerator\Repository\BaseRepository;

/**
 * Class ShowDataOsrRepository.
 */
class ShowDataOsrRepository
{
    /**
     * UserRepository constructor.
     *
     * @param Osr/ShowDataOsr $model
     */
    public function getById($id)
    {
        return OneSheetReport::query()
            ->with('statusApproval', 'history', 'mesin', 'pemohon')
            ->find($id);
    }
}
