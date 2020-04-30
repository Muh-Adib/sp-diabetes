<?php namespace App\Controllers;

use App\Models\RuleModel;
use App\Models\PenyakitModel;
use App\Models\GejalaModel;
use App\Models\DiagnosisModel;
use App\Models\LogModel;
use App\Models\TempModel;
use CodeIgniter\HTTP\Request;

class Diagnosis extends BaseController
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
		
		$this->temp = new TempModel();
		$this->log = new LogModel();
		$this->rule = new RuleModel();
		$this->model = new DiagnosisModel();
        $this->penyakit = new PenyakitModel();
		$this->gejala = new GejalaModel();
        $this->helpers = ['form', 'url'];
        $this->count = 0;
		
	}

	public function index()
	{
		
		$data = [

            'penyakit'=> $this->penyakit->paginate(10),
            'gejala'=> $this->gejala->findAll(),
			'diagnosis' => $this->model->findAll(),
			'pager' => $this->penyakit->pager,
			'title' => 'Diagnosis'
        ];
        $this->temp->purgeDeleted();
		$this->log->purgeDeleted();

		return view('Diagnosist/index', $data);
	}


	public function create()
	{
		if (isset($_POST['y'])) {
			# disini cari data selanjutnya
			
			$cf =$this->request->getPost('cf');
			$R =$this->request->getPost('Q');
			$control =$this->request->getPost('control');
			$kode[] =$this->request->getPost('kode');
			$rute =$this->request->getPost('rute');

			$log = [
				'id_gejala'=>$kode,
				'jawaban' => $cf
			];

			$history=$this->log->save($log);

			# kemudian cari jalan 
			$Q=$this->FindWay($R,$control,$rute);
			# return view data
			if ($Q==null) {
				# code...

				$hasil=current($R);
				# hitung kesamaan perkasus
				$data = [
					'id_penyakit'=>'',
					'list_gejala'=>'',
					'cf'=>'',
				];
				$this->temp->purgeDeleted();
				$this->log->purgeDeleted();
				return redirect()->to(base_url('diagnosis'));
			}else{
				
				$Key=current(array_keys($Q));
			foreach ($this->gejala->findAll() as $find) {
				# code...
				if ($find['kode']==$Key) {
					$nama = $find['nama'];
				}
			}
				
				$data = [
					'title' => 'Diagnosis Baru',
					'nama_gejala' => $nama,
					'gejala'=> $this->model_g->findAll(),
					'Q' => $Q,
					'control'=> $control,
					'kode'=> $Key,
					'rute'=> $rute,
					
					];
			}
			# jika jalan buntu maka end
			# cari penyakit yang gejalanya paling banyak
			# save id_diagosis list_gejala penyakit(max) tingkat keperca
		}else if (isset($_POST['n'])) {
			# disini hapus daftar gejala
			# kemudian cari jalan 
			# return view data
			# jika jalan buntu maka end
			# cari penyakit yang gejalanya paling banyak
			# save
		}
		# init
		if (empty($this->temp->findAll())) {
			$this->CreateRule($this->penyakit->findAll(),$this->rule->findAll(),$this->gejala->findAll());
		}
		else
		
		if (!empty($this->temp->findAll())) {
			$list_gejala = $this->temp->findColumn('list_gejala');
			$control = $this->gejala->findColumn('kode');

			$Q=$this->FindWay(null,$control,$list_gejala);
			$Key=current(array_keys($Q));
			foreach ($this->gejala->findAll() as $find) {
				# code...
				if ($find['kode']==$Key) {
					$nama = $find['nama'];
				}
			}
			$data = ['title' => 'Diagnosis Baru',
					'nama_gejala' => $nama,
					'Q' => $Q,
					'control'=> $control,
					'kode'=> $Key,
					'rute'=> $list_gejala,];
		}else {
			# code...
			$data = ['title' => 'Data Rule tidak ditemukan',
					'nama_gejala' => 'Data Rule tidak ditemukan'];
					session()->setFlashdata('error', 'Some problems occured, please try again.');
		}
		# end init
		return view('Diagnosist/create', $data);
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
	
	public function CreateRule($penyakit,$rule,$gejala)
	{
		foreach ($penyakit as $p) {
			$list=array();
			$i=0;
			#jumlah penyakit 
			foreach ($rule as $key) {
				#setiap rule yang ada id penyakit
				# cari id gejala
				if ($p['id']==$key['id_Penyakit']) {
					foreach ($gejala as $g) {
						//var_dump($g['id']==$key['id_Gejala']);
						if ($g['id']==$key['id_Gejala']) {
							$word=$g['kode'];
							if ($list[$i]!=null) {
								$list[$i]=$list[$i].','.$word;
								
							}else {
								$list[$i]=$word;
							}
							
						}
					}
				} 

			}
			$data = [
				'id_penyakit' => $p['kode'],
				'list_gejala'=> $list
			];
			$this->temp->save($data);
		}
	}
	
	public function FindWay($item_array,$item,$list_gej)
	{
		
		if ($item_array==null) {
			# code...
			foreach ($item as $value) {
				$re[$value] = 0;
				foreach($list_gej as $gejala) {            
					if(strpos($gejala, $value) !== false) {
						$re[$value]++;
					}
				}
			}
		}
		else {
			# code...
			foreach ($item_array as $key=>$value) {
				#memecah key
				$items=explode('-',$key);
				#mengubah key
				$itema=str_replace('-', ',', $key);
				#hitung kesamaan jalur
				for ($w=(count($items)); $w < (count($item)); $w++) { 
					$rest=$key.'-'.$item[$w];
					$results[$rest]=0;
					foreach ($list_gej as $a) {
						if ((strpos($a,$itema) !== false)&&(strpos($a,$item[$w]) !== false)&&!(strpos($itema,$item[$w]))) {
						$results[$rest]++;
							}
						}
						
					}
				}
				foreach($results as $b => $k){
					if ($k != 0){ $re[$b]=$k;}
				}
		}

		
	return $re;
	}




}