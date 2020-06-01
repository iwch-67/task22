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
	public function view($id = null) {
		$this->set('title_for_layout', 'ユーザー情報');
		$user = $this->Auth->user();
		$this->set('user', $user);
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->findById($id));
	}
	public function edit($id = null) {
		$this->set('title_for_layout', 'ユーザー情報編集');
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		//POSTされたあとの処理
		if ($this->request->is('post') || $this->request->is('put')) {
			$image_name = $this->request->data['User']['image']['name'];
			//ファイルが選択されていたとき
			if ($image_name) {
				//モデルにデータを設定
				$this->User->set($this->request->data);
				//画像のバリデーションを一旦チェック
				if ($this->User->validates(array('filedList' => array('image')))) {
					$file = $this->request->data['User']['image'];
					//拡張子の取得
					switch (exif_imagetype($file['tmp_name'])) {
						case IMAGETYPE_GIF:
							$ext = 'gif';
							break;
						case IMAGETYPE_JPEG:
							$ext = 'jpg';
							break;
						case IMAGETYPE_PNG:
							$ext = 'png';
							break;
					}
					//画像のユニーク化
					$image = uniqid(mt_rand(), true) . '.' . $ext;
					$this->request->data['User']['image'] = $image;
					//ファイルの移動
					if (move_uploaded_file($file['tmp_name'], '../webroot/img/' . $image)) {
						if ($this->User->save($this->request->data, array('validate' => false))) {
							$this->Flash->success(__('ユーザー情報を編集しました'));
							return $this->redirect(array(
								'controller' => 'users',
								'action' => 'view', $id
							));
						}
					//移動に失敗した場合
					} else {
						$this->Flash->error(__('編集できませんでした。再度お試しください'));
					}
				}
			//ファイルが選択されていない場合コメントのみDB保存
			} else {
				$this->User->save($this->request->data, false, array('comment'));
				$this->Flash->success(__('ユーザー情報を編集しました'));
				return $this->redirect(array(
					'controller' => 'users',
					'action' => 'view', $id
				));
			}
		} else {
			$this->request->data = $this->User->findById($id);
			unset($this->request->data['User']['password']);
		}
	}
	public function isAuthorized($user) {
		if ($this->action === 'edit') {
			$page_id = $this->request->params['pass'][0];
			if ($this->Auth->user('id') == $page_id) {
				return true;
			} else {
				$this->Flash->error(__('他人のユーザー情報は編集できません'));
				return $this->redirect(array('controller' => 'blogs', 'action' => 'index'));
			}
		}
	}
}
?>
