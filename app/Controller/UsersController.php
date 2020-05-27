<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {
	public function beforeFilter() {
		parent::beforeFilter();
		//ユーザー自身による登録とログアウトを許可する
		$this->Auth->allow('add', 'logout');
	}
	public function login() {
		$this->set('title_for_layout', 'ログイン');
		//フォームから情報が送信された場合、認証を実施
		if ($this->request->is('post')) {
			//認証処理を実施
			if ($this->Auth->login()) {
				$this->Flash->success(__('ログインに成功しました'));
				return $this->redirect($this->Auth->redirect());
			} else {
				$this->Flash->error(__('メールアドレスまたはパスワードが違います。再度お試しください'));
			}
		}
	}
	public function logout() {
		$this->Flash->success(__('ログアウトしました'));
		$this->redirect($this->Auth->logout());
	}

	public function add() {
		$this->set('title_for_layout', '新規登録');
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('ユーザー登録されました'));
				return $this->redirect(array(
					'controller' => 'users',
					'action' => 'login'
				));
			}
			$this->Flash->error(__('ユーザー登録に失敗しました。再度お試しください'));
		}
	}
}
?>
