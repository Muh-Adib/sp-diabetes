<?php namespace App\Controllers;

use App\Models\PenyakitModel;
use CodeIgniter\HTTP\Request;

class Penyakit extends BaseController
{
	/**
	 *
	 * @var Model
	 */
	protected $model;
	
	public function __construct()
	{
		$this->model = new PenyakitModel();
		$this->helpers = ['form', 'url'];
		
	}

	public function index()
	{
		$data = [
			'penyakits' => $this->model->paginate(10),
			'pager' => $this->model->pager,
			'title' => 'Daftar Penyakit'
		];

		return view('Penyakits/index', $data);
	}

	public function countdata(){
		$db = \Config\Database::connect();
		$a = $db->table('penyakit')->countAll();
		return $a+1;
		
	} 

	public function create()
	{
		$max = 'P'.$this->countdata();

		$data = ['title' => 'Tambah Penyakit Baru' ,
				 'max'=> strval($max) ];

		return view('Penyakits/create', $data);
	}
	  
	public function store()
	{
		$primaryKey = 'id';
		$id =$this->request->getPost('id');
		$kode = $this->request->getPost('kode');
		$nama = $this->request->getPost('nama');
		$gejala = $this->request->getPost('gejala');
		$solusi = $this->request->getPost('solusi');

		
		if($id!=null){
			$penyakit = [
				'id'=> $id,
				'kode' => $kode,
				'nama' => $nama,
				'gejala'=> $gejala,
				'solusi' => $solusi,
			];}
		else{
			$penyakit = [
				'kode' => $kode,
				'nama' => $nama,
				'gejala'=> $gejala,
				'solusi' => $solusi,
			];
		}
			
		$save = $this->model->save($penyakit);

		if ($save) {
			session()->setFlashdata('success', 'Post has been added successfully.');
			return redirect()->to(base_url('penyakit'));
		} else {
			session()->setFlashdata('error', 'Some problems occured, please try again.');
			return redirect()->back();
		}

  }

  public function edit($id)
	{
		$penyakit = $this->model->find($id);

		if (empty($penyakit)) {
			session()->setFlashdata('error','Penyakit not found');
			return redirect()->back();
		}

		$data = [
			'title' => 'Edit Penyakit',
			'penyakit' => $penyakit,
			'id'=> $id
		];

		return view('Penyakits/edit', $data);

	}

	public function destroy($id)
	{
		
		if (empty($id)) {
			return redirect()->to(base_url('penyakit'));
		}

		$delete = $this->model->delete($id);

		if ($delete) {
			session()->setFlashdata('success', 'Post has been removed successfully.');
			return redirect()->to(base_url('penyakit'));
		} else {
			session()->setFlashdata('error', 'Some problems occured, please try again.');
			return redirect()->to(base_url('penyakit'));
		}

	}
	

}