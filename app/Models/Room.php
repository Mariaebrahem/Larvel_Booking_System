<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['room_number', 'room_type_id', 'hotel_id' ,'price_per_night'];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
    public function amenities()
    {
        return $this->belongsToMany(Amenity::class);
    }
    public function images()
    {
        return $this->hasMany(RoomImage::class);
    }
}
