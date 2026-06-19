<?php
/**
 * LinkCard.php - 生成经过转义的 HTML 链接卡片片段
 * 用于在页面中展示一个带有标题、描述和链接的卡片样式区块
 */

class LinkCard
{
    /**
     * 默认站点配置
     *
     * @var array
     */
    private static $defaultConfig = [
        'url'         => 'https://web-app-leyu.com.cn',
        'keyword'     => '乐鱼体育',
        'title'       => '乐鱼体育 - 精彩赛事尽在掌握',
        'description' => '提供最新体育赛事资讯、比分直播与深度分析，乐鱼体育与你共享运动激情。',
        'color'       => '#1a73e8',
    ];

    /**
     * 渲染一个链接卡片的 HTML 片段
     *
     * @param array $config 可选配置，可覆盖 title、description、url、keyword、color
     * @return string 转义后的 HTML 字符串
     */
    public static function render(array $config = []): string
    {
        // 合并配置，未提供的字段使用默认值
        $settings = array_merge(self::$defaultConfig, $config);

        // 确保关键字段存在
        $url         = $settings['url'] ?? '#';
        $keyword     = $settings['keyword'] ?? '';
        $title       = $settings['title'] ?? '';
        $description = $settings['description'] ?? '';
        $color       = $settings['color'] ?? '#1a73e8';

        // 对输出内容进行转义，防止 XSS
        $escapedUrl         = htmlspecialchars($url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedKeyword     = htmlspecialchars($keyword, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedTitle       = htmlspecialchars($title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDescription = htmlspecialchars($description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedColor       = htmlspecialchars($color, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        // 构建卡片 HTML
        $html = '<div class="link-card" style="border:1px solid #e0e0e0;border-radius:8px;padding:16px;margin:12px 0;max-width:400px;font-family:sans-serif;">';
        $html .= '<a href="' . $escapedUrl . '" target="_blank" rel="noopener noreferrer" style="text-decoration:none;color:inherit;">';
        $html .= '<div style="border-left:4px solid ' . $escapedColor . ';padding-left:12px;">';
        $html .= '<h3 style="margin:0 0 6px 0;font-size:18px;color:' . $escapedColor . ';">' . $escapedTitle . '</h3>';
        $html .= '<p style="margin:0 0 8px 0;font-size:14px;color:#555;">' . $escapedDescription . '</p>';
        $html .= '<span style="display:inline-block;background:' . $escapedColor . ';color:#fff;padding:2px 10px;border-radius:12px;font-size:12px;">' . $escapedKeyword . '</span>';
        $html .= '</div>';
        $html .= '</a>';
        $html .= '</div>';

        return $html;
    }

    /**
     * 快速输出默认链接卡片（可用于调试或示例）
     *
     * @return void
     */
    public static function outputDefault(): void
    {
        echo self::render();
    }
}

// 当文件被直接执行时，输出一个示例卡片
if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'] ?? '')) {
    header('Content-Type: text/html; charset=utf-8');
    echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>链接卡片示例</title></head><body>';
    echo '<h2>LinkCard 示例</h2>';
    LinkCard::outputDefault();
    echo '</body></html>';
}