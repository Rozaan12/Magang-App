<html>
<head>
    <title> Surat Magang </title>
    <style type= "text/css">
            body {
                font-family: arial; 
                /* background-color : #ccc  */
            }
            .rangkasurat {
                /* width : 980px;
                margin:0 auto;
                background-color : #fff;
                height: 500px;
                padding: 20px; */
            }
            table {
                border-bottom : 5px solid # 000; 
                padding: 2px
            }
            .tengah {
                text-align : center;
                line-height: 5px;
            }


            #judul{
                text-align:center;
            }

            #halaman{
                width: auto; 
                height: auto; 
                position: absolute; 
                /* border: 1px solid;  */
                padding-top: 30px; 
                padding-left: 30px; 
                padding-right: 30px; 
                padding-bottom: 80px;
            }
     </style >
</head>
<body>
<div class = "rangkasurat">
      <table width = "100%">
            <tr>
                  <td class="tengah">
                        <h1 style="color: #6a3093; margin-bottom: 0;">SARASTYA</h1>
                        <h4 style="margin-top: 5px; color: #555;">Agility Innovations</h4>
                        <p style="font-size: 12px; line-height: 1.2;">
                            Jl. Danau Toba No. 1, Kota Malang, Jawa Timur<br>
                            Email: info@sarastya.com | Website: www.sarastya.com
                        </p>
                  </td>
             </tr>
      </table>
      <hr style="border: 2px solid #000;">
   
      <div id=halaman>
          <h3 id=judul style="text-decoration: underline;">SURAT BUKTI LOLOS SELEKSI</h3>
      
          <p>Dengan ini kami informasikan bahwa pelamar di bawah ini :</p>
      
          <table style="border: none; margin-bottom: 20px;">
              <tr>
                  <td style="width: 35%;">Nama Lengkap</td>
                  <td style="width: 5%;">:</td>
                  <td style="width: 60%; font-weight: bold;">{{$detail_pendaftaran->nama_lengkap}}</td>
              </tr>
              <tr>
                  <td style="width: 35%;">Asal Sekolah/Univ</td>
                  <td style="width: 5%;">:</td>
                  <td style="width: 60%;">{{$detail_pendaftaran->sekolah}}</td>
              </tr>
              <tr>
                  <td style="width: 35%;">Periode Magang</td>
                  <td style="width: 5%;">:</td>
                  <td style="width: 60%;">
                      {{ \Carbon\Carbon::parse($detail_pendaftaran->dari_tanggal)->format('d M Y') }} - 
                      {{ \Carbon\Carbon::parse($detail_pendaftaran->sampai_tanggal)->format('d M Y') }}
                  </td>
              </tr>
          </table>

          <p align="justify">
              Dinyatakan <strong>LOLOS</strong> tahap seleksi administratif/wawancara untuk posisi <strong>{{ $detail_pendaftaran->nama_lowongan }}</strong> di Sarastya Agility Innovations. 
          </p>

          <p align="justify">
              Langkah selanjutnya, silakan melihat instruksi pengerjaan tugas atau materi wawancara yang tersedia pada halaman detail lamaran di website kami. Selamat bergabung dan berikan kontribusi terbaik Anda!
          </p>
      
          <div style="width: 100%; margin-top: 50px;">
              <div style="width: 40%; float: right; text-align: center;">
                  <p>Malang, {{ date('d F Y') }}</p>
                  <p>Tertanda,</p>
                  <br><br><br>
                  <p><strong>HRD Manager</strong></p>
                  <p>Sarastya Agility Innovations</p>
              </div>
          </div>
      </div>
     
     </div>
</div>

</body>
</html>