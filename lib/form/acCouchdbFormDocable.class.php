<?php

/**
 * undocumented class
 *
 * @package default
 * @author 
 **/
class acCouchdbFormDocable
{
	protected $form = null;
	protected $doc = null;
	const FIELDNAME_REVISION = '_revision';

	public function __construct(sfForm $form, acCouchdbDocument $doc)
	{
		$this->doc = $doc;
		$this->form = $form;
	}

	public function init() {
		$this->add();
	}

	public function beforeEmbedForm($name, sfForm $form, $decorator = null)
	{
		if ($form instanceof acCouchdbFormDocableInterface) {
			$form->getDocable()->remove();
		}
	}

	public function postBind(array $taintedValues = null, array $taintedFiles = null)
	{
		if ($this->form->isValid()) {
			$this->update();
		}
	}
	
	protected function add() {
		$this->form->setWidget(self::FIELDNAME_REVISION, new sfWidgetFormInputHidden(array(), 
																					 array('data-id' => $this->doc->get('_id'))
																					));
		$this->form->setValidator(self::FIELDNAME_REVISION, new sfValidatorString(array('required' => !$this->doc->isNew())));
		$this->form->setDefault(self::FIELDNAME_REVISION, $this->doc->get('_rev'));
	}

	protected function remove()
	{
		unset($this->form[self::FIELDNAME_REVISION]);
	}

	protected function update() 
	{
		if ($this->form->getValue(self::FIELDNAME_REVISION)) {
			$this->doc->set('_rev', $this->form->getValue(self::FIELDNAME_REVISION));
		}
	}	

}
