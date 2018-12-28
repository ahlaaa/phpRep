<?php

namespace App\Repositories;

use App\Models\SystemConfig;

/**
 * Class SystemConfigRepository
 * @package App\Repositories
 * @version March 10, 2018, 11:12 am CST
 *
 * @method SystemConfig findWithoutFail($id, $columns = ['*'])
 * @method SystemConfig find($id, $columns = ['*'])
 * @method SystemConfig first($columns = ['*'])
*/
class SystemConfigRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'img_slide',
        'img_ad',
        'introduce',
        'enterprise_synopsis',
        'enterprise_situation',
        'enterprise_growth',
        'enterprise_coalition',
        'enterprise_address',
        'enterprise_telephone',
        'enterprise_email',
        'qrcode1',
        'qrcode2',
        'updated_user_id',
        'updated_user_name',
        'created_user_id',
        'created_user_name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SystemConfig::class;
    }
}
