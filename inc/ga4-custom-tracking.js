// GA4 Custom IP Tracking Script (Ajax版)

// Google Analytics 4のカスタム定義
//dimension1: IPアドレス ip_address
//dimension2: アクセス日時 access_time
//dimension3: ページパス page_path


(function () {
    // window.ga4_config が存在しない場合は処理を停止
    if (typeof window.ga4_config === "undefined") {
        console.error("GA4 config not found");
        return;
    }

    const config = window.ga4_config;

    // GA4の基本設定を初期化
    window.dataLayer = window.dataLayer || [];
    function gtag() {
        dataLayer.push(arguments);
    }
    gtag("js", new Date());

    // 基本的なGA4設定
    gtag("config", config.ga_id);

    // Ajax経由でIPアドレスを安全に取得
    const xhr = new XMLHttpRequest();
    xhr.open("POST", config.ajax_url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            try {
                const response = JSON.parse(xhr.responseText);
                if (response.success && response.data) {
                    // IPアドレス付きのカスタム設定
                    gtag("config", config.ga_id, {
                        custom_map: {
                            dimension1: "ip_address",
                            dimension2: "access_time",
                            dimension3: "page_path",
                        },
                    });

                    // 日時フォーマット関数
                    function formatDateTime(timestamp) {
                        const date = new Date(timestamp * 1000);
                        const year = date.getFullYear();
                        const month = String(date.getMonth() + 1).padStart(2,"0");
                        const day = String(date.getDate()).padStart(2, "0");
                        const hours = String(date.getHours()).padStart(2, "0");
                        const minutes = String(date.getMinutes()).padStart(2,"0");
                        const seconds = String(date.getSeconds()).padStart(2,"0");
                        return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
                    }

                    // カスタムイベントとしてIPを送信
                    gtag("event", "custom_access", {
                        ip_address: response.data.ip_address,
                        page_path:response.data.page_path || window.location.pathname,
                        access_time: formatDateTime(response.data.timestamp),
                    });

                    console.log("IP address sent securely to GA4.");
                }
            } catch (e) {
                console.error("GA4 IP tracking error:", e);
            }
        }
    };

    // Ajaxリクエスト送信
    xhr.send("action=get_user_ip&nonce=" + config.nonce);
})();