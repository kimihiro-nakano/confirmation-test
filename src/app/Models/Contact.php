<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'first_name', 'last_name', 'gender', 'email', 'tell', 'address', 'building', 'detail'];

    public function getName()
    {
        $name = $this->last_name . " " . $this->first_name;
        return $name;
    }

    protected $appends = ['gender_label'];

    public function getGenderLabelAttribute()
    {
        $genderLabels = [
            1 => '男性',
            2 => '女性',
            3 => 'その他',
        ];
        // return $genderLabels[$this->attributes['gender']];
        // return $genderLabels[$this->gender];
        return $genderLabels[$this->gender] ?? '不明';
    }

    public function scopeSearch($query, $keyword, $exactMatch, $gender, $categoryId, $date)
    {
        return $query->when($keyword, function ($query, $keyword) use ($exactMatch) {
            if ($exactMatch) {
                return $query->where(function ($q) use ($keyword) {
                    $q->where('first_name', 'like', "%{$keyword}%")
                        ->orWhere('last_name', 'like', "%{$keyword}%")
                        ->orWhere('email', 'like', "%{$keyword}%");
                });
            } else {
                return $query->where(function ($q) use ($keyword) {
                    $q->where('first_name', 'like', "%{$keyword}%")
                        ->orWhere('last_name', 'like', "%{$keyword}%")
                        ->orWhere('email', 'like', "%{$keyword}%");
                });
            }
        })
        ->when($gender !== 'all', function ($query) use ($gender) {
            return $query->where('gender', $gender);
        })
        ->when($categoryId, function ($query) use ($categoryId) {
            return $query->where('category_id', $categoryId);
        })
        ->when($date, function ($query) use ($date) {
            return $query->whereDate('created_at', $date);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}


