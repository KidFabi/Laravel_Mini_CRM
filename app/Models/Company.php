<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'logo',
        'website'
    ];

    /**
     * The employees that belong to the company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    /**
     * Get the company's logo.
     *
     * @return string
     */
    public function logo()
    {
        if (!empty($this->logo)) {
            return asset('storage/companies/logos/' . $this->logo);
        }

        return "https://via.placeholder.com/100";
    }
}
