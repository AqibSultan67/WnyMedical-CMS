<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'parent_id'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($menu) {
            // Generate the slug based on the item's name
            $menu->slug = Str::slug($menu->name);
            // No uniqueness check is needed here
        });

        static::updating(function ($menu) {
            // Generate the slug based on the item's name
            $menu->slug = Str::slug($menu->name);
            // No uniqueness check is needed here
        });
    }

    public function submenus()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }
}
