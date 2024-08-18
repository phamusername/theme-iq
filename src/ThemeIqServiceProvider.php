<?php

namespace Ophim\ThemeIq;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class ThemeIqServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->setupDefaultThemeCustomizer();
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'themes');

        $this->publishes([
            __DIR__ . '/../resources/assets' => public_path('themes/iq')
        ], 'iq-assets');
    }

    protected function setupDefaultThemeCustomizer()
    {
        config(['themes' => array_merge(config('themes', []), [
            'iq' => [
                'name' => 'Iqiyi',
                'author' => 't.me/gggforyou',
                'package_name' => 'ggg3/theme-iq',
                'publishes' => ['iq-assets'],
                'preview_image' => '',
                'options' => [
                    [
                        'name' => 'recommendations',
                        'label' => 'Phim đề cử',
                        'type' => 'code',
                        'hint' => 'display_label|find_by_field|value|limit|sort_by_field|sort_algo',
                        'value' => <<<EOT
                        Phim HOT|is_copyright|0|10|view_week|desc
                        Phim đề cử|is_recommended|1|10|view_week|desc
                        Phim ngẫu nhiên|random|random|10|view_week|desc
                        EOT,
                        'attributes' => [
                            'rows' => 5
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'per_page_limit',
                        'label' => 'Pages limit',
                        'type' => 'number',
                        'value' => 48,
                        'wrapperAttributes' => [
                            'class' => 'form-group col-md-4',
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'movie_related_limit',
                        'label' => 'Movies related limit',
                        'type' => 'number',
                        'value' => 24,
                        'wrapperAttributes' => [
                            'class' => 'form-group col-md-4',
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'latest',
                        'label' => 'Home Page',
                        'type' => 'code',
                        'hint' => 'display_label|relation|find_by_field|value|limit|show_more_url',
                        'value' => <<<EOT
                        Phim mới cập nhật||is_copyright|0|12|/danh-sach/phim-moi
                        Phim chiếu rạp mới||is_shown_in_theater|1|12|/danh-sach/phim-chieu-rap
                        Phim bộ mới||type|series|12|/danh-sach/phim-bo
                        Phim lẻ mới||type|single|12|/danh-sach/phim-le
                        Phim hoạt hình|categories|slug|hoat-hinh|12|/the-loai/hoat-hinh
                        EOT,
                        'attributes' => [
                            'rows' => 5
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'hotest',
                        'label' => 'Danh sách hot',
                        'type' => 'code',
                        'hint' => 'Label|relation|find_by_field|value|sort_by_field|sort_algo|limit|show_template (top_thumb|top_trending)',
                        'value' => <<<EOT
                        Bảng xếp hạng||is_copyright|0|view_week|desc|6|top_thumb
                        EOT,
                        'attributes' => [
                            'rows' => 5
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'additional_css',
                        'label' => 'Additional CSS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom CSS'
                    ],
                    [
                        'name' => 'body_attributes',
                        'label' => 'Body attributes',
                        'type' => 'text',
                        'value' => 'id="Tf-Wp" class="home blog BdGradient"',
                        'tab' => 'Custom CSS'
                    ],
                    [
                        'name' => 'additional_header_js',
                        'label' => 'Header JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'additional_body_js',
                        'label' => 'Body JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'additional_footer_js',
                        'label' => 'Footer JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'footer',
                        'label' => 'Footer',
                        'type' => 'code',
                        'value' => <<<EOT
                        <div class="footer" id="footer">
                            <div class="container">
                                <div class="row">
                                    <ul class="footer__list">
                                        <li class="">
                                            <h3 class="footer__title">Giới thiệu về chúng tôi</h3>
                                            <ul>
                                                <li class="footer__item">
                                                    <a href="/">Thông tin công ty</a>
                                                </li>
                                                <li class="footer__item">
                                                    <a href="">Giới thiệu dịch vụ sản phẩm</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <h3 class="footer__title">Hợp tác</h3>
                                            <ul>
                                                <li class="footer__item"><a href="/">Đăng quảng cáo</a></li>
                                                <li class="footer__item"><a href="#">Thông tin</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <h3 class="footer__title">Hỗ trợ giúp đỡ</h3>
                                            <ul>
                                                <li class="footer__item"><a href="#">Liên hệ</a></li>
                                                <li class="footer__item"><a href="#">Báo cáo</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <h3 class="footer__title">Điều khoản</h3>
                                            <ul>
                                                <li class="footer__item"><a href="#">Điều khoản chung</a></li>
                                                <li class="footer__item"><a href="#">Chính sách riêng tư</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sc-d898c62d-0 hixEMX">
                                <div class="line"></div>
                                <div class="sc-c8e7e327-0 dznphQ">
                                    <div class="backTop-msg" style="display: none;">
                                        <div class="msg-container">Về đầu trang</div>
                                        <div class="msg-arrow"></div>
                                    </div>
                                    <div class="backTop-wrapper" role="button">
                                        <svg width="32px" height="32px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g id="PCW-侧导航-下载app+回顶部" transform="translate(-1832.000000, -1470.000000)" fill="#1CC749" fill-rule="nonzero">
                                                    <g id="侧导航" transform="translate(1816.000000, 1389.000000)">
                                                        <g id="ic_share-copy-2" transform="translate(16.000000, 81.000000)">
                                                            <path
                                                                d="M24.1137085,11.8137085 L24.1137085,13.5565656 C24.1137403,13.832708 23.8898827,14.0565656 23.6137403,14.0565656 C23.6137297,14.0565656 23.6137191,14.0565656 23.6137085,14.0565338 L10.8557226,14.0557226 L10.8557226,14.0557226 L10.8565338,26.8137085 C10.8565832,27.0898509 10.6327398,27.3137227 10.3565974,27.3137403 C10.3565868,27.3137403 10.3565762,27.3137403 10.3565656,27.3137085 L8.6137085,27.3137085 C8.33756612,27.3137085 8.1137085,27.0898509 8.1137085,26.8137085 L8.1137085,13.5994228 L8.1137085,13.5994228 C8.1137085,12.3875522 9.05682707,11.3959589 10.2491364,11.3185704 L10.3994228,11.3137085 L23.6137085,11.3137085 C23.8898509,11.3137085 24.1137085,11.5375661 24.1137085,11.8137085 Z"
                                                                id="路径"
                                                                transform="translate(16.113708, 19.313708) rotate(-315.000000) translate(-16.113708, -19.313708) ">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        EOT,
                        'tab' => 'Custom HTML'
                    ],
                    [
                        'name' => 'ads_header',
                        'label' => 'Ads header',
                        'type' => 'code',
                        'value' => '',
                        'tab' => 'Ads'
                    ],
                    [
                        'name' => 'ads_catfish',
                        'label' => 'Ads catfish',
                        'type' => 'code',
                        'value' => '',
                        'tab' => 'Ads'
                    ],
                    [
                        'name' => 'show_fb_comment_in_single',
                        'label' => 'Show FB Comment In Single',
                        'type' => 'boolean',
                        'value' => false,
                        'tab' => 'FB Comment'
                    ]
                ],
            ]
        ])]);
    }
}
