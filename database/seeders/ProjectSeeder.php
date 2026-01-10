<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('is_admin', 1)->first();
        if(!$admin){
            $this->command->error('لا يوجد مدير في قاعدة البيانات، يرجى تشغيل AdminSeeder أولا ');
            return;
        }
       $projects = [
            [
                'user_id' => $admin->id,
                'title_ar' => 'منصة "سحاب" للتحول الرقمي',
                'title_en' => 'Sahab Digital Transformation Platform',
                'description_ar' => 'حل سحابي متكامل يهدف إلى أتمتة العمليات الإدارية في الشركات الكبرى لزيادة الإنتاجية وتقليل التكاليف التشغيلية بنسبة 30%.',
                'description_en' => 'An integrated cloud solution aimed at automating administrative processes in large corporations to increase productivity and reduce operational costs by 30%.',
                'image' => 'images/p1.jpg',
            ],
            [
                'user_id' => $admin->id,
                'title_ar' => 'تطبيق "تواصل" للمؤسسات',
                'title_en' => 'Tawasul Enterprise App',
                'description_ar' => 'نظام اتصالات داخلي مشفر يوفر بيئة آمنة لتبادل الملفات وعقد الاجتماعات المرئية عالية الدقة للمؤسسات الحكومية والخاصة.',
                'description_en' => 'An encrypted internal communication system that provides a secure environment for file sharing and high-definition video conferencing for government and private institutions.',
                'image' => 'images/p2.jpg',
            ],
            [
                'user_id' => $admin->id,
                'title_ar' => 'محرك "رؤية" للذكاء الاصطناعي',
                'title_en' => 'Vision AI Engine',
                'description_ar' => 'تطوير خوارزميات تعلم آلي متقدمة لتحليل البيانات الضخمة والتنبؤ بسلوك المستهلكين بدقة تصل إلى 95%، مما يدعم اتخاذ القرار الاستراتيجي.',
                'description_en' => 'Developing advanced machine learning algorithms to analyze big data and predict consumer behavior with 95% accuracy, supporting strategic decision-making.',
                'image' => 'images/p3.jpg',
            ],
            [
                'user_id' => $admin->id,
                'title_ar' => 'بوابة "أمان" للأمن السيبراني',
                'title_en' => 'Aman Cybersecurity Gateway',
                'description_ar' => 'تصميم وبناء درع حماية متطور لمراكز البيانات ضد الهجمات السيبرانية المتقدمة، مع نظام مراقبة استباقي يعمل على مدار الساعة.',
                'description_en' => 'Designing and building an advanced protective shield for data centers against sophisticated cyberattacks, featuring a 24/7 proactive monitoring system.',
                'image' => 'images/p4.jpg',
            ],
            [
                'user_id' => $admin->id,
                'title_ar' => 'منصة "مدى" للتجارة الإلكترونية',
                'title_en' => 'Mada E-commerce Platform',
                'description_ar' => 'بناء متجر إلكتروني ضخم يدعم تعدد البائعين مع أنظمة دفع دولية متكاملة وتجربة مستخدم سلسة تدعم جميع اللغات والعملات.',
                'description_en' => 'Building a large multi-vendor e-commerce store with integrated international payment systems and a seamless user experience supporting all languages and currencies.',
                'image' => 'images/p5.jpg',
            ],
            [
                'user_id' => $admin->id,
                'title_ar' => 'نظام "إدارة" السحابي للموارد',
                'title_en' => 'Edara Cloud ERP System',
                'description_ar' => 'نظام تخطيط موارد المؤسسات (ERP) يجمع بين المحاسبة، الموارد البشرية، وإدارة المخازن في واجهة واحدة سهلة الاستخدام.',
                'description_en' => 'An Enterprise Resource Planning (ERP) system that combines accounting, HR, and inventory management in a single, user-friendly interface.',
                'image' => 'images/p6.jpg',
            ],
            [
                'user_id' => $admin->id,
                'title_ar' => 'تطبيق "صحة" للاستشارات الطبية',
                'title_en' => 'Seha Telemedicine App',
                'description_ar' => 'منصة رقمية تربط المرضى بنخبة من الأطباء حول العالم، مع ميزات التشخيص الأولي المدعوم بالذكاء الاصطناعي والملفات الطبية الإلكترونية.',
                'description_en' => 'A digital platform connecting patients with top doctors worldwide, featuring AI-powered preliminary diagnosis and electronic medical records.',
                'image' => 'images/p7.jpg',
            ],
            [
                'user_id' => $admin->id,
                'title_ar' => 'مشروع "المدينة الذكية"',
                'title_en' => 'Smart City Project',
                'description_ar' => 'تطوير أنظمة إنارة وإدارة نفايات ذكية تعتمد على تقنيات إنترنت الأشياء (IoT) لترشيد استهلاك الطاقة بنسبة 40% وتحسين جودة الحياة.',
                'description_en' => 'Developing smart lighting and waste management systems based on IoT technologies to reduce energy consumption by 40% and improve quality of life.',
                'image' => 'images/p8.jpg',
            ],
        ];
        foreach($projects as $project){
            Project::create([
                'user_id' => $project['user_id'],
                'title_ar' => $project['title_ar'],
                'title_en' => $project['title_en'],
                'description_ar' => $project['description_ar'],
                'description_en' => $project['description_en'],
                'image' => $project['image'],
                'slug' => Str::slug($project['title_en'] . '-' . Str::random(5))
            ]);
        }
    }
}
