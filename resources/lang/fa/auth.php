<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */
    'back_to_site' => 'بازگشت به سایت',
    'failed' => 'اطلاعات ورود شما در سیستم ما موجود نیست!',
    'throttle' => 'تعداد تلاشهای ورود ناموفق شما بیش از حد مجاز بوده. تا :minutes دقیقه دیگر امکان ورود برای شما وجود ندارد.',
    'otp_not_found' => 'کد شناسایی وارد شده موجود نیست. لطفا دوباره درخواست کد بدهید',
    'invalid_otp' => 'کد شناسایی وارد شده صحیح نیست',
    'user_not_found' => 'کاربر مورد نظر پیدا نشد!',
    'user_is_locked' => 'کاربر مورد نظر مسدود است',
     'password_updated' => 'کلمه عبور شما با موفقیت بروزرسانی شد',

    'otp' => [
        'your_sms_otp' => 'کد شناسایی شما: :token',
        'sms_otp_sent' => 'کد شناسایی به شماره موبایل :mobile ارسال شد',
        'email_otp_sent' => 'کد شناسایی به آدرس ایمیل :email ارسال شد',
        'too_many_otp_try' => 'تعداد دفعات مجاز شما برای دریافت کد شناسایی در یک ۲۴ ساعت به پایان رسیده. لطفا بعدا دوباره امتحان کنید',
        'otp_gap' => 'بین هر دو درخواست پیاپی دریافت توکن شما باید حداقل :seconds ثانیه فاصله باشد. لطفا بعدا دوباره امتحان کنید',
        'opt_send_err' => 'متاسفانه هنگام ارسال کد یک خطای ناشناخته پیش آمد. لطفا بعدا دوباره امتحان کنید.',
        'ip_limit_exceeded' => 'تعداد درخواستهای روزانه آدرس IP شما بیش از حد مجاز است. لطفا با پشتیبانی تماس بگیرید',
        'user_email_already_proofed' => 'آدرس ایمیل مورد نظر شما هم اکنون در سیستم تایید شده است',
        'user_mobile_already_proofed' => 'موبایل مورد نظر شما هم اکنون در سیستم تایید شده است',
    ],
    'signup' => [
        'dup_conf_mobile' => 'شماره موبابل وارد شده قبلا در سیستم ثبت و تایید شده',
        'signedup_succ' => 'ثبت نام شما با موفقیت انجام شد',
    ],
    'signin' => [
        'failed_tye_exceeded' => 'تعداد دفعات مجاز شما برای ورود ناموفق به پایان رسیده. لطفا یک ساعت بعد دوباره تلاش کنید',
    ],
    'proof' => [
        'type' => [
            1 => 'موبایل',
            2 => 'ایمیل',
            4 => 'تلفن',
            8 => 'اقامت',
            16 => 'هویت',
            32 => 'شخصیت حقوقی',
        ],
        'status' => [
            'pending' => 'منتظر بررسی',
            'rejected' => 'رد شده',
            'confirmed' => 'تایید شده',
            'canceled' => 'کنسل شده',
        ],
        'type_proved_before' => 'اطلاعات شما قبلا تایید شده و نیازی به آپلود مدارک ندارید',
        'proof_data_is_empty' => 'آیتمی که میخواهید تایید کنید در پروفایل شما مقدار خالی دارد',
    ],
    'signout_succ' => 'شما با موفقیت از سیستم خارج شدید',
];
