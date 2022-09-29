<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://www.bengs.com.br
*/
namespace Tall\Tenant\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class ModelNotFoundForTenantException extends ModelNotFoundException implements TenantExceptionInterface
{
    /**
     * @param string    $model
     * @param int|array $ids
     *
     * @return $this
     */
    public function setModel($model, $ids = [])
    {
        $this->model = $model;
        $this->message = "No query results for model [{$model}] when scoped by tenant.";

        return $this;
    }
}
