<?php
class BlogsController extends AppController {
	public $helpers = array('Html', 'Form', 'Flash');
	public $components = array('Flash');

	public function index() {
		$user = $this->Auth->user();
		$this->set('user', $user);
		$options = array(
			'order' => array('Blog.created DESC')
		);
		$this->set('posts', $this->Blog->find('all', $options));
		$this->set('title_for_layout', '記事一覧');
	}

	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid post'));
		}
		$post = $this->Blog->findById($id);
		if (!$post) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->set('post', $post);
		$this->set('title_for_layout', '記事詳細');
	}
	public function add() {
		$this->set('title_for_layout', '記事投稿');
		if ($this->request->is('post')) {
			$this->Blog->create();
			$this->request->data['Blog']['user_id'] = $this->Auth->user('id');
			if ($this->Blog->save($this->request->data)) {
				$this->Flash->success(__('投稿が保存されました'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Flash->error(__('投稿に失敗しました'));
		}
	}
	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid post'));
		}
		$post = $this->Blog->findById($id);
		if (!$post) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->set('title_for_layout', '記事編集');
		if ($this->request->is(array('post', 'put'))) {
			$this->Blog->id = $id;
			if ($this->Blog->save($this->request->data)) {
				$this->Flash->success(__('編集が完了しました'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Flash->error(__('編集に失敗しました'));
		}
		if (!$this->request->data) {
			$this->request->data = $post;
		}
	}
	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Blog->delete($id)) {
			$this->Flash->success(__('投稿は削除されました', h($id)));
		} else {
			$this->Flash->error(__('データ削除できませんでした', h($id)));
		}
		return $this->redirect(array('action' => 'index'));
	}
	public function isAuthorized($user) {
		//登録済みユーザーは投稿可能
		if ($this->action === 'add') {
			return true;
		}
		if (in_array($this->action, array('edit', 'delete'))) {
			//URLパラメータを代入
			$blogId = (int)$this->request->params['pass'][0];
			if ($this->Blog->isOwnedBy($blogId, $user['id'])) {
				return true;
			} else {
				$this->Flash->error(__('他人の投稿は編集できません'));
				return $this->redirect(array('action' => 'index'));
			}
		}
	}
}
?>
