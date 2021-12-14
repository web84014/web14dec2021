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
?>

<div class="wrap">

    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
    <form id="settings" method="post">
        <input type="hidden" name="wpmeteor_action" value="save_settings" />
        <?php wp_nonce_field('wpmeteor_save_settings_nonce', 'wpmeteor_save_settings_nonce'); ?>

        <div id="tabs" class="settings-tab">
            <ul>
                <li><a href="#settings" class="tab-handle"><?php esc_html_e('Settings', WPMETEOR_TEXTDOMAIN); ?></a></li>
                <li><a href="#exclusions" class="tab-handle"><?php esc_html_e('Exclusions', WPMETEOR_TEXTDOMAIN); ?></a></li>
                <li><a href="#elementor" class="tab-handle"><?php esc_html_e('Elementor', WPMETEOR_TEXTDOMAIN); ?></a></li>
                <!-- <li><a href="#how-it-works" class="tab-handle"><?php esc_html_e('How it works', WPMETEOR_TEXTDOMAIN); ?></a></li> -->
                <!-- <li><a href="#faq" class="tab-handle"><?php esc_html_e('FAQ', WPMETEOR_TEXTDOMAIN); ?></a></li> -->
                <!-- <li><a href="#premium" class="tab-handle"><?php esc_html_e('GO PREMIUM', WPMETEOR_TEXTDOMAIN); ?></a></li> -->
            </ul>
            <div id="settings" class="tab">
                <?php do_action(WPMETEOR_TEXTDOMAIN . '-backend-display-settings-ultimate'); ?>
                <div className="field">
                    <input type="submit" name="submit" id="submit" class="button" value="Save Changes" />
                </div>
                <p>
                    <a href="#how-it-works">Read more</a> on how it works
                </p>
            </div>
            <div id="exclusions" class="tab">
                <?php do_action(WPMETEOR_TEXTDOMAIN . '-backend-display-settings-exclusions'); ?>
                <div className="field">
                    <input type="submit" name="submit" id="submit" class="button" value="Save Changes" />
                </div>
            </div>
            <div id="elementor" class="tab">
                <?php do_action(WPMETEOR_TEXTDOMAIN . '-backend-display-settings-elementor'); ?>
                <div className="field">
                    <input type="submit" name="submit" id="submit" class="button" value="Save Changes" />
                </div>
            </div>
            <!-- 
            <div id="how-it-works" class="tab">
                <div>
                    <p>
                        According to <a href="https://httparchive.org/reports/page-weight?lens=wordpress">this source</a>,
                        there are 27 scripts (31.7% of all files), worth of 461Kb (19.3%) on an average<br>
                        Wordpress page. <br>
                        <br>
                        If user doesn't start interacting with page immediately, WP Meteor postpones loading<br>
                        and firing scripts until after page gets rendered. <br>
                        <br>
                        This postponement in script loading greatly improves perceived load times for your visitors. It also <br>
                        significantly improves the following <strong>important SEO metrics</strong>:
                        <ul class="content">
                            <li><a href="https://developers.google.com/speed/pagespeed/insights/">Page Speed</a></li>
                            <li><a href="https://web.dev/lcp/">Largest Contentful Paint (LCP)</a></li>
                            <li><a href="https://web.dev/tti/">Time To Interactive (TTI)</a></li>
                            <li><a href="https://web.dev/tbt/">Total Blocking Time (TBT)</a></li>
                        </ul>
                    </p>
                    <p>
                        We've identified 2 major breakpoints in script loading delays:
                        <ul class="content">
                            <li><strong>1 second delay</strong><br>
                                Pros:
                                <ul class="content">
                                    <li>page speed improves significantly</li>
                                    <li>none or very minor difference in experience for visitors</li>
                                </ul>
                                Cons:
                                <ul class="content">
                                    <li>page speed metric might fluctuate</li>
                                    <li>visitors, who spend less than 1 second on your page might not be counted in analytics</li>
                                </ul>
                                Anything below 1 second doesn't improve page speed.
                            </li>
                            <li><strong>2 seconds delay</strong><br>
                                Pros:
                                <ul class="content">
                                    <li>maximum available improvement in scores</li>
                                </ul>
                                Cons:
                                <ul class="content">
                                    <li>there might be a noticeable delay in animations, located above the fold</li>
                                    <li>visitors, who spend less than 2 seconds on your page might not be counted in analytics</li>
                                </ul>
                                Anything above 2 seconds doesn't improve scores further
                            </li>
                        </ul>

                        In both cases, visitors will experience faster page loading times as they'll see fully rendered page a lot earlier,<br>
                        than currently.
                    </p>
                </div>
            </div>
            <div id="faq" class="tab">
                <p class="question"><strong>Q:</strong> Is WP Meteor safe for SEO?</p>
                <p class="answer"><strong>A:</strong> Yes, because all that matters is visitor experience, and it definitely improves with faster load times. Create sites for users, not crawlers</p>
                <p class="question"><strong>Q:</strong> Should I use 1 second delay or 2?</p>
                <p class="answer"><strong>A:</strong> You should test. 1 second delay usually gives you great boost without harming visitor experience.</p>
            </div>
            <div id="premium" class="tab">
                <p>
                    Using WP Meteor is like using a sledge hammer for cracking nuts.<br>
                    
                    <br>If you are using Real Time Personalization or A/B testing, it will definitely cause late loading of those tools,<br>
                    and in cases when personalized or test content is located above the fold, worsening visitors experience.<br>
                    <br>

                    For these cases we have <a href="https://wp-meteor.com/pro/">WP Meteor Pro</a> ($49/year, 30 days free trial), <br>
                    which acts like the free version, but also allows to exclude from optimization scripts like:

                    <ul class="content">
                        <li>Google Analytics</li>
                        <li>Google Optimize</li>
                        <li>Optimizely</li>
                        <li>Marketo RTP</li>
                        <li>... others by request, at no additional charge</li>
                    </ul>

                    <strong>IMPORTANT:</strong> exclusion of any script from optimization, might worsen page speed, that's the price for improving visitor experience.<br>
                    <br>

                    Get a free trial of WP Meteor PRO <a href="https://wp-meteor.com/pro/">here</a>
                </p>
            </div>
            -->
        </div>
    </form>
</div>
