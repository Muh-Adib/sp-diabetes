<?php namespace App\Controllers;
use App\Models\DiagnosisModel;
use App\Models\PenyakitModel;
use App\Models\GejalaModel;
class Home extends BaseController
{
	
	/**
	 *
	 * @var Model
	 */
	protected $model;

	public function __construct()
	{
		$this->penyakit = new PenyakitModel();
		$this->gejala = new GejalaModel();
		$this->model = new DiagnosisModel();
		$this->helpers = ['form', 'url'];
		
	}

	public function index()
	{
		$data = [
			'penyakit'=> $this->penyakit->findAll(),
            'gejala'=> $this->gejala->findAll(),
			'diagnosis' => $this->model->orderBy('created_at', 'DESC')->paginate(10),
			'pager' => $this->model->pager,
			'title' => 'Home',
		];

		return view('home/index', $data);
	}
	//--------------------------------------------------------------------

}
