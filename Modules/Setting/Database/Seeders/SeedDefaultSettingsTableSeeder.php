<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Setting\Entities\Setting;

class SeedDefaultSettingsTableSeeder extends Seeder
{
    protected array $settings = [
        //general
        [
            'type' => 'text',
            'title' => 'نام سایت',
            'key' => 'site_name',
            'value' => 'شاگو',
        ],
        [
            'type' => 'text',
            'title' => 'توضیحات سایت',
            'key' => 'site_description',
            'value' => 'شاگو، همراه هوشمند تو',
        ],

        //seo
        [
            'type' => 'text',
            'title' => 'عنوان سئو سایت',
            'key' => 'seo_meta_title',
            'value' => 'شاگو، راهنمای تو',
        ],
        [
            'type' => 'textarea',
            'title' => 'توضیحات سئو سایت',
            'key' => 'seo_meta_description',
            'value' => 'شاگو، همراه هوشمند تو',
        ],
        [
            'type' => 'textarea',
            'title' => 'کلیدواژه سئو سایت',
            'key' => 'seo_meta_keywords',
            'value' => 'موتور جستجوی کالا,شاگو',
        ],

        // social
        [
            'type' => 'text',
            'title' => 'نام کاربری فیسبوک',
            'key' => 'social_facebook',
            'value' => 'shagocom',
        ],
        [
            'type' => 'text',
            'title' => 'نام کاربری توییتر',
            'key' => 'social_twitter',
            'value' => 'shago',
        ],
        [
            'type' => 'text',
            'title' => 'نام کاربری اینستاگرام',
            'key' => 'social_instagram',
            'value' => 'shago',
        ],
        [
            'type' => 'text',
            'title' => 'نام کاربری لینکدین',
            'key' => '',
            'value' => '/company/shago',
        ],
        [
            'type' => 'text',
            'title' => 'نام کاربری تلگرام',
            'key' => 'social_telegram',
            'value' => 'shago',
        ],
        [
            'type' => 'text',
            'title' => 'نام کاربری آپارات',
            'key' => 'social_aparat',
            'value' => 'shago',
        ],
        [
            'type' => 'text',
            'title' => 'نام کاربری یوتیوب',
            'key' => 'social_youtube',
            'value' => 'shago',
        ],
        [
            'type' => 'text',
            'title' => 'شماره واتساپ بدون صفر',
            'key' => 'social_whatsapp',
            'value' => '9914666329',
        ],

        // Analytics and Apps
        [
            'type' => 'text',
            'title' => 'توکن گوگل آنالیتیکس',
            'key' => 'google_analytics',
            'value' => '',
        ],
        [
            'type' => 'text',
            'title' => 'توکن ابر آروان',
            'key' => 'arvancloud_api',
            'value' => '',
        ],

        //Logo and Icons
        [
            'type' => 'upload_image',
            'title' => 'لوگو سایت',
            'key' => 'site_logo',
            'value' => '/uploads/logo-text.png',
        ],
        [
            'type' => 'upload_image',
            'title' => 'آیکون سایت',
            'key' => 'site_favicon',
            'value' => '/uploads/favicon.png',
        ],

        //footer
        [
            'type' => 'html',
            'title' => 'کد نماد اعتماد الکترونیک',
            'key' => 'enamad_logo',
            'value' => '<img src="/uploads/enamad.png">',
        ],
        [
            'type' => 'html',
            'title' => 'کد نماد ساماندهی',
            'key' => 'samandehi_logo',
            'value' => '<img src="/uploads/samandehi.png">',
        ],
        [
            'type' => 'html',
            'title' => 'کد نماد اتحادیه کسب و کار',
            'key' => 'ecunion_logo',
            'value' => '<img src="/uploads/ecunion.png">',
        ],
        [
            'type' => 'html',
            'title' => 'کد نماد پرداخت',
            'key' => 'payment_logo',
            'value' => '<span id="PPTrust"/><script src="https://cdn.payping.ir/statics/trust-v2.js" theme="dark"></script>',
        ],
        [
            'type' => 'textarea',
            'title' => 'متن کپی رایت پابرگ',
            'key' => 'footer_copyright',
            'value' => 'تمامی حقوق برای شرکت کارآفرینان ماهان سپهر (پلتفرم شاگو) محفوط است',
        ],
        [
            'type' => 'checkbox',
            'title' => 'ارسال پیامک خوش آمد گویی هنگام ثبت نام',
            'key' => 'register_welcome_message',
            'value' => true,
        ],
        [
            'type' => 'textarea',
            'title' => 'متن پیامک خوش آمد گویی',
            'key' => 'register_welcome_message_text',
            'value' => 'به شاگو خوش آمدید',
        ],

        //security
        [
            'key' => 'login_max_attempts',
            'value' => 6,
        ],
        [
            'key' => 'login_decay_minutes ',
            'value' => 1,
        ],

    ];

    public function run()
    {
        Model::unguard();

        foreach ($this->settings as $index => $setting) {
            $result = Setting::create($setting);
            if (!$result) {
                $this->command->info("Insert failed at record $index.");

                return;
            }
        }
        $this->command->info('Inserted ' . count($this->settings) . ' records');
        // $this->call("OthersTableSeeder");
    }
}
