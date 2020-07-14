<?php namespace App\Database\Seeds;

class PenyakitSeeder extends \CodeIgniter\Database\Seeder
{
    static $data = [
                    [
                    'kode' => 'P1',
                    'nama' => 'Diabetes Tipe I',
                    'penyebab' => 'sistem kekebalan tubuh yang seharusnya melawan patogen (bibit penyakit), keliru dan bermasalah sehingga menyerang sel-sel penghasil insulin di pankreas',
                    'solusi' => 'Pemberian insulin, sistem pankreas buatan, diet, olahraga serta pemberian obat obatan antaranya: Aspirin, Obat tekanan darah tinggi dan Obat penurun kolesterol',
                    'slug' => 'diabetes-tipe-I',
                ],
                    [
                    'kode' => 'P2',
                    'nama' => 'Diabetes Type II',
                    'penyebab' => 'Gaya hidup yang buruk sehingga tubuh tidak menghasilkan cukup insulin. Padahal, insulin dibutuhkan untuk menjaga kadar gula darah tetap normal',
                    'solusi' => 'Untuk mengatasi gula darah yang tinggi pada penyakit ini, dibutuhkan kombinasi olahraga, pengaturan makan dan obat-obatan. Jenis obat yang dikonsumsi bisa berupa tablet atau suntikan insulin.',
                    'slug' => 'diabetes-tipe-ii',
                ],
                    [
                    'kode' => 'P3',
                    'nama' => 'Diabetes Neuropati',
                    'penyebab' => 'kadar gula darah yang tinggi melemahkan dinding pembuluh darah yang memberi asupan oksigen dan nutrisi untuk sel saraf. Akibatnya, terjadi kerusakan dan gangguan pada fungsi saraf',
                    'solusi' => 'Pemberian obat guna meredakan nyeri dan mengembalikan fungsi saraf.
                    Berikut ini adalah obat yang bisa diresepkan dokter :
                    Krim berisi capsaicin
                    Anti depresan
                    Anti kejang
                    Anti nyeri
                    ',
                    'slug' => 'diabetes-neuropati',
                ],
                    [
                    'kode' => 'P4',
                    'nama' => 'Diabetes Retinopati',
                    'penyebab' => 'Retinopati diabetik merupakan komplikasi dari penyakit diabetes yang memicu penyumbatan pada pembuluh darah pada bagian retina mata. Retina adalah lapisan di bagian belakang mata yang sensitif terhadap cahaya. Retina berfungsi mengubah cahaya yang masuk ke mata menjadi sinyal listrik, yang kemudian akan diteruskan ke otak',
                    'solusi' => 'Pasien mesti menaati diet ketat, dan menggunakan insulin jika diperlukan. Berolahraga secara rutin dan menjaga pola hidup sehat dengan menjauhi alkohol dan rokok untuk mencegah kebutaan permanen akibat penyakit ini.',
                    'slug' => 'diabetes-retinopati',
                ],
                    [
                    'kode' => 'P5',
                    'nama' => 'Diabetes Nefropati',
                    'penyebab' => 'Nefropati diabetik terjadi ketika diabetes menyebabkan kerusakan dan terbentuknya jaringan parut pada nefron. Nefron adalah bagian ginjal yang berfungsi menyaring limbah dari darah, dan membuang kelebihan cairan dari tubuh. Selain menyebabkan fungsinya terganggu, kerusakan tersebut juga membuat protein yang disebut albumin terbuang ke urine dan tidak diserap kembali.',
                    'solusi' => 'Dilakukan pengobatan yang bertujuan mengendalikan kadar gula darah dan tekanan darah tinggi. Metode pengobatan meliputi pemberian obat-obatan seperti; obat penghambat enzim atau ARB, obat penurun kolesterol dan insulin. Selain pemberian obat dokter juga menganjurkan pasien untuk menjalani pola makan yang lebih ketat',
                    'slug' => 'diabetes-nefropati',
                ],
                    [
                    'kode' => 'P6',
                    'nama' => 'Diabetes Ketoasidosis',
                    'penyebab' => 'Gula merupakan sumber energi utama bagi sel-sel otot dan jaringan tubuh yang lainnya. Saat kekurangan insulin, tubuh tidak mampu mengolah glukosa, sehingga lemak tubuh akan diambil sebagai bahan bakar. Proses pengolahan lemak ini akan menghasilkan zat bernama keton. Keton yang berlebihan dalam tubuh mengakibatkan keseimbangan pH darah (keseimbangan asam basa) terganggu, sehingga darah menjadi lebih asam, dan mengakibatkan asidosis yang berbahaya bagi tubuh.',
                    'solusi' => 'Untuk mengobati ketoasidosis diabetik, dokter akan menilai separah apa gejala yang dirasakan penderita dan pengobatan yang dilakukan sesuai dengan tingkat keparahannya. Biasanya penderita akan ditangani dengan kombinasi dari tiga jenis pengobatan di bawah ini:

                    Pemberian cairan infus untuk mengatasi dehidrasi.
                    Pemberian insulin langsung melalui infus.
                    Pemberian elektrolit tertentu, seperti kalium, natrium, dan klorida
                    ',
                    'slug' => 'diabetes-ketoasidosis',
                ],
                    [
                    'kode' => 'P7',
                    'nama' => 'Diabetes Gestasional',
                    'penyebab' => 'Belum diketahui secara pasti apa yang menyebabkan diabetes gestasional. Akan tetapi, kondisi ini diduga terkait dengan perubahan hormon dalam masa kehamilan. Pada masa kehamilan, plasenta akan memproduksi lebih banyak hormon, seperti hormon estrogen, HPL (human placental lactogen), termasuk hormon yang membuat tubuh kebal terhadap insulin, yaitu hormon yang menurunkan kadar gula darah. Akibatnya, kadar gula darah meningkat dan menyebabkan diabetes gestasional.',
                    'solusi' => 'Penanganan diabetes dengan perubahan pola hidup biasanya diberi jangka waktu hingga 3 bulan. Apabila kadar gula darahnya tak kunjung turun, barulah dokter akan memberikan insulin. Bila kadar gula darah sudah normal, barulah bisa dilakukan program hamil.',
                    'slug' => 'diabetes-gestasional',
                ],
                    [
                    'kode' => 'P8',
                    'nama' => 'Diabetes LADA',
                    'penyebab' => 'LADA merupakan singkatan dari latent autoimmune diabetes of adulthood. Secara sederhana, LADA serupa dengan diabetes melitus tipe 1 yang baru muncul saat seseorang sudah dewasa. Umumnya penyakit ini terjadi saat seseorang berusia 30 tahun ke atas.',
                    'solusi' => 'Pada awal pengobatan, LADA bisa diobati dengan obat-obatan diabetes tablet. Namun secara jangka panjang, penderitanya membutuhkan suntikan insulin guna mengontrol kadar gula darah di dalam tubuhnya.',
                    'slug' => 'diabetes-lada',
                ],
                    [
                    'kode' => 'P9',
                    'nama' => 'Diabetes MODY',
                    'penyebab' => 'Kepanjangan MODY adalah maturity onset diabetes of the young. Penyebab dan gejala MODY mirip dengan diabetes melitus tipe 2, namun terdapat dua hal yang membedakannya.
                    Pertama, MODY umumnya terjadi sebelum seseorang berusia 25 tahun (remaja). Kedua, MODY biasanya merupakan bagian dari penyakit yang diturunkan dari orang tua ke anak, karena kondisi ini biasanya disebabkan oleh mutasi genetik. Oleh karena itu, jika ayah atau ibu mengalami MODY, anak akan memiliki risiko 50% lebih tinggi untuk mengalami penyakit yang sama.
                    ',
                    'solusi' => 'Untuk mengatasi gula darah yang tinggi pada penyakit ini, dibutuhkan kombinasi olahraga, pengaturan makan dan obat-obatan. Jenis obat yang dikonsumsi bisa berupa tablet atau suntikan insulin.',
                    'slug' => 'diabetes-mody',
                ],
                    [
                    'kode' => 'P10',
                    'nama' => 'Diabetes Insipidus',
                    'penyebab' => 'Berbeda dengan diabetes lain yang ditandai dengan kadar gula darah tinggi, diabetes insipidus tak memiliki hubungan dengan gangguan insulin atau gula darah yang tinggi. Diabetes insipidus disebabkan akibat gangguan produksi hormon antidiuretik di dalam tubuh. Hal ini membuat tubuh tak bisa menahan air.
                    Diabetes insipidus ditandai dengan buang air kecil yang sangat sering dan banyak. Jumlah urine yang keluar bisa lebih dari 20 liter per hari. Hal ini menyebabkan penderitanya rentan mengalami dehidrasi dan gangguan elektrolit, yang ditandai dengan pusing, mudah lelah, bahkan penurunan kesadaran
                    ',
                    'solusi' => 'Anda bisa meredakan gejala yang muncul dengan meningkatkan konsumsi air putih Anda untuk menghindari dehidrasi. Mengonsumsi 2,5 liter dalam satu hari',
                    'slug' => 'diabetes-insipidus',
                ],
            ];
            
        public function run()
        {
                
            foreach (self::$data as $data) {
                $this->db->table('penyakit')->insert($data);
            }

        }
}