<?php
namespace Sandbox\Controller;

use Sandbox\Controller\SandboxAppController;

class MarkupController extends SandboxAppController {

	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);

		$this->Auth->allow();
	}

	public function index() {
		$actions = $this->_getActions($this);

		$this->set(compact('actions'));
	}

	/**
	 * TryoutsController::fontawesome()
	 *
	 * @see http://fontawesome.io/
	 *
	 * @return void
	 */
	public function markdown() {
	}

}
