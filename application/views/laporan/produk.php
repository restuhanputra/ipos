 <!DOCTYPE html>
 <html lang="en">

 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?= $title_pdf; ?></title>
   <style>
     #table {
       font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
       border-collapse: collapse;
       width: 100%;
     }

     #table td,
     #table th {
       border: 1px solid #ddd;
       padding: 8px;
     }

     #table tr:nth-child(even) {
       background-color: #f2f2f2;
     }

     #table tr:hover {
       background-color: #ddd;
     }

     #table th {
       padding-top: 10px;
       padding-bottom: 10px;
       text-align: center;
       background-color: #4CAF50;
       /*color: white; */
       color: black;
     }
   </style>
 </head>

 <body>
   <div style="text-align:center">
     <h3><?= webInfo()->nama_web; ?></h3>
     <h4>No. Telp <?= webInfo()->no_telp; ?> Alamat <?= webInfo()->alamat;  ?></h4>
     <hr>
   </div>
   <h2 style="text-align:center"><?= $title_pdf; ?></h2>
   <table id="table">
     <thead>
       <tr>
         <th>No</th>
         <th>Nama Produk</th>
         <th>Kategori</th>
         <th>Satuan</th>
         <th>Harga</th>
       </tr>
     </thead>
     <tbody>
       <?php
        $i = 1;
        foreach ($dataProduk as $produk) :
        ?>
         <tr>
           <td style="text-align: center;"><?= $i++; ?></td>
           <td><?= $produk->produk_nama; ?></td>
           <td><?= $produk->kategori_nama; ?></td>
           <td><?= $produk->satuan_nama; ?></td>
           <td>Rp. <?= rupiah($produk->harga); ?></td>
         </tr>
       <?php endforeach; ?>
     </tbody>
   </table>
 </body>

 </html>