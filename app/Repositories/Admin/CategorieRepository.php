<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Categorie;
use App\Repositories\BaseRepository;

/**
 * Class CategorieRepository
 * @package App\Repositories\Admin
 * @version February 14, 2022, 2:48 pm UTC
*/

class CategorieRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Categorie::class;
    }
}
