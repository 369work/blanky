<?php

/**
 * Google API integration
 */

if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

// GA4測定IDを取得するヘルパー関数
function get_ga4_measurement_id()
{
    static $ga_id = null;
    if ($ga_id === null) {
        $ga_id = get_option('ga4_measurement_id', 'XXXXXXXXXX');
    }
    return $ga_id;
}

// 1. IPアドレスを取得
function get_user_ip_address()
{
    // プロキシやロードバランサー経由の場合を考慮
    $ip_keys = array(
        'HTTP_X_FORWARDED_FOR',
        'HTTP_X_REAL_IP',
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED',
        'HTTP_FORWARDED_FOR',
        'HTTP_FORWARDED',
        'REMOTE_ADDR'
    );

    foreach ($ip_keys as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            $ip = $_SERVER[$key];
            if (strpos($ip, ',') !== false) {
                $ip = explode(',', $ip)[0];
            }
            $ip = trim($ip);

            // IPアドレスの妥当性チェック
            if (filter_var(
                $ip,
                FILTER_VALIDATE_IP,
                FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
            )) {
                return $ip;
            }
        }
    }

    return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
}

// 2. IPアドレスを匿名化（GDPR対応）
function anonymize_ip($ip)
{
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        // IPv4の場合：最後のオクテットを0にする
        $parts = explode('.', $ip);
        $parts[3] = '0';
        return implode('.', $parts);
    } elseif (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
        // IPv6の場合：下位64ビットを0にする
        $parts = explode(':', $ip);
        for ($i = 4; $i < 8; $i++) {
            $parts[$i] = '0';
        }
        return implode(':', $parts);
    }
    return $ip;
}

// 3. Google Analytics ライブラリスクリプトを出力
function output_gtag_library_script()
{
    $ga_id = get_ga4_measurement_id();

    if (empty($ga_id) || !should_track_ip()) {
        return; // GA4のIDが設定されていない、またはトラッキングが無効な場合は何もしない
    }
?>
    <!-- GA4 Library Script -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr($ga_id); ?>"></script>
<?php
}


// 4. Ajax用のIPアドレス取得エンドポイント
function handle_get_user_ip_ajax()
{
    // nonce検証
    if (!wp_verify_nonce($_POST['nonce'], 'ga4_ip_nonce')) {
        wp_die('Security check failed');
    }

    $user_ip = get_user_ip_address();
    $anonymized_ip = anonymize_ip($user_ip);
    $page_path = isset($_POST['page_path']) ? sanitize_text_field($_POST['page_path']) : '';

    wp_send_json_success([
        'ip_address' => $anonymized_ip,
        'timestamp' => current_time('timestamp'),
        'page_path' => $page_path
    ]);
}
add_action('wp_ajax_get_user_ip', 'handle_get_user_ip_ajax');
add_action('wp_ajax_nopriv_get_user_ip', 'handle_get_user_ip_ajax');

// 5. フロントエンドでGA4にカスタムディメンションを送信するJavaScript（Ajax版）
function enqueue_ga4_ip_script()
{
    $ga_id = get_ga4_measurement_id();
    if (empty($ga_id) || !should_track_ip()) {
        return; // GA4のIDが設定されていない、またはトラッキングが無効な場合は何もしない
    }

    // JavaScriptファイルを読み込み
    wp_enqueue_script(
        'ga4-custom-tracking',
        get_template_directory_uri() . '/inc/ga4-custom-tracking.js',
        array(), // 依存関係なし（純粋なJavaScript）
        '1.0.0',
        false // フッターではなくヘッダーに出力
    );

    // PHPの動的な値をJavaScriptに渡す
    wp_localize_script('ga4-custom-tracking', 'ga4_config', array(
        'ga_id' => esc_js($ga_id),
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ga4_ip_nonce')
    ));

}


// 6. 管理画面での設定
function add_ga4_ip_admin_menu()
{
    add_options_page(
        'GA4 IP トラッキング設定',
        'GA4 IP設定',
        'manage_options',
        'ga4-ip-settings',
        'ga4_ip_settings_page'
    );
}
add_action('admin_menu', 'add_ga4_ip_admin_menu');

function ga4_ip_settings_page()
{
    if (isset($_POST['submit'])) {
        update_option('ga4_ip_tracking_enabled', isset($_POST['ga4_ip_enabled']));
        update_option('ga4_ip_anonymize', isset($_POST['ga4_ip_anonymize']));
        if (!empty($_POST['ga4_measurement_id'])) {
            update_option('ga4_measurement_id', sanitize_text_field($_POST['ga4_measurement_id']));
        }
        echo '<div class="notice notice-success"><p>設定を保存しました。</p></div>';
    }

    $enabled = get_option('ga4_ip_tracking_enabled', true);
    $anonymize = get_option('ga4_ip_anonymize', true);
    $ga_id = get_ga4_measurement_id();
?>
    <div class="wrap">
        <h1>GA4 IPトラッキング設定</h1>
        <form method="post" action="">
            <table class="form-table">
                <tr>
                    <th scope="row">Google Analytics 4 測定ID</th>
                    <td>
                        <input type="text" name="ga4_measurement_id" value="<?php echo esc_attr($ga_id); ?>" class="regular-text" />
                        <p class="description">Google Analytics 4の測定ID（例：G-XXXXXXXXXX）を入力してください。</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">IPトラッキングを有効にする</th>
                    <td>
                        <input type="checkbox" name="ga4_ip_enabled" <?php checked($enabled); ?> />
                        <p class="description">チェックを入れるとIPアドレスのトラッキングが有効になります。</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">IPアドレスを匿名化する</th>
                    <td>
                        <input type="checkbox" name="ga4_ip_anonymize" <?php checked($anonymize); ?> />
                        <p class="description">GDPR対応のためIPアドレスを匿名化します（推奨）。</p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>

        <h2>現在のIPアドレス</h2>
        <p>あなたのIPアドレス: <strong><?php echo esc_html(get_user_ip_address()); ?></strong></p>
        <p>匿名化後: <strong><?php echo esc_html(anonymize_ip(get_user_ip_address())); ?></strong></p>

        <h2>デバッグ情報</h2>
        <p>Google Analytics ID: <strong><?php echo esc_html($ga_id); ?></strong></p>
        <p>トラッキング有効: <strong><?php echo $enabled ? 'はい' : 'いいえ'; ?></strong></p>
        <p>管理画面: <strong><?php echo is_admin() ? 'はい' : 'いいえ'; ?></strong></p>
        <p>Ajax処理中: <strong><?php echo wp_doing_ajax() ? 'はい' : 'いいえ'; ?></strong></p>
        <p>スクリプト出力条件: <strong><?php echo should_track_ip() ? 'はい' : 'いいえ'; ?></strong></p>
        <p>ライブラリスクリプトフック登録: <strong><?php echo has_action('wp_head', 'output_gtag_library_script') ? 'はい' : 'いいえ'; ?></strong></p>
        <p>カスタムスクリプトフック登録: <strong><?php echo has_action('wp_head', 'enqueue_ga4_ip_script') ? 'はい' : 'いいえ'; ?></strong></p>

        <?php if (should_track_ip()): ?>
            <div class="notice notice-info">
                <p><strong>現在、Google Analyticsスクリプトが出力される設定になっています。</strong></p>
                <p>フロントエンド（サイト表示）でブラウザの開発者ツールのコンソールを確認してください。「GA4にIPアドレスを安全に送信しました（Ajax経由）」のメッセージが表示されるはずです。</p>
            </div>
        <?php else: ?>
            <div class="notice notice-warning">
                <p><strong>現在、Google Analyticsスクリプトは出力されません。</strong></p>
            </div>
        <?php endif; ?>
    </div>
<?php
}

// 7. 設定に基づいて機能の有効/無効を制御
function should_track_ip()
{
    $enabled = get_option('ga4_ip_tracking_enabled', true);
    return $enabled && !is_admin() && !wp_doing_ajax();
}

// 8. 条件付きでスクリプトを読み込み
function ga4_ip_tracking_setup()
{
    if (should_track_ip()) {
        // Google Analytics ライブラリを wp_head に出力（Block Themeでも確実に動作）
        add_action('wp_head', 'output_gtag_library_script', 1);

        // カスタムJavaScriptを wp_head に出力（ライブラリの後に実行）
        add_action('wp_head', 'enqueue_ga4_ip_script', 2);
    }
}
add_action('init', 'ga4_ip_tracking_setup');

// 9. プライバシーポリシー用のテキスト追加
function add_privacy_policy_content()
{
    if (function_exists('wp_add_privacy_policy_content')) {
        $content = '
        <h2>IPアドレスの収集について</h2>
        <p>当サイトでは、アクセス解析のためにGoogle Analytics 4を使用してIPアドレスを収集しています。</p>
        <p>収集されたIPアドレスは匿名化処理を行い、個人を特定できない形で統計情報として利用されます。</p>
        <p>この情報収集を無効にしたい場合は、ブラウザの設定でJavaScriptを無効にするか、Google Analytics オプトアウト アドオンをご利用ください。</p>
        ';

        wp_add_privacy_policy_content(
            'GA4 IPトラッキング',
            wp_kses_post(wpautop($content))
        );
    }
}
add_action('admin_init', 'add_privacy_policy_content');
