<?php

namespace App\Extensions\Chatbot\System\Helpers;

use App\Helpers\Classes\MarketplaceHelper;

class ChatbotHelper
{
    public static function existChannels(): bool
    {
        return MarketplaceHelper::isRegistered('chatbot-telegram') || MarketplaceHelper::isRegistered('chatbot-whatsapp');
    }

    public static function channels()
    {
        //		return [
        //
        //		]
    }

    public static function installedChannelKeys(): array
    {
        $keys = [];
        if (MarketplaceHelper::isRegistered('chatbot-telegram')) {
            $keys[] = 'telegram';
        }
        if (MarketplaceHelper::isRegistered('chatbot-whatsapp')) {
            $keys[] = 'whatsapp';
        }
        return $keys;
    }

    public static function planAllowsHumanAgent(?\App\Models\Plan $plan = null): bool
    {
        if ($plan === null) {
            $plan = auth()->user()?->relationPlan;
        }

        if (! $plan) {
            return false;
        }

        return (bool) $plan->chatbot_human_agent;
    }
}
