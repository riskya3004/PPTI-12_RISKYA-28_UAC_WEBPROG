<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\DB

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function hobbies()
    {
        return $this->belongsToMany(Hobby::class);
    }

    public function getHobbiesStringAttribute()
    {
        return $this->hobbies->implode('name', ', ');
    }

    public function scopeSearchByHobbyOrFieldOfWork($query, $searchKeyword)
    {
        return $query->where(function ($query) use ($searchKeyword) {
            $query->whereHas('hobbies', function ($query) use ($searchKeyword) {
                $query->where('name', 'like', "%{$searchKeyword}%");
            })
            ->orWhere('field_of_work', 'like', "%{$searchKeyword}%");
        });
    }

    public function fieldOfWork()
    {
        return $this->belongsTo(FieldOfWork::class, 'field_of_work', 'name');
    }

    public function sentAvatarSubmissions()
    {
        return $this->hasMany(AvatarSubmission::class, 'sender_id');
    }

    public function receivedAvatarSubmissions()
    {
        return $this->hasMany(AvatarSubmission::class, 'receiver_id');
    }

    public function setRandomBearPhoto()
    {
        $bearPhotos = ['bear1.jpg', 'bear2.jpg', 'bear3.jpg'];
        $this->bear_photo = Arr::random($bearPhotos);
    }

    public function getBearPhotoUrlAttribute()
{
    if ($this->bear_photo) {
        return asset('path/to/bear/photos/' . $this->bear_photo);
    } else {
        return null; 
    }
}

    



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'hobbies', // Menambahkan field hobbies untuk menyimpan daftar id hobi yang terkait
        'birthdate',
        'gender',
        'mobile_number',
        'instagram_username',
        'profile_photo_path',
        'field_of_work',
        'coins',
        'bear_photo',
        'visible'
    ];


    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}

