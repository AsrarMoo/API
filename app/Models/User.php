<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject; // إضافة هذه السطر لاستيراد واجهة JWTSubject

class User extends Authenticatable implements JWTSubject // إضافة الواجهة هنا
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * تعيين المفتاح الرئيسي (Primary Key) ليكون 'user_id' بدلاً من 'id'.
     */
    protected $primaryKey = 'user_id';

    /**
     * تحديد أن المفتاح الرئيسي هو auto-increment.
     */
    public $incrementing = true;

    /**
     * الحقول القابلة للملء.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',        // اسم المستخدم
        'password',    // كلمة المرور
        'user_type',   // نوع المستخدم
        'is_active',   // حالة الحساب
    ];

    /**
     * الحقول المخفية عند التسلسل.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',  // إخفاء كلمة المرور
        'remember_token',
    ];

    /**
     * الحقول التي يجب تحويلها إلى نوع آخر.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * الحصول على المعرف المميز للمستخدم لاستخدامه مع JWT
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey(); // يرجع المفتاح الرئيسي (عادةً user_id)
    }

    /**
     * الحصول على البيانات المخصصة التي سيتم تضمينها في التوكن
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return []; // يمكن إضافة بيانات مخصصة هنا إذا لزم الأمر
    }
}
