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
  $(document).on('click', '.delete-department', function () {
    var id = $(this).data("id");
    var url = `${base_url}department/delete/${id}`;
    deleteQuestion(url, "Yakin akan menghapus data ini ?");
  });

  $(document).on('click', '.delete-unit', function () {
    var id = $(this).data("id");
    var url = `${base_url}unit/delete/${id}`;
    deleteQuestion(url, "Yakin akan menghapus data ini ?");
  });

  $(document).on('click', '.delete-role', function () {
    var id = $(this).data("id");
    var url = `${base_url}role/delete/${id}`;
    deleteQuestion(url, "Yakin akan menghapus data ini ?");
  });
});