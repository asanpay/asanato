<?php

namespace App\Containers\Profile\Models;

use App\Containers\User\Models\User;
use App\Ship\Parents\Models\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class UserVerification extends Model implements HasMedia
{
  use InteractsWithMedia;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'verification_type',
    'code',
    'value',
    'status',
    'user_id',
  ];
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'user_verifications';

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function user()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  /**
   * Scope a query to only include current user verification requests.
   *
   * @param \Illuminate\Database\Eloquent\Builder $query
   *
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeMine($query)
  {
    return $query->where('user_id', Auth::id());
  }
}
