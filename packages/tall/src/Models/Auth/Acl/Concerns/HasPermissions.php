<?php
/**
 * Created by Bengs.
 * User: contato@bengs.com.br
 * https://www.bengs.com.br
 */
namespace Tall\Models\Auth\Acl\Concerns;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Arr;
use Tall\Models\Auth\Acl\Exceptions\PermissionNotFoundException;
use App\Models\Permission;

trait HasPermissions
{

    public function getKeyField()
    {
        return config('tall.key', 'id');
    }
    /**
     * Users can have many permissions
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function permissions(): BelongsToMany
    {

        return $this->belongsToMany(config('tall.models.permission'));
    }

    /**
     * The mothergoose check. Runs through each scenario provided
     * by Shinobi - checking for special flags, role permissions, and
     * individual user permissions; in that order.
     *
     * @param  Permission|String  $permission
     * @return boolean
     */
    public function hasPermissionTo($permission): bool
    {

        // Check role flags
        if ((method_exists($this, 'hasPermissionRoleFlags') and $this->hasPermissionRoleFlags())) {
            return $this->hasPermissionThroughRoleFlag();
        }

        if ((method_exists($this, 'hasPermissionFlags') and $this->hasPermissionFlags())) {
            return $this->hasPermissionThroughFlag();
        }

        // Fetch permission if we pass through a string
        if (is_string($permission)) {
            $permission = $this->getPermissionModel()->where($this->getKeyField(), $permission)->first();

            if (! $permission) {
                throw new PermissionNotFoundException;
            }
        }

        // Check role permissions
        if (method_exists($this, 'hasPermissionThroughRole') and $this->hasPermissionThroughRole($permission)) {
            return true;
        }

        // Check user permission
        if ($this->hasPermission($permission)) {
            return true;
        }

        return false;
    }

    /**
     * Give the specified permissions to the model.
     *
     * @param  array  $permissions
     * @return self
     */
    public function givePermissionTo(...$permissions): self
    {
        $permissions = Arr::flatten($permissions);
        $permissions = $this->getPermissions($permissions);

        if (! $permissions) {
            return $this;
        }

        $this->permissions()->syncWithoutDetaching($permissions);

        return $this;
    }

    /**
     * Revoke the specified permissions from the model.
     *
     * @param  array  $permissions
     * @return self
     */
    public function revokePermissionTo(...$permissions): self
    {
        $permissions = Arr::flatten($permissions);
        $permissions = $this->getPermissions($permissions);

        $this->permissions()->detach($permissions);

        return $this;
    }

    /**
     * Sync the specified permissions against the model.
     *
     * @param  array  $permissions
     * @return self
     */
    public function syncPermissions(...$permissions): self
    {
        $permissions = Arr::flatten($permissions);
        $permissions = $this->getPermissions($permissions);

        $this->permissions()->sync($permissions);

        return $this;
    }

    /**
     * Get the specified permissions.
     *
     * @param  array  $permissions
     * @return Permission
     */
    protected function getPermissions(array $collection)
    {
        return array_map(function($permission) {
            $model = $this->getPermissionModel();

            if ($permission instanceof Permission) {
                return $permission->id;
            }

            $permission = $model->where($this->getKeyField(), $permission)->first();

            return $permission->id;
        }, $collection);
    }

    /**
     * Checks if the user has the given permission assigned.
     *
     * @param  Permission  $permission
     * @return boolean
     */
    protected function hasPermission($permission): bool
    {
        $model = $this->getPermissionModel();

        if ($permission instanceof Permission) {
            $permission = $permission->slug;
        }

        return (bool) $this->permissions->where($this->getKeyField(), $permission)->count();
    }

    /**
     * Get the model instance responsible for permissions.
     *
     * @return \Tall\Acl\Models\Auth\Acl\Contracts\Permission|\Illuminate\Database\Eloquent\Collection
     */
    protected function getPermissionModel()
    {
        if (config('tall.cache.enabled')) {
            return cache()->tags(config('tall.cache.tag'))->remember(
                'permissions',
                config('tall.cache.length'),
                function() {
                    return app()->make(config('tall.models.permission'))->get();
                }
            );
        }

        return app()->make(config('tall.models.permission'));
    }
}
