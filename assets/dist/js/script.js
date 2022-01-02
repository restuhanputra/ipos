$(document).ready(function () {
  const flashdata = $(".flashdata").data("flashdata");
  const type = $(".flashdata").data("type");

  if (flashdata) {
    sweetAlert(flashdata, type);
  }

  function sweetAlert(text, icon) {
    Swal.fire({
      timer: 4000,
      text: text,
      icon: icon,
      timerProgressBar: true,
      showConfirmButton: false
    });
  }

  function deleteQuestion(url, text) {
    Swal.fire({
      text: text,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'OK',
    }).then((result) => {
      document.location.href = url;
    });
  }

  // DELETE BUTTON
  $(document).on('click', '.delete-kategori', function () {
    var id = $(this).data("id");
    var url = `${base_url}kategori/delete/${id}`;
    deleteQuestion(url, "Yakin akan menghapus data ini ?");
  });

  $(document).on('click', '.delete-satuan', function () {
    var id = $(this).data("id");
    var url = `${base_url}satuan/delete/${id}`;
    deleteQuestion(url, "Yakin akan menghapus data ini ?");
  });

  $(document).on('click', '.delete-produk', function () {
    var id = $(this).data("id");
    var url = `${base_url}produk/delete/${id}`;
    deleteQuestion(url, "Yakin akan menghapus data ini ?");
  });

  $(document).on('click', '.delete-stokmasuk', function () {
    var id = $(this).data("id");
    var url = `${base_url}stokmasuk/delete/${id}`;
    deleteQuestion(url, "Yakin akan menghapus data ini ?");
  });

  $(document).on('click', '.delete-stokkeluar', function () {
    var id = $(this).data("id");
    var url = `${base_url}stokkeluar/delete/${id}`;
    deleteQuestion(url, "Yakin akan menghapus data ini ?");
  });

  $(document).on('click', '.delete-pengguna', function () {
    var id = $(this).data("id");
    var url = `${base_url}pengguna/delete/${id}`;
    deleteQuestion(url, "Yakin akan menghapus data ini ?");
  });

});