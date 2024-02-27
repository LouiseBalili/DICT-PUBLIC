<?php

namespace App\Models;

use App\Models\User;
use App\Models\Property;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'id_no',
        'fname',
        'mname',
        'lname',
        'emp_type',
        'address',
        'status',
        'profile_photo_path',
    ];

    protected $appends = [ 'profile_photo_path_url' ];

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function getProfilePhotoPathUrlAttribute()
    {
        // $url = $this->itemphoto ? asset("images/item_images/" . $this->itemphoto) : "https://512pixels.net/downloads/macos-wallpapers-thumbs/10-14-Night-Thumb.jpg";
        return $this->profile_photo_path ? asset('images/profile_pictures/' . $this->profile_photo_path) : null;
    }

    public function receivedProperties()
    {
        return $this->hasMany(Property::class, 'received_from');
    }

    public function assignedProperties()
    {
        return $this->hasMany(Property::class, 'assigned_to');
    }
}
