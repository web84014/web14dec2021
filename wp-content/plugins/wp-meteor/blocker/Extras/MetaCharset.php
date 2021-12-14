<?php

/**
 * WP_Meteor
 *
 * @package   WP_Meteor
 * @author    Aleksandr Guidrevitch <alex@excitingstartup.com>
 * @copyright 2020 wp-meteor.com
 * @license   GPL 2.0+
 * @link      https://wp-meteor.com
 */

namespace WP_Meteor\Blocker\Extras;

/**
 * Provide Import and Export of the settings of the plugin
 */
class MetaCharset extends \WP_Meteor\Blocker\Base
{
    public $adminPriority = -1;
    public $priority = 100;
    public $defaultEnabled = true;

    public function initialize()
    {
        parent::initialize();
        \add_filter(WPMETEOR_TEXTDOMAIN . '-frontend-rewrite', [$this, 'frontend_rewrite'], $this->priority, 2);
    }

    public function backend_display_settings()
    {
    }

    public function backend_adjust_wpmeteor($wpmeteor, $settings)
    {
        return $wpmeteor;
    }

    public function backend_save_settings($sanitized, $settings)
    {
        return $sanitized;
    }

    /* triggered from wpmeteor_load_settings */
    public function load_settings($settings)
    {
        return $settings;
    }

    public function frontend_adjust_wpmeteor($wpmeteor, $settings)
    {
        return $wpmeteor;
    }

    public function frontend_rewrite($buffer, $settings) {
        if (preg_match('/<meta[^>]+charset=[^>]+>/i', $buffer, $matches)) {
            $buffer = preg_replace('/<meta[^>]+charset=[^>]+>/i', '', $buffer);
            if (preg_match('/<head\b/i', $buffer)) {
                $buffer = preg_replace('/(<head\b[^>]*?>)/i', "\${1}${matches[0]}", $buffer);
            } elseif (preg_match('/<html\b/i', $buffer)) {
                $buffer = preg_replace('/(<html\b[^>]*?>)/i', "\${1}${matches[0]}", $buffer);
            } else {
                $buffer = preg_replace('/(<\w+)/', "${matches[0]}\${1}", $buffer, 1);
            }
        }
        return $buffer;
    }


}
