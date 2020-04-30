<?php namespace App\Controllers;
use App\Models\DiagnosisModel;
class Home extends BaseController
{
	
	/**
	 *
	 * @var Model
	 */
	protected $model;

	public function __construct()
	{
		$this->model = new DiagnosisModel();
		$this->helpers = ['form', 'url'];
		
	}

	public function index()
	{
		$data = [
			'gejala' => $this->model->paginate(10),
			'pager' => $this->model->pager,
			'title' => 'Home'
		];

		return view('home/index', $data);
	}
	//--------------------------------------------------------------------

}
