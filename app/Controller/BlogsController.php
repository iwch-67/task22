<?php
class BlogsController extends AppController {
	public $helpers = array('Html', 'Form', 'Flash');
	public $components = array('Flash');

	public function index() {
		$this->set('posts', $this->Blog->find('all'));
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
			$this->Flash->success(__('投稿は削除されました'));
		} else {
			$this->Flash->error(__('データ削除できませんでした'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
?>
