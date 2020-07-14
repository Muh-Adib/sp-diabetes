<?php namespace App\Database\Seeds;

class GejalaSeeder extends \CodeIgniter\Database\Seeder
{
    static $data = [
        ['kode'=>'G1',  'detail'=> 'Banyak kencing di malam hari (lebih dari 5 kali)'],
        ['kode'=>'G2',  'detail'=> 'Sering haus atau lapar'],
        ['kode'=>'G3',  'detail'=> 'Berat badan turun drastis'],
        ['kode'=>'G4',  'detail'=> 'Sering pusing'],
        ['kode'=>'G5',  'detail'=> 'Luka sulit/lama sembuh'],
        ['kode'=>'G6',  'detail'=> 'Penglihatan kabur'],
        ['kode'=>'G7',  'detail'=> 'Keputihan'],
        ['kode'=>'G8',  'detail'=> 'Sering kesemutan pada tangan dan kaki'],
        ['kode'=>'G9',  'detail'=> 'Sering cepat lelah saat beraktivitas'],
        ['kode'=>'G10', 'detail'=>  'Infeksi saluran kemih'],
        ['kode'=>'G11', 'detail'=>  'Sering gatal-gatal atau alergi pada kulit'],
        ['kode'=>'G12', 'detail'=>  'Sering mual-mual'],
        ['kode'=>'G13', 'detail'=>  'Sering muntah'],
        ['kode'=>'G14', 'detail'=>  'Sering nyeri perut'],
        ['kode'=>'G15', 'detail'=>  'Hipertensi (tekanan darah tinggi lebih dari 120/8 mmHg)'],
        ['kode'=>'G16', 'detail'=>  'Obesitas (kegemukan)'],
        ['kode'=>'G17', 'detail'=>  'Katarak'],
        ['kode'=>'G18', 'detail'=>  'Berkeringat dan keringat lengket'],
        ['kode'=>'G19', 'detail'=>  'Sering diare'],
        ['kode'=>'G20', 'detail'=>  'Sering nyeri di ulu hati'],
        ['kode'=>'G21', 'detail'=>  'Infeksi kulit dan gusi'],
        ['kode'=>'G22', 'detail'=>  'Hilang selera makan'],
        ['kode'=>'G23', 'detail'=>  'Suhu tubuh tinggi atau hipertermia'],
        ['kode'=>'G24', 'detail'=>  'Dehidrasi'],
        ['kode'=>'G25', 'detail'=>  'Penurunan kesadaran'],
    ];
    public function run()
    {
            
        foreach (self::$data as $data) {
            $this->db->table('gejala')->insert($data);
        }

    }
}