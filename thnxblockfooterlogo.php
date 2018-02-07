<?php
use PrestaShop\PrestaShop\Core\Module\WidgetInterface;
class thnxblockfooterlogo extends Module implements WidgetInterface
{
	public function __construct()
	{
		$this->name = 'thnxblockfooterlogo';
		$this->tab = 'front_office_features';
		$this->version = '1.0.0';
		$this->author = 'thanksit.com';
		$this->need_instance = 0;
		$this->bootstrap = true;
		parent::__construct();
		$this->displayName = $this->l('Platinum Theme Footer Logo block');
		$this->description = $this->l('Displays Logo at the Footer of the shop.');
		$this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
	}
	public function install()
	{
		if(!parent::install()
			|| !$this->registerHook('displayFooter')
			|| !$this->registerHook('displayMaintenance')
			|| !$this->thankssampledata()
			)
			return false;
		else
			return true;
	}
	public function uninstall()
	{
		if(!parent::uninstall()
			|| !Configuration::deleteByName('thnxBLOCKFOOTERLOGO_IMG')
			|| !Configuration::deleteByName('thnxBLOCKFOOTERLOGO_DESC')
			)
			return false;
		else
			return true;
	}
	public function thankssampledata($demo=NULL)
	{
		if(($demo==NULL) || (empty($demo)))
			$demo = "demo_1";
		$func = 'thankssample_'.$demo;
		if(method_exists($this,$func)){
        	$this->{$func}();
        }
        return true;
	}
	public function thankssample_demo_1(){
		$this->LogoInsert("logo.png");
	}
	public function thankssample_demo_2(){
		$this->LogoInsert("logo-w.png");
	}
	public function thankssample_demo_3(){
		$this->LogoInsert("logo.png");
	}
	public function thankssample_demo_4(){
		$logo = "logo-w.png";
		$languages = Language::getLanguages(false);
		$imgname = array();
		$DESC = array();
		foreach ($languages as $lang)
		{
			$imgname[$lang['id_lang']] = $logo;
			$DESC[$lang['id_lang']] = '';
		}
		Configuration::updateValue('thnxBLOCKFOOTERLOGO_IMG',$imgname);
		Configuration::updateValue('thnxBLOCKFOOTERLOGO_DESC',$DESC,true);
		return true;
	}
	public function thankssample_demo_5(){
		$logo = "logo-w.png";
		$languages = Language::getLanguages(false);
		$imgname = array();
		$DESC = array();
		foreach ($languages as $lang)
		{
			$imgname[$lang['id_lang']] = $logo;
			$DESC[$lang['id_lang']] = '';
		}
		Configuration::updateValue('thnxBLOCKFOOTERLOGO_IMG',$imgname);
		Configuration::updateValue('thnxBLOCKFOOTERLOGO_DESC',$DESC,true);
		return true;
	}
	public function thankssample_demo_6(){
		$logo = "logo.png";
		$languages = Language::getLanguages(false);
		$imgname = array();
		$DESC = array();
		foreach ($languages as $lang)
		{
			$imgname[$lang['id_lang']] = $logo;
			$DESC[$lang['id_lang']] = 'Platinum is an Premium Prestashop Template which is the most perfect solution for your online shop website.';
		}
		Configuration::updateValue('thnxBLOCKFOOTERLOGO_IMG',$imgname);
		Configuration::updateValue('thnxBLOCKFOOTERLOGO_DESC',$DESC,true);
		return true;
	}
	public function LogoInsert($logo = "logo.png")
	{
		$languages = Language::getLanguages(false);
		$imgname = array();
		$DESC = array();
		foreach ($languages as $lang)
		{
			$imgname[$lang['id_lang']] = $logo;
			$DESC[$lang['id_lang']] = 'Platinum is an Premium Prestashop Template which is the most perfect solution for your online shop website.';
		}
		Configuration::updateValue('thnxBLOCKFOOTERLOGO_IMG',$imgname);
		Configuration::updateValue('thnxBLOCKFOOTERLOGO_DESC',$DESC,true);
		return true;
	}
	public function renderWidget($hookName = null, array $configuration = [])
	{
	    $this->smarty->assign($this->getWidgetVariables($hookName,$configuration));
	    return $this->fetch('module:'.$this->name.'/views/templates/front/'.$this->name.'.tpl');	
	}
	public function getWidgetVariables($hookName = null, array $configuration = [])
	{
		$return_arr = array();
	    $imgname = Configuration::get('thnxBLOCKFOOTERLOGO_IMG', $this->context->language->id);
	    if($imgname && file_exists(_PS_MODULE_DIR_.$this->name.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.$imgname)){
	    	$return_arr['thnxlogo_img'] = $this->context->link->protocol_content.Tools::getMediaServer($imgname).$this->_path.'img/'.$imgname;
	    	$return_arr['thnxlogo_desc'] = Configuration::get('thnxBLOCKFOOTERLOGO_DESC', $this->context->language->id);
	    }
	    return $return_arr;
	}
	public function postProcess()
	{
		if (Tools::isSubmit('submit'.$this->name))
		{
			$languages = Language::getLanguages(false);
			$values = array();
			$update_images_values = false;
			foreach ($languages as $lang)
			{
				if (isset($_FILES['thnxBLOCKFOOTERLOGO_IMG_'.$lang['id_lang']])
					&& isset($_FILES['thnxBLOCKFOOTERLOGO_IMG_'.$lang['id_lang']]['tmp_name'])
					&& !empty($_FILES['thnxBLOCKFOOTERLOGO_IMG_'.$lang['id_lang']]['tmp_name']))
				{
					if ($error = ImageManager::validateUpload($_FILES['thnxBLOCKFOOTERLOGO_IMG_'.$lang['id_lang']], 4000000))
						return $error;
					else
					{
						$ext = substr($_FILES['thnxBLOCKFOOTERLOGO_IMG_'.$lang['id_lang']]['name'], strrpos($_FILES['thnxBLOCKFOOTERLOGO_IMG_'.$lang['id_lang']]['name'], '.') + 1);
						$file_name = md5($_FILES['thnxBLOCKFOOTERLOGO_IMG_'.$lang['id_lang']]['name']).'.'.$ext;

						if (!move_uploaded_file($_FILES['thnxBLOCKFOOTERLOGO_IMG_'.$lang['id_lang']]['tmp_name'], dirname(__FILE__).DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.$file_name))
							return $this->displayError($this->l('An error occurred while attempting to upload the file.'));
						else
						{
							if (Configuration::hasContext('thnxBLOCKFOOTERLOGO_IMG', $lang['id_lang'], Shop::getContext())
								&& Configuration::get('thnxBLOCKFOOTERLOGO_IMG', $lang['id_lang']) != $file_name)
								@unlink(dirname(__FILE__).DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.Configuration::get('thnxBLOCKFOOTERLOGO_IMG', $lang['id_lang']));

							$values['thnxBLOCKFOOTERLOGO_IMG'][$lang['id_lang']] = $file_name;
						}
					}

					$update_images_values = true;
				}
				$values['thnxBLOCKFOOTERLOGO_DESC'][$lang['id_lang']] = Tools::getValue('thnxBLOCKFOOTERLOGO_DESC_'.$lang['id_lang']);
			}
			if ($update_images_values)
				Configuration::updateValue('thnxBLOCKFOOTERLOGO_IMG', $values['thnxBLOCKFOOTERLOGO_IMG']);
			Configuration::updateValue('thnxBLOCKFOOTERLOGO_DESC', $values['thnxBLOCKFOOTERLOGO_DESC'], true);
			return $this->displayConfirmation($this->l('The settings have been updated.'));
		}
		return '';
	}
	public function getContent()
	{
		return $this->postProcess().$this->renderForm();
	}
	public function renderForm()
	{
		$fields_form = array(
			'form' => array(
				'legend' => array(
					'title' => $this->l('Logo Settings'),
					'icon' => 'icon-cogs'
				),
				'input' => array(
					array(
						'type' => 'file_lang',
						'label' => $this->l('Logo image'),
						'name' => 'thnxBLOCKFOOTERLOGO_IMG',
						'desc' => $this->l('Upload an Logo image for your shop.'),
						'lang' => true,
					),
					array(
						'type' => 'textarea',
						'lang' => true,
						'label' => $this->l('Logo description for footer'),
						'name' => 'thnxBLOCKFOOTERLOGO_DESC',
						'desc' => $this->l('Please enter a short description for your company.')
					)
				),
				'submit' => array(
					'title' => $this->l('Save')
				)
			),
		);
		$helper = new HelperForm();
		$helper->show_toolbar = false;
		$helper->table =  $this->table;
		$lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
		$helper->default_form_language = $lang->id;
		$helper->module = $this;
		$helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
		$helper->identifier = $this->identifier;
		$helper->submit_action = 'submit'.$this->name;
		$helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$helper->tpl_vars = array(
			'uri' => $this->getPathUri(),
			'fields_value' => $this->getConfigFieldsValues(),
			'languages' => $this->context->controller->getLanguages(),
			'id_language' => $this->context->language->id
		);
		return $helper->generateForm(array($fields_form));
	}
	public function getConfigFieldsValues()
	{
		$languages = Language::getLanguages(false);
		$fields = array();
		foreach ($languages as $lang)
		{
			$fields['thnxBLOCKFOOTERLOGO_IMG'][$lang['id_lang']] = Tools::getValue('thnxBLOCKFOOTERLOGO_IMG_'.$lang['id_lang'], Configuration::get('thnxBLOCKFOOTERLOGO_IMG', $lang['id_lang']));
			$fields['thnxBLOCKFOOTERLOGO_DESC'][$lang['id_lang']] = Tools::getValue('thnxBLOCKFOOTERLOGO_DESC_'.$lang['id_lang'], Configuration::get('thnxBLOCKFOOTERLOGO_DESC', $lang['id_lang']));
		}
		return $fields;
	}
}