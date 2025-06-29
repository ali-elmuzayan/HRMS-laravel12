<?php

namespace App\Models;

use App\Trait\Tenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /** @use HasFactory<\Database\Factories\DepartmentFactory> */
    use HasFactory, Tenantable;

    public function manager()
    {
        return $this->belongsTo(Employee::class, 'manager_id');

    }

    public function parent() {
        return $this->belongsTo(Department::class, 'parent_department_id');
    }

    public function child() {
        return $this->hasMany(Department::class, 'parent_department_id');
    }
}
