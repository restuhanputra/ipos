<footer class="main-footer">
  <strong>Copyright &copy; 2021 <a href="<?= base_url() ?>"><?= webInfo()->nama_web; ?></a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 1.0
  </div>
</footer>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url() ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<!-- <script src="<? //= base_url() 
                  ?>assets/plugins/datatables-fixedheader/js/fixedHeader.bootstrap4.min.js"></script> -->
<!-- <script src="<? //= base_url() 
                  ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<? //= base_url() 
              ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<? //= base_url() 
              ?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<? //= base_url() 
              ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<? //= base_url() 
              ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<? //= base_url() 
              ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<? //= base_url() 
              ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<? //= base_url() 
              ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script> -->
<!-- SweetAlert2 -->
<script src="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.min.js"></script>
<!-- AdminLTE App -->
<script src=" <?= base_url() ?>assets/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="<? //= base_url() 
                  ?>assets/dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<? //= base_url() 
                  ?>assets/dist/js/pages/dashboard.js"></script> -->

<!-- Page specific script -->
<script>
  $(document).ready(function() {
    $('#example').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
      "fixedHeader": true,
    });
  });

  function autofill_stokmasuk(id) {
    // var produkId = document.getElementById("produk_id").value;
    $.ajax({
      url: "<?php echo base_url(); ?>stokmasuk/getProduk",
      data: 'produk=' + id,
      success: function(data) {
        if (id == 0) {
          document.getElementById('harga').value = '';
        }
        let hasil = JSON.parse(data);
        // document.getElementById('harga').value = hasil.harga;
        $.each(hasil, function(key, val) {
          document.getElementById('harga').value = val.harga;
          // document.getElementById('jumlah').value = val.jumlah;
        });
      },
      error: function(xhr, status, error) {
        alert(xhr.status);
        alert(thrownError);
      }
    });
  }

  function autofill_stokkeluar(id) {
    $.ajax({
      url: "<?php echo base_url(); ?>stokkeluar/getProduk",
      data: 'produk=' + id,
      success: function(data) {
        if (id == 0) {
          document.getElementById('harga').value = '';
          document.getElementById('jumlah_masuk').value = '';
          document.getElementById('stok_masuk_id').value = '';
        }
        let hasil = JSON.parse(data);
        $.each(hasil, function(key, val) {
          document.getElementById('harga').value = val.harga;
          document.getElementById('jumlah_masuk').value = val.jumlah;
          document.getElementById('stok_masuk_id').value = val.id;
        });
      },
      error: function(xhr, status, error) {
        alert(xhr.status);
        alert(thrownError);
      }
    });
  }

  function validateNumber() {
    let jumlahMasuk = parseInt(document.getElementById('jumlah_masuk').value);
    let jumlahKeluar = parseInt(document.getElementById('jumlah_keluar').value);

    if (jumlahKeluar > jumlahMasuk) {
      // document.getElementById('sub').disabled = false;
      document.getElementById('submit_stokkeluar').disabled = true;
      Swal.fire({
        timer: 4000,
        title: 'Jumlah lebih besar daripada Jumlah Stok!',
        icon: 'error',
        timerProgressBar: true,
        showConfirmButton: false
      })
    } else {
      document.getElementById('submit_stokkeluar').disabled = false;
    }
  }

  $("#harga, #jumlah_keluar").keyup(function() {
    let harga = $('#harga').val();
    let jumlah_keluar = $('#jumlah_keluar').val();
    let kali = Number(harga) * Number(jumlah_keluar);
    if (harga != "" && jumlah_keluar != "") {
      $('#jumlahHarga').val(kali);
    } else {
      $('#jumlahHarga').val("");
    }
  })
</script>
<script>
  var base_url = '<?= base_url() ?>'
</script>
<script src="<?= base_url('assets/dist/js/script.js') ?>"></script>
</body>

</html>