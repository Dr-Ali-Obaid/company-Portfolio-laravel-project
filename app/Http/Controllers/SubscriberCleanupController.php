<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SubscriberCleanupController extends Controller
{
    //  تنفيذ أمر تنظيف المشتركين الوهميين من قاعدة البيانات
     
    public function __invoke($token): JsonResponse
    {
        // التحقق من أن التوكن المدخل يطابق القيمة الموجودة في الإعدادات أو استخدام القيمة الافتراضية
        if ($token !== env('CRON_TOKEN', 'default_token97yfr')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        try {
            // استدعاء الأمر التنظيف الذي سبق وتم إنشاؤه 
            Artisan::call('subscribers:clean');
            
            return response()->json([
                'status' => 'success',
                'message' => 'Subscribers cleaned successfully.',
                'details' => Artisan::output()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }
}
