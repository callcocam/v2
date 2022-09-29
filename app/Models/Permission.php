<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tall\Models\Auth\Acl\Models\Permission as AbstractPermission;

class Permission extends AbstractPermission
{
    use HasFactory;

    protected $guarded = ['id'];

     /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];
    //protected $table = "table";
}
