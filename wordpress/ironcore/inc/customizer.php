<?php
/**
 * Внешний вид → Настроить → «IronCore: контакты и заявки».
 *
 * @package IronCore
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'customize_register',
	function ( WP_Customize_Manager $c ) {
		$c->add_section(
			'ironcore',
			array(
				'title'       => 'IronCore: контакты и заявки',
				'priority'    => 30,
				'description' => 'Телефон выводится в шапке-меню, контактах и футере. Заявки всегда сохраняются в разделе «Заявки» админки; письмо и Telegram — дополнительные каналы.',
			)
		);

		$fields = array(
			'phone'           => array( 'Телефон (как показывать)', 'text', 'sanitize_text_field', '8 (928) 416-09-38', '' ),
			'lead_email'      => array( 'E-mail для заявок', 'email', 'sanitize_email', '', 'Пусто — письма уходят на адрес администратора сайта. Несколько адресов не поддерживаются: используйте общий ящик.' ),
			'tg_chat'         => array( 'Telegram: chat_id для заявок', 'text', 'sanitize_text_field', '', 'ID чата или группы, куда бот пишет заявки. Пусто — Telegram не используется.' ),
			'tg_token'        => array( 'Telegram: токен бота', 'text', 'sanitize_text_field', '', 'Надёжнее задать в wp-config.php: define( \'IRONCORE_TG_TOKEN\', \'...\' ); — тогда это поле игнорируется.' ),
			'telegram_url'    => array( 'Ссылка на Telegram (футер)', 'url', 'esc_url_raw', '', 'Пусто — не выводится.' ),
			'max_url'         => array( 'Ссылка на MAX (футер)', 'url', 'esc_url_raw', '', 'Пусто — не выводится.' ),
			'requisites'      => array( 'Реквизиты в футере', 'textarea', 'sanitize_textarea_field', '', 'Например: ООО «…», ИНН …, ОГРН …. Пока пусто и нет мессенджеров, в футере стоит пометка «Реквизиты компании и мессенджеры будут добавлены».' ),
			'seo_title'       => array( 'Title главной', 'text', 'sanitize_text_field', '', 'Используется, только если не установлен SEO-плагин.' ),
			'seo_description' => array( 'Meta description главной', 'textarea', 'sanitize_textarea_field', '', 'Используется, только если не установлен SEO-плагин.' ),
		);

		foreach ( $fields as $key => $f ) {
			$c->add_setting(
				'ic_' . $key,
				array(
					'default'           => $f[3],
					'sanitize_callback' => $f[2],
					'transport'         => 'refresh',
				)
			);
			$c->add_control(
				'ic_' . $key,
				array(
					'label'       => $f[0],
					'section'     => 'ironcore',
					'type'        => $f[1],
					'description' => $f[4],
				)
			);
		}
	}
);
