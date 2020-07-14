<?php namespace App\Controllers;

use App\Models\RuleModel;
use App\Models\PenyakitModel;
use App\Models\GejalaModel;
use CodeIgniter\HTTP\Request;

class Rule extends BaseController
{
	/**
	 *
	 * @var Model
     * @var ModelPenyakit
     * @var ModelGejala
	 */
	protected $model;
	
	public function __construct()
	{
        $this->model = new RuleModel();
        $this->model_p = new PenyakitModel();
        $this->model_g = new GejalaModel();
		$this->helpers = ['form', 'url'];
		
	}

	public function index()
	{
		$data = [
            'listPenyakit'=> $this->model_p->paginate(10),
            'listGejala'=> $this->model_g->findAll(),
			'rule' => $this->model->findAll(),
			'pager' => $this->model_p->pager,
			'title' => 'Rule LIST'
        ];
        

		return view('Rules/index', $data);
	}


	public function create()
	{
        
		$data = ['title' => 'Tambah Rule Baru',
        		 'list_p'=> $this->model_p->findAll(),
				 'list_g'=> $this->model_g->findAll(),
				 'rule' => $this->model->findAll(),
				];

		return view('Rules/create', $data);
	}
	  
	public function store()
	{
		$primaryKey = 'id';
		$id = $this->request->getPost('id');
		$penyakit = $this->request->getPost('id_Penyakit');
		$gejala = $this->request->getPost('id_Gejala');
		$cf = $this->request->getPost('cf');

        
        
		if($id!=null){
			$data = [
				'id'=> $id,
				'id_Penyakit' => $penyakit,
				'id_Gejala'=> $gejala,
				'cf'=> $cf
			];}
		else{
			$data = [
				'id_Penyakit' => $penyakit,
				'id_Gejala'=> $gejala,
				'cf'=> $cf
			];
		}
			
		$save = $this->model->save($data);

		if ($save) {
			session()->setFlashdata('success', 'Post has been added successfully.');
			return redirect('/rule');
		} else {
			session()->setFlashdata('error', 'Some problems occured, please try again.');
			return redirect()->back();
		}

  }

  public function edit($id)
	{
		$rule = $this->model->find($id);

		if (empty($rule)) {
			session()->setFlashdata('error','Rule not found');
			return redirect()->back();
		}

		$data = [
			'title' => 'Edit Rule',
			'rule' => $rule,
			'id'=> $id
		];

		return view('Rules/edit', $data);

	}

	public function destroy($id)
	{
		
		if (empty($id)) {
			return redirect()->to(base_url('rule'));
		}

		$delete = $this->model->delete($id);

		if ($delete) {
			session()->setFlashdata('success', 'Post has been removed successfully.');
			return redirect()->back();
		} else {
			session()->setFlashdata('error', 'Some problems occured, please try again.');
			return redirect()->back();
		}

    }
    
    function cariNama($id,$m)
    {
        if($m=="g"){
        foreach ($this->model_g as $value) {
            if ($value['id']==$id) {
                $nama=$value['nama'];
            }
        }
    }else{
        foreach ($this->model_p as $value) {
            if ($value['id']==$id) {
                $nama=$value['nama'];
            }
        }
    }
        return $nama;
    }

	

}