<?php 
/*
Plugin Name: WP Twitter Follow Plugin
Plugin URI: http://www.absolute-keitarou.net/blog/
Description: ツイッターのフォローボタンプラグイン
Author: keitarou
Version: 1.0
Author URI: http://www.absolute-keitarou.net/blog/
*/
$TwitterFollow = new TwitterFollow();
class TwitterFollow
{
	private $name        = 'TwitterFollow';
	private $option_name = 'TwitterFollow';

	public function __construct() {
		// アクションの設定。
		add_action('admin_menu', array($this, 'add_menu'));
		add_action('admin_init', array($this, 'update_tf'));

		// フィルターの設定
		add_filter('the_content', array($this, 'show_tf'));
	}

/**
	管理画面で利用するメソッド
*/
	// 設定一覧に追加する
	public function add_menu() {
		add_options_page($this->name, $this->name, 8, $this->name, array($this, 'set_tf'));
	}

	// 更新処理
	public function update_tf() {
		if (isset($_POST[$this->option_name]) && !empty($_POST[$this->option_name])) {
			update_option($this->option_name, $_POST[$this->option_name]);
		}
	}

	// 設定画面を呼び出す
	public function set_tf() {
		require 'set_tf.html';
	}

/**
	表示の際に利用するメソッド
*/
	// Followボタンの表示
	public function show_tf() {
		$id = htmlspecialchars(get_option($this->option_name), ENT_QUOTES);
		require 'show_tf.html';
	}
}