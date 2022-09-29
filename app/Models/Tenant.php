<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tall\Models\Tenant as AbstractTenant;
use Tall\Models\Traits\TenantTrait;

class Tenant extends AbstractTenant
{
    use HasFactory, TenantTrait;

    protected $guarded = ['id'];
    
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        //static::$landlord->disable();
    }
    //protected $table = "table";
    /**
   
    * The attributes that should be cast.
    *
    * @var array
    */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];

   
    /**
     * Get the default cover photo URL if no cover photo has been uploaded.
     *
     * @return string
     */
    protected function defaultCoverPhotoUrl()
    {
        return asset('img/logo-white.png');
    }

}