<?php
function ocdi_import_files() {
    return [
      [
        'import_file_name'             => esc_html__('Homepage 1', 'tp-toolkit'),
        'local_import_file'            => esc_url(trailingslashit( PLUGIN_URL ) . '/tp-toolkit/inc/one-click-demo-importer/demo-data/content.xml'),
        'local_import_widget_file'     => esc_url(trailingslashit( PLUGIN_URL ) . '/tp-toolkit/inc/one-click-demo-importer/demo-data/content.json'),
        'local_import_customizer_file' => esc_url(trailingslashit( PLUGIN_URL ) . '/tp-toolkit/inc/one-click-demo-importer/demo-data/customizer.dat'),
        'local_import_acf_file' => esc_url(trailingslashit( PLUGIN_URL ) . '/tp-toolkit/inc/one-click-demo-importer/demo-data/acf-meta.json'),
        'local_import_redux'           => [
          [
            'file_path'   => esc_url(trailingslashit( PLUGIN_URL ) . '/tp-toolkit/inc/one-click-demo-importer/redux.json'),
            'option_name' => 'redux_option_name',
          ],
        ],
        'import_preview_image_url'     => esc_url(PLUGIN_URL . '/tp-toolkit/inc/one-click-demo-importer/preview/home-01.jpg'),
        'preview_url'                  => 'https://themephi.net/wp/kidba/',
      ],
      [
        'import_file_name'             => esc_html__('Homepage 2', 'tp-toolkit'),
        'local_import_file'            => esc_url(trailingslashit( PLUGIN_URL ) . '/tp-toolkit/inc/one-click-demo-importer/demo-data/content.xml'),
        'local_import_widget_file'     => esc_url(trailingslashit( PLUGIN_URL ) . '/tp-toolkit/inc/one-click-demo-importer/demo-data/content.json'),
        'local_import_customizer_file' => esc_url(trailingslashit( PLUGIN_URL ) . '/tp-toolkit/inc/one-click-demo-importer/demo-data/customizer.dat'),
        'local_import_acf_file' => esc_url(trailingslashit( PLUGIN_URL ) . '/tp-toolkit/inc/one-click-demo-importer/demo-data/acf-meta.json'),
        'local_import_redux'           => [
          [
            'file_path'   => esc_url(trailingslashit( PLUGIN_URL ) . '/tp-toolkit/inc/one-click-demo-importer/redux.json'),
            'option_name' => 'redux_option_name',
          ],
        ],
        'import_preview_image_url'     => esc_url(PLUGIN_URL . '/tp-toolkit/inc/one-click-demo-importer/preview/home-02.jpg'),
        'preview_url'                  => 'https://themephi.net/wp/kidba/homepage-2/',
      ],
    ];
  }
  add_filter( 'ocdi/import_files', 'ocdi_import_files' );