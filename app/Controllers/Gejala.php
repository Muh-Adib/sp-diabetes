<?php namespace App\Controllers;

use App\Models\GejalaModel;
use CodeIgniter\HTTP\Request;

class gejala extends BaseController
{
	/**
	 *
	 * @var Model
	 */
	protected $model;
	
	public function __construct()
	{
		$this->model = new GejalaModel();
		$this->helpers = ['form', 'url'];
		
	}

	public function index()
	{
		$data = [
			'gejala' => $this->model->paginate(10),
			'pager' => $this->model->pager,
			'title' => 'Daftar Gejala'
		];

		return view('Gejalas/index', $data);
	}

	public function countdata(){
		$db = \Config\Database::connect();
		$a = $db->table('gejala')->countAll();
		return $a+1;
	}

	public function create()
	{
		$max = "G".$this->countdata();

		$data = ['title' => 'Tambah Gejala Baru',
				 'max'=> $max];

		return view('gejalas/create', $data);
	}
	  
	public function store()
	{
		$primaryKey = 'id';
		$id =$this->request->getPost('id');
		$kode = $this->request->getPost('kode');
		$nama = $this->request->getPost('detail');
		
		if($id!=null){
			$gejala = [
				'id'=> $id,
				'kode' => $kode,
				'detail' => $nama,
			];}
		else{
			$gejala = [
				'kode' => $kode,
				'detail' => $nama,
			];
		}
			
		$save = $this->model->save($gejala);

		if ($save) {
			session()->setFlashdata('success', 'Post has been added successfully.');
			return redirect()->to(base_url('gejala'));
		} else {
			session()->setFlashdata('error', 'Some problems occured, please try again.');
			return redirect()->back();
		}

  }

  public function edit($id)
	{
		$gejala = $this->model->find($id);

		if (empty($gejala)) {
			session()->setFlashdata('error','gejala not found');
			return redirect()->back();
		}

		$data = [
			'title' => 'Edit gejala',
			'gejala' => $gejala,
			'id'=> $id
		];

		return view('gejalas/edit', $data);

	}

	public function destroy($id)
	{
		
		if (empty($id)) {
			return redirect()->to(base_url('gejala'));
		}

		$delete = $this->model->delete($id);

		if ($delete) {
			session()->setFlashdata('success', 'Post has been removed successfully.');
			return redirect()->to(base_url('gejala'));
		} else {
			session()->setFlashdata('error', 'Some problems occured, please try again.');
			return redirect()->to(base_url('gejala'));
		}

	}
	

}