<?php

declare(strict_types=1);

namespace App\System\Model;

use Mine\MineModel;

/**
 * @property int $user_id 用户主键
 * @property int $app_role_id 角色主键
 */
class SystemAppPromission extends MineModel
{
    public bool $incrementing = false;
    protected string $primaryKey = 'user_id';
    public bool $timestamps = false;
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'system_app_promission';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['user_id', 'app_role_id'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['user_id' => 'integer', 'app_role_id' => 'integer'];
}
