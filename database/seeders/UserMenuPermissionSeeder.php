<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserMenuPermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $userMenuKeys = [
            'dashboard',
            'documents',
            'ext_chat_bot',
            'ext_voice_chatbot',
            'ext_phone_call_agent',
            'ext_social_media_automation',
            'ai_agent',
            'ext_fashion_studio_dropdown',
            'ext_ai_photo_studio_dropdown',
            'ugc_factory',
            'ext_social_media_dropdown',
            'ai_influencer',
            'url_to_video',
            'viral_clips',
            'influencer_avatar',
            'ai_editor',
            'ai_writer',
            'ai_video',
            'ai_image_generator',
            'seo_tool_extension',
            'ai_voiceover',
            'ai_pdf',
            'ai_vision',
            'ai_speech_to_text',
            'ai_video_to_video',
            'ai_article_wizard',
            'ai_realtime_voice_chat',
            'ai_realtime_image',
            'ai_rewriter',
            'ai_chat_image',
            'ai_chat_all',
            'ai_chat_pro',
            'ai_image_pro',
            'ai_chat_pro_image_chat',
            'video_dubbing',
            'ai_captions',
            'ai_music',
            'ext_ai_music_pro',
            'ai_presentation',
            'ai_code_generator',
            'ai_youtube',
            'ai_rss',
            'ai_voice_isolator',
            'ai_voiceover_clone',
            'video_studio',
            'ai_video_pro',
            'photo_studio_extension',
            'ai_web_chat_extension',
            'ai_plagiarism_extension',
            'ai_detector_extension',
            'brand_voice',
            'advanced_image',
            'ai_avatar',
            'ai_persona',
            'ai_product_shot',
            'affiliates',
            'support',
            'integration',
            'links',
            'favorites',
            'workbook',
            'api_keys',
            'creative_suite',
            'creative_suite_annotations',
            'ai_chat_pro_image',
            'ext_chat_bot_agent',
        ];

        $role = Role::firstOrCreate(['name' => 'user']);

        foreach ($userMenuKeys as $key) {
            $permission = Permission::firstOrCreate(['name' => $key]);
            $role->givePermissionTo($permission);
        }
    }
}
