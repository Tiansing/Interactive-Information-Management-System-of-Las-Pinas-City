<!-- Admin Header -->
<?php include "includes/admin_header.php"; ?>


<!-- Preloader -->
<!-- <div class="preloader flex-column justify-content-center align-items-center">
  <img class="animation__shake" src="../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
</div> -->

<!-- Navbar -->
<?php include "includes/admin_navbar.php"; ?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include "includes/admin_sidebar_menu.php"; ?>


<!-- CONTENT WRAPPER. CONTAINS PAGE CONTENT -->
<?php
if (isset($_GET['source'])) {
  $source = $_GET['source'];
} else {
  $source = '';
}

switch ($source) {
  case 'add_lifestyle':
    include 'includes/add_lifestyle.php';
    break;
  case 'edit_lifestyle':
    include 'includes/edit_lifestyle.php';
    break;
  case 'lifestyle_com':
    include 'includes/lifestyle_comments.php';
    break;
  default:
    include 'includes/view_all_lifestyle.php';
}
?>
<!-- /.content-wrapper -->


<!-- Admin Footer -->
<?php include "includes/admin_footer.php" ?>
<!-- DISPLAY SELECTED IMAGE -->
<script>
  var selDiv = "";
  var storedFiles = [];
  $(document).ready(function() {
    $("#img").on("change", handleFileSelect);
    selDiv = $("#selectedBanner");
  });

  function handleFileSelect(e) {
    var files = e.target.files;
    var filesArr = Array.prototype.slice.call(files);
    filesArr.forEach(function(f) {
      if (!f.type.match("image.*")) {
        return;
      }
      storedFiles.push(f);

      var reader = new FileReader();
      reader.onload = function(e) {
        var html =
          '<img src="' +
          e.target.result +
          "\" data-file='" +
          f.name +
          "alt='Category Image'  width='20%'>";
        selDiv.html(html);
      };
      reader.readAsDataURL(f);
    });
  }
</script>

<!-- VIEW Page specific script -->
<script>
  $(function() {
    $("#example1").DataTable({
      order: false,
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>


<!-- =====MODAL SCRIPT========= -->
<script>
  var selDiv = "";
  var storedFiles = [];
  $(document).ready(function() {


    // DELETE FUNCTION
    $('.deletebtn').on('click', function() {

      $('#deletemodal').modal('show');

      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

      console.log(data);

      $('#delete_id').val(data[0]);


    });

  });
  // ALERT FADE EFFECT
  $(".alert").delay(4000).slideUp(200, function() {
    $(this).alert('close');
  });


  // TABLE SCRIPT
  $(document).ready(function() {

    $('#pendingTable').DataTable({
        autoWidth: false,
        columns: [{
            width: '5px'
          },
          {
            width: '50px'
          },
          {
            width: '50px'
          },
          {
            width: '50px'
          },
          {
            width: '50px'
          }
        ],
        order: false,
        "scrollY": "350px",
        "scrollCollapse": true,
        "paging": true,
        responsive: true,
        lengthChange: false,
        autoWidth: false,

        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
      })
      .buttons()
      .container()
      .appendTo("#pendingTable_wrapper .col-md-6:eq(0)");

    $('#acceptedTable').DataTable({
        autoWidth: false,
        columns: [{
            width: '5px'
          },
          {
            width: '50px'
          },
          {
            width: '50px'
          },
          {
            width: '50px'
          },
          {
            width: '50px'
          }
        ],
        order: false,
        "scrollY": "200px",
        "scrollCollapse": true,
        "paging": true,
        responsive: true,
        lengthChange: false,
        autoWidth: false,

        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
      })
      .buttons()
      .container()
      .appendTo("#acceptedTable_wrapper .col-md-6:eq(0)");


  });
</script>