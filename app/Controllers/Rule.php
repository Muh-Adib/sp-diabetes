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
        $listPenyakit=$this->model_p->findAll();
        $listGejala=$this->model_g->findAll();
        $data = ['title' => 'Create new Rule',
        'list_p'=> $listPenyakit,
        'list_g'=> $listGejala];

		return view('Rules/create', $data);
	}
	  
	public function store()
	{
		$primaryKey = 'id';
		$id =$this->request->getPost('id');
		$penyakit = $this->request->getPost('id_Penyakit');
		$gejala = $this->request->getPost('id_Gejala');

        if ($penyakit and $gejala) {
            # code...
        }
        
		if($id!=null){
			$data = [
				'id'=> $id,
				'id_Penyakit' => $penyakit,
				'id_Gejala'=> $gejala,
			];}
		else{
			$data = [
				'id_Penyakit' => $penyakit,
				'id_Gejala'=> $gejala,
			];
		}
			
		$save = $this->model->save($data);

		if ($save) {
			session()->setFlashdata('success', 'Post has been added successfully.');
			return redirect()->to(base_url('rule'));
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
			return redirect()->to(base_url('rule'));
		} else {
			session()->setFlashdata('error', 'Some problems occured, please try again.');
			return redirect()->to(base_url('rule'));
		}

    }
    
    function cariNama($id,$m)
    {
        if($m=="g"){
        foreach ($this->model_g as $key => $value) {
            if ($value['id']==$id) {
                $nama=$value['nama'];
            }
        }
    }else{
        foreach ($this->model_p as $key => $value) {
            if ($value['id']==$id) {
                $nama=$value['nama'];
            }
        }
    }
        return $nama;
    }

	public function GenerateList()
    {
        $db = \Config\Database::connect();
       /*  $query=$db->$query("SELECT a.nama, b.nama"); */
        $listPenyakit=$this->model_p->findAll();
        $listGejala=$this->model_g->findAll();
        $list=[];
        foreach ($this->model->findAll() as $key => $value) {
            if ($this->model['id_Penyakit']) {
                # code...
            }
            
        }
    }

}