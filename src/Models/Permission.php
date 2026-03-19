<?php

namespace Systha\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'svc_permissions';

    protected $fillable = [
        'name',
        'actions',
    ];

    /**
     * Get the roles that include this permission.
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'svc_role_permissions', 'permission_id', 'role_id');
    }
}
