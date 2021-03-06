<?php
/*
+--------------------------------------------------------------------------
|   WeCenter [#RELEASE_VERSION#]
|   ========================================
|   by WeCenter Software
|   © 2011 - 2014 WeCenter. All Rights Reserved
|   http://www.wecenter.com
|   ========================================
|   Support: WeCenter@qq.com
|
+---------------------------------------------------------------------------
*/


if (!defined('IN_ANWSION'))
{
	die;
}

class main extends AWS_CONTROLLER
{
	public function setup()
	{
		$this->crumb(AWS_APP::lang()->_t('发布'));
	}

	public function index_action()
	{
		if (!$this->user_info['permission']['publish_question'])
		{
			H::redirect_msg(AWS_APP::lang()->_t('你的声望还不够'));
		}

		if (!$this->model('currency')->check_balance_for_operation($this->user_info['currency'], 'currency_system_config_new_question'))
		{
			H::redirect_msg(AWS_APP::lang()->_t('你的剩余%s已经不足以进行此操作', get_setting('currency_name')), '/currency/rule/');
		}

		if (!$this->model('ratelimit')->check_thread($this->user_id, $this->user_info['permission']['thread_limit_per_day']))
		{
			H::redirect_msg(AWS_APP::lang()->_t('今日发帖数量已经达到上限'));
		}

		$thread_info = array(
			'title' => '',
			'message' => '',
			'category_id' => intval($_GET['category_id'])
		);

		if (get_setting('category_enable') != 'N')
		{
			TPL::assign('category_current_id', $thread_info['category_id']);
			TPL::assign('category_list', $this->model('category')->get_category_list_by_user_permission($this->user_info['permission']));
		}

		TPL::import_js('js/app/publish.js');

		if (get_setting('advanced_editor_enable') == 'Y')
		{
			import_editor_static_files();
		}

		TPL::assign('thread_info', $thread_info);

		TPL::assign('recent_topics', @unserialize($this->user_info['recent_topics']));

		TPL::output('publish/index');
	}

	public function article_action()
	{
		if (!$this->user_info['permission']['publish_article'])
		{
			H::redirect_msg(AWS_APP::lang()->_t('你的声望还不够'));
		}

		if (!$this->model('currency')->check_balance_for_operation($this->user_info['currency'], 'currency_system_config_new_article'))
		{
			H::redirect_msg(AWS_APP::lang()->_t('你的剩余%s已经不足以进行此操作', get_setting('currency_name')), '/currency/rule/');
		}

		if (!$this->model('ratelimit')->check_thread($this->user_id, $this->user_info['permission']['thread_limit_per_day']))
		{
			H::redirect_msg(AWS_APP::lang()->_t('今日发帖数量已经达到上限'));
		}

		$thread_info = array(
			'title' => '',
			'message' => '',
			'category_id' => intval($_GET['category_id'])
		);

		if (get_setting('category_enable') != 'N')
		{
			TPL::assign('category_current_id', $thread_info['category_id']);
			TPL::assign('category_list', $this->model('category')->get_category_list_by_user_permission($this->user_info['permission']));
		}

		TPL::import_js('js/app/publish.js');

		if (get_setting('advanced_editor_enable') == 'Y')
		{
			import_editor_static_files();
		}

		TPL::assign('recent_topics', @unserialize($this->user_info['recent_topics']));

		TPL::assign('thread_info', $thread_info);

		TPL::output('publish/article');
	}

	public function video_action()
	{
		if (!$this->user_info['permission']['publish_video'])
		{
			H::redirect_msg(AWS_APP::lang()->_t('你的声望还不够'));
		}

		if (!$this->model('currency')->check_balance_for_operation($this->user_info['currency'], 'currency_system_config_new_video'))
		{
			H::redirect_msg(AWS_APP::lang()->_t('你的剩余%s已经不足以进行此操作', get_setting('currency_name')), '/currency/rule/');
		}

		if (!$this->model('ratelimit')->check_thread($this->user_id, $this->user_info['permission']['thread_limit_per_day']))
		{
			H::redirect_msg(AWS_APP::lang()->_t('今日发帖数量已经达到上限'));
		}

		$thread_info = array(
			'title' => '',
			'message' => '',
			'category_id' => intval($_GET['category_id'])
		);

		if (get_setting('category_enable') != 'N')
		{
			TPL::assign('category_current_id', $thread_info['category_id']);
			TPL::assign('category_list', $this->model('category')->get_category_list_by_user_permission($this->user_info['permission']));
		}

		TPL::import_js('js/app/publish.js');

		TPL::assign('recent_topics', @unserialize($this->user_info['recent_topics']));

		TPL::assign('thread_info', $thread_info);

		TPL::output('publish/video');
	}

	public function delay_action()
	{
		$url = '/';

		H::redirect_msg(AWS_APP::lang()->_t('发布成功, 内容将会延迟显示, 请稍后再来查看...'), $url);
	}

}
