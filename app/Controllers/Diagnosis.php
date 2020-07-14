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
		if(!empty($this->temp->findAll())||!empty($this->log->findAll())){
			foreach ($this->temp->findAll() as $value) {
				$this->temp->delete($value['id']);
			}foreach ($this->log->findAll() as $value) {
				$this->log->delete($value['id']);
			}
		}
		$data = [
			
            'penyakit'=> $this->penyakit->findAll(),
            'gejala'=> $this->gejala->findAll(),
			'diagnosis' => $this->model->orderBy('created_at', 'DESC')->findAll(),
			'pager' => $this->penyakit->pager,
			'title' => 'Diagnosis',
			
        ];
        

		return view('Diagnosist/index', $data);
	}

	public function show($id)
	{
		if (empty($id)) {
			return redirect()->to(base_url('diagnosis'));
		}
		$d = $this->model->find($id);
		$p = $this->penyakit->findAll();
		$g = $this->gejala->findAll();
		$data = [
			'diagnosis' => $d,
			'detail'=> $p,
			'gejala'=> $g,
		];
		return view('Diagnosist/show', $data);
	}

	public function create()
	{
		/* struktur fungsi diagnosis
		1. inisuasi
		2. pengambilan jawaban
		3. pembuatan laporan
		 */
		
		
		
		
		
		#ambil data
		

		#init
		if (empty($this->temp->findAll())&&empty($this->log->findAll())) {
			$this->CreateRule();
			$nama = $this->request->getPost('nama');
			
			session()->set( 'nama' , $nama );

			$list_gejala_init = $this->temp->findColumn('list_gejala');
			$control_init = $this->gejala->findColumn('kode');

			$Q_init=$this->FindWay(null,$control_init,$list_gejala_init);

			$Key_init=current(array_keys($Q_init));

			foreach ($this->gejala->findAll() as $find) {
				# code...
				if ($find['kode']==$Key_init) {
					$nama_init = $find['detail'];
					$kode_init = $find['id'];
				}
			}

			$data = ['title' => 'Diagnosis Baru',
					'nama_gejala' => $nama_init,
					'nama' => session()->get('nama'),
					'Q' => $Q_init,
					'control'=> $control_init,
					'kode'=> $kode_init,
					'rute'=> $list_gejala_init,
				];
				return view('Diagnosist/create', $data);

		} else if (isset($_POST)) {
			#get input
			
			$cf = $this->request->getPost('y');
			$R = $this->request->getPost('Q');
			$control = $this->request->getPost('control');
			$kode = $this->request->getPost('kode');
			$rute = $this->request->getPost('rute');
			

			if (isset($_POST['y'])) {
				# simpan log
				$log = [
					'id_gejala'=>$kode,
					'cf' => $cf
				];
				$this->log->save($log);

				# jika yes maka menuju langkah berikutnya
				$Q=$this->FindWay($R,$control,$rute);
				
			}else if (isset($_POST['n'])) {
				# jika no maka mencari variabel di bawahnya
				
				$simbol = $this->gejala->where('id',$kode)->first();
				
				$kode2 = $simbol['kode'];
				$A=array();
				foreach ($R as $rutea => $a) {
					if (strpos($rutea,$simbol['kode'])===false) {
						# code...br
						
						
						$A[$rutea]=$a;
						
					}
				}
				
				/* $Q = $R; */
				
				//echo "<br>";echo "<br>";
				$Q = $A;
			}
			//$Q=$R;
			
			# cek jalan buntu?
			if ($Q == null) {
				$retVal = ($this->log->findAll()) ? $this->simpan()  : $this->sehat() ;
				echo view('Diagnosist/show', $retVal);
				
			}else if ($Q !== null){
				# cari gejala selanjutnya
				$kode = null;
				
				$x = array_keys($Q);
				$Key = current($x);
				$pecah = explode('-',$Key);
				$nexts = count($pecah);
				$kode1 = $pecah[$nexts-1];
				
				
			foreach ($this->gejala->findAll() as $find) {
				# code...
				if ($find['kode']==$kode1) {
					$nama = $find['detail'];
					$kode = $find['id'];
				}
			}
				
				$data = [
					'title' => 'Diagnosis Baru',
					'nama_gejala' => $nama,
					'gejala'=> $this->gejala->findAll(),
					'Q' => $Q,
					'nama' => session()->get('nama'),
					'control'=> $control,
					'kode'=> $kode,
					'rute'=> $rute,
					'log' =>$this->log->findAll()
					];
			
			# jika jalan buntu maka end
			return view('Diagnosist/create', $data);
			# save id_diagosis list_gejala penyakit(max) tingkat kepercayaan
			}
		}
			
		
	}
	  

	public function destroy($id)
	{
		
		if (empty($id)) {
			return redirect()->to(base_url('diagnosis'));
		}

		$delete = $this->model->delete($id);

		if ($delete) {
			session()->setFlashdata('success', 'Data berhasil dihapus');
			return redirect()->to(base_url('diagnosis'));
		} else {
			session()->setFlashdata('error', 'Data gagal dihapus');
			return redirect()->to(base_url('diagnosis'));
		}

	}
	
	public function CreateRule()
	{
		
		$penyakit = $this->penyakit->findAll();
		$rule = $this->rule->findAll();
		$gejala = $this->gejala->findAll();
		
		foreach ($penyakit as $p) {
			$list=array();
			$i=0;
			#jumlah penyakit 
			#setiap rule yang ada id penyakit
			foreach ($rule as $rules) {
			# cari id gejala
				if ($p['id']==$rules['id_penyakit']) {
					foreach ($gejala as $g) {
						
						if ($g['id']==$rules['id_gejala']) {
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
	
	public function FindWay($item_array,$kode,$rule)
	{
		
		/* logic get (g1,g2) as relation 
		lalala
 		*/


		if ($item_array==null) {
			# code...
			foreach ($kode as $k) {
				$re[$k] = 0;
				foreach($rule as $r) {            
					if(strpos($r, $k) !== false) {
						$re[$k]++;
						
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
				for ($w=(count($items)); $w < (count($kode)-1); $w++) { 
					//echo count($items)." items ".(count($kode)-1)." kode <br>";
					if (!(strpos($key,$kode[$w]))) {
						# code...
					
						$rest=$key.'-'.$kode[$w];
						$results[$rest]=0;
						foreach ($rule as $a) {
							if ( 
								(strpos($a,$itema) !== false) && 
								(strpos($a,$kode[$w]) !== false) && 
								!(strpos($itema,$kode[$w])) 
								) {
								$results[$rest]++;
								}
							}
						}
					}
				}
				
				foreach($results as $b => $k){
					if ($k != 0){ $re[$b]=$k;}
						
				}
				
		}
		
	//print_r($re);
	//echo "</br>";					
					
		
	return $re;
	}

	
	public function Hitung($list)
	{
		
        $db      = \Config\Database::connect();
		$sql = "SELECT GROUP_CONCAT(b.kode), a.cf
		FROM rule a
		JOIN penyakit b ON a.id_penyakit=b.id
		WHERE a.id_gejala IN(".$list.") 
		GROUP BY a.id_gejala";
		$query=$db->query($sql);
		$evidence=array();
		foreach ($query->getResult('array') as $row)
		{
			$evidence[]=[
				0 => $row['GROUP_CONCAT(b.kode)'],
				1 => $row['cf'],
			];
		}
		
		$fod=implode(',',($this->penyakit->findColumn('kode')));
		
		$densitas_baru=array();
		while(!empty($evidence)){
			$densitas1[0]=array_shift($evidence);
			$densitas1[1]=array($fod,1-$densitas1[0][1]);
			$densitas2=array();
			if(empty($densitas_baru)){
				$densitas2[0]=array_shift($evidence);
			}else{
				foreach($densitas_baru as $k=>$r){
					if($k!="&theta;"){
						$densitas2[]=array($k,$r);
					}
				}
			}
			$theta=1;
			foreach($densitas2 as $d) $theta-=$d[1];
			$densitas2[]=array($fod,$theta);
			$m=count($densitas2);
			$densitas_baru=array();
			for($y=0;$y<$m;$y++){
				for($x=0;$x<2;$x++){
					if(!($y==$m-1 && $x==1)){
						$v=explode(',',$densitas1[$x][0]);
						$w=explode(',',$densitas2[$y][0]);
						sort($v);
						sort($w);
						$vw=array_intersect($v,$w);
						if(empty($vw)){
							$k="&theta;";
						}else{
							$k=implode(',',$vw);
						}
						if(!isset($densitas_baru[$k])){
							$densitas_baru[$k]=$densitas1[$x][1]*$densitas2[$y][1];
						}else{
							$densitas_baru[$k]+=$densitas1[$x][1]*$densitas2[$y][1];
						}
					}
				}
			}
			foreach($densitas_baru as $k=>$d){
				if($k!="&theta;"){
					$densitas_baru[$k]=$d/(1-(isset($densitas_baru["&theta;"])?$densitas_baru["&theta;"]:0));
				}
			}
			return($densitas_baru);
		}
	}

	public function simpan()
	{
		# code...
		# cari id gejala
		$jawaban=implode(',',$this->log->findColumn('id_gejala'));
		
		# hitung jawaban
		$hasil=$this->Hitung($jawaban);
		
		# rangking hasil
		unset($hasil["&theta;"]);
		
		arsort($hasil);

	
		
		
		//--- menampilkan hasil akhir
		$codes=array_keys($hasil); 
		
		
		
		
		if (sizeof($hasil)>1) {
			# code...

			$ket=array();
			for ($yuhu=0; $yuhu < sizeof($hasil); $yuhu++) { 
			# code...
			$kun = explode(',',$codes[$yuhu]);
			$kunt = current($kun);
			$nil = round($hasil[$codes[$yuhu]]*100,2);
			if ($ket[$kunt]==null) {
				# code...
				$ket[$kunt]=$nil;
			}else {
				# code...
				$kunt = next($kun);
				$ket[$kunt]=$nil;
			}
			
				
			}
		}
		
		/* print_r($jsond);
		$jsonds = json_decode($jsond,true);
		var_dump($jsonds);
		foreach ($jsonds as $ara => $valu) {
			# code...
			echo "ara=".$ara."<br>valu=".$valu;
		} */
		
		
		

		$data = [
			'nama' => session()->get('nama'),
			'ket' => json_encode($ket), //data hasil
			'gejala'=> json_encode($this->log->findColumn('id_gejala')), //data gejala yang dipilih
		];
		var_dump(json_encode($this->log->findColumn('id_gejala')));
		$save = $this->model->save($data);
		if ($save) {
			# code...
			session()->setFlashdata('succes', 'Data Diagnosis berhasil disimpan.');
			
			$p = $this->penyakit->findAll();
			$g = $this->gejala->findAll();
			$datas = [
				'diagnosis' => $data,
				'detail' => $p,
				'gejala' => $g,
			];
			return $datas;
			//echo view('Diagnosist/show', $data);
		}
		//return redirect()->to(base_url('diagnosis'));
	}

	public function sehat()
	{
		# code...
		
		$data = [
			
			'nama' => session()->get('nama'),
			'ket' => json_encode("Sepertinya anda baik baik saja tetap jaga kesehatan dengan melakukan olahraga dan gizi yang cukup untuk mempertahankan kesehatan anda."),
			'gejala'=> json_encode("Tidak ada"),
		];

		$save = $this->model->save($data);

			$p = $this->penyakit->findAll();
			$g = $this->gejala->findAll();
			$datas = [
				'diagnosis' => $data,
				'detail'=> $p,
				'gejala'=> $g,
			];
		return $datas;
	}

}