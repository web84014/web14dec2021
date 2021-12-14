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

namespace WP_Meteor\Blocker\FirstInteraction;

/**
 * Provide Import and Export of the settings of the plugin
 */
class UltimateReorder extends Base
{
    public $adminPriority = -1;
    public $priority = 99;
    public $tab = 'ultimate';
    public $title = 'Maximum available speed';
    public $description = ""; //"Delays script loading to 2 seconds";
    public $disabledInUltimateMode = false;
    public $defaultEnabled = false;

    public $pattern = [['.*', '']];

    public function initialize()
    {
        parent::initialize();
        \add_filter(WPMETEOR_TEXTDOMAIN . '-frontend-rewrite', [$this, 'frontend_rewrite'], $this->priority, 2);
    }

    public function backend_display_settings()
    {
        echo '<div id="' . $this->id . '" class="ultimate"
                    data-prefix="' . $this->id . '" 
                    data-title="' . $this->title . '"></div>';
    }

    public function backend_save_settings($sanitized, $settings)
    {
        // $exists = isset($sanitized[$this->id]['enabled']);
        $sanitized[$this->id] = array_merge($settings[$this->id], $sanitized[$this->id] ?: []);
        $sanitized[$this->id]['enabled'] = true;
        return $sanitized;
    }

    /* triggered from wpmeteor_load_settings */
    public function load_settings($settings)
    {
        $settings[$this->id] = isset($settings[$this->id])
            ? $settings[$this->id]
            : ['enabled' => true];

        $settings[$this->id]['id'] = $this->id;
        $settings[$this->id]['delay'] = @$settings[$this->id]['delay'] ?: 1;
        $settings[$this->id]['after'] = 'REORDER';
        $settings[$this->id]['description'] = $this->description;
        return $settings;
    }

    public function frontend_rewrite($buffer, $settings)
    {
        // Fast Velocity Minify Delay JS compatibility
        /*
        if (is_plugin_active('fast-velocity-minify/fvm.php')) {
            $buffer = preg_replace('/\s+type=([\'"])fvm-script-delay\1/i', ' type=\'text/javascript\'', $buffer);
        }
        */

        /*
        if (is_plugin_active('wp-rocket/wp-rocket.php')) {
            $buffer = preg_replace('/\s+type=([\'"])rocketlazyloadscript\1\s+data-rocket-type=([\'"])text\/javascript\2/i', ' type=\'text/javascript\'', $buffer);
            // type="rocketlazyloadscript" data-rocket-type='text/javascript'
        }*/

        $REPLACEMENTS = [];
        $searchOffset = 0;
        while (preg_match('/<script\b[^>]*?>/is', $buffer, $matches, PREG_OFFSET_CAPTURE, $searchOffset)) {
            $offset = $matches[0][1];
            $searchOffset = $offset + 1;
            if (preg_match('/<\/\s*script>/is', $buffer, $endMatches, PREG_OFFSET_CAPTURE, $matches[0][1])) {
                $len = $endMatches[0][1] - $matches[0][1] + strlen($endMatches[0][0]);
                $everything = substr($buffer, $matches[0][1], $len);
                $tag = $matches[0][0];
                $closingTag = $endMatches[0][0];

                $hasSrc = preg_match('/\s+src=/i', $tag);
                $hasType = preg_match('/\s+type=/i', $tag);
                $shouldReplace = !$hasType || preg_match('/\s+type=([\'"])((application|text)\/(javascript|ecmascript|html|template)|module)\1/i', $tag);
                $noOptimize = preg_match('/data-wpmeteor-nooptimize="true"/i', $tag);
                if ($shouldReplace && !$hasSrc && !$noOptimize) {
                    // inline script
                    $content = substr($buffer, $matches[0][1] + strlen($matches[0][0]), $endMatches[0][1] - $matches[0][1] - strlen($matches[0][0]));
                    if (apply_filters('wpmeteor_exclude', false, $content)) {
                        $replacement = preg_replace('/^<script\b/i', '<script data-wpmeteor-nooptimize="true"', $everything);
                        $buffer = substr_replace($buffer, $replacement, $offset, $len);
                        continue;
                    }
                    $replacement = $tag . "WPMETEOR[" . count($REPLACEMENTS) . "]WPMETEOR" . $closingTag;
                    $REPLACEMENTS[] = $content;
                    $buffer = substr_replace($buffer, $replacement, $offset, $len);
                    continue;
                }
            }
        }

        $buffer = preg_replace_callback('/<script\b[^>]*?>/i', function ($matches) {
            list($tag) = $matches;

            $EXTRA = constant('WPMETEOR_EXTRA_ATTRS') ?: '';

            $result = $tag;
            if (!preg_match('/\s+data-src=/i', $result) 
                && !preg_match('/data-wpmeteor-nooptimize="true"/i', $result)
                && !preg_match('/data-rocketlazyloadscript=/i', $result)) {

                $src = preg_match('/\s+src=([\'"])(.*?)\1/i', $result, $matches)
                    ? $matches[2]
                    : null;
                if (!$src) {
                    // trying to detect src without quotes
                    $src = preg_match('/\s+src=([\/\w\-\.\~\:\[\]\@\!\$\?\&\#\(\)\*\+\,\;\=\%]+)/i', $result, $matches)
                        ? $matches[1]
                        : null;
                }
                $hasType = preg_match('/\s+type=/i', $result);
                $isJavascript = !$hasType
                    || preg_match('/\s+type=([\'"])((application|text)\/(javascript|ecmascript)|module)\1/i', $result)
                    || preg_match('/\s+type=((application|text)\/(javascript|ecmascript)|module)/i', $result);
                if ($isJavascript) {
                    if ($src) {
                        if (apply_filters('wpmeteor_exclude', false, $src)) {
                            return $result;
                        }
                        $result = preg_replace('/\s+src=/i', " data-src=", $result);
                        $result = preg_replace('/\s+(async|defer)\b/i', " data-\$1", $result);
                    }
                    if ($hasType) {
                        $result = preg_replace('/\s+type=([\'"])module\1/i', " type=\"javascript/blocked\" data-wpmeteor-module ", $result);
                        $result = preg_replace('/\s+type=module\b/i', " type=\"javascript/blocked\" data-wpmeteor-module ", $result);
                        $result = preg_replace('/\s+type=([\'"])(application|text)\/(javascript|ecmascript)\1/i', " type=\"javascript/blocked\"", $result);
                        $result = preg_replace('/\s+type=(application|text)\/(javascript|ecmascript)\b/i', " type=\"javascript/blocked\"", $result);
                    } else {
                        $result = preg_replace('/<script/i', "<script type=\"javascript/blocked\"", $result);
                    }
                    $result = preg_replace('/<script/i', "<script ${EXTRA} data-wpmeteor-after=\"REORDER\"", $result);
                }
            }
            return preg_replace('/\s*data-wpmeteor-nooptimize="true"/i', '', $result);
        }, $buffer);

        $buffer = preg_replace_callback('/WPMETEOR\[(\d+)\]WPMETEOR/', function ($matches) use (&$REPLACEMENTS) {
            return $REPLACEMENTS[(int)$matches[1]];
        }, $buffer);

        return $buffer;
    }

    public function backend_adjust_wpmeteor($wpmeteor, $settings)
    {
        $wpmeteor['blockers'] = @$wpmeteor['blockers'] ?: [];
        $wpmeteor['blockers'][$this->id] = $settings[$this->id];

        if (version_compare($settings['v'], '2.3.6', '<') && 3 === (int) $settings[$this->id]['delay']) {
            $wpmeteor['blockers'][$this->id]['delay'] = -1;
        }
        return $wpmeteor;
    }

    public function frontend_adjust_wpmeteor($wpmeteor, $settings)
    {
        if (!$settings[$this->id]['enabled']) {
            $wpmeteor['rdelay'] = 1000;
        } else {
            if (version_compare($settings['v'], '2.3.6', '<')) {
                $wpmeteor['rdelay'] = (int) $settings[$this->id]['delay'] === 3
                    ? 86400000 # one day
                    : (int) $settings[$this->id]['delay'] * 1000;
            } else {
                $wpmeteor['rdelay'] = (int) $settings[$this->id]['delay'] < 0
                    ? 86400000 # one day
                    : (int) $settings[$this->id]['delay'] * 1000;
            }
        }
        return $wpmeteor;
    }
}
