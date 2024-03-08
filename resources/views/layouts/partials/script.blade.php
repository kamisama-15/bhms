<script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> 
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sparklines/sparkline.js') }}"></script>>
<script src="{{ asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
<script src="{{ asset('assets/dist/js/pages/dashboard.js') }}"></script>
<script src="{{ asset('assets/dist/js/demo.js') }}"></script>

<!-- Summernote -->
<script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Add DataTables JavaScript -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<!-- Add DataTables Bootstrap 4 JavaScript -->
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<!-- Add Buttons JavaScript -->
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.bootstrap4.min.js"></script>
<!-- Add JSZip for Excel button -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.6.0/jszip.min.js"></script>
<!-- Add pdfmake for PDF button -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
<!-- Add DataTables Buttons Extensions -->
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<script>
  $(document).ready(function() {
    $('#example').DataTable({
      buttons: [
        'copy',
        {
          extend: 'csv',
          text: 'CSV',
          exportOptions: {
            columns: [0, 1]
          }
        },
        {
          extend: 'excel',
          text: 'Excel',
          exportOptions: {
            columns: [0, 1]
          }
        },
        {
          extend: 'pdf',
          text: 'PDF',
          exportOptions: {
            columns: [0, 1]
          }
        },
        'print'
      ]
    });
  });
</script>

  {{-- <script>
    $(document).ready(function () {
      $('#example').DataTable({
        "buttons": ["copy", "csv", "excel", "pdf", "print"]
      });
    });
  </script>
   <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": true,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
      });
  </script> --}}
  
<!-- Your HTML code -->

<!-- Place the <script> tag with the JavaScript code here -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

 
  
  
  <script>
          $(document).ready(function () {
          var SITEURL = "{{url('/')}}";
          $.ajaxSetup({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
          });
          $('#customButton').on('click', function() {
      // Custom button click event handler
          alert('Custom Button Clicked!');
            });
          var calendar = $('#calendar').fullCalendar({
            header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
          },
          editable: true,
          events: SITEURL + "fullcalendar",
          displayEventTime: true,
          editable: true,
          eventRender: function (event, element, view) {
          if (event.allDay === 'true') {
          event.allDay = true;
          } else {
          event.allDay = false;
          }
          },
          selectable: true,
          selectHelper: true,
          select: function (start, end, allDay) {
          var title = prompt('Event Title:');
          if (title) {
          var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
          var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
          $.ajax({
          url: SITEURL + "fullcalendar/create",
          data: 'title=' + title + '&start=' + start + '&end=' + end,
          type: "POST",
          success: function (data) {
          displayMessage("Added Successfully");
          }
          });
          calendar.fullCalendar('renderEvent',
          {
          title: title,
          start: start,
          end: end,
          allDay: allDay
          },
          true
          );
          }
          calendar.fullCalendar('unselect');
          },
          eventDrop: function (event, delta) {
          var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
          var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
          $.ajax({
          url: SITEURL + 'fullcalendar/update',
          data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
          type: "POST",
          success: function (response) {
          displayMessage("Updated Successfully");
          }
          });
          },
          eventClick: function (event) {
          var deleteMsg = confirm("Do you really want to delete?");
          if (deleteMsg) {
          $.ajax({
          type: "POST",
          url: SITEURL + 'fullcalendar/delete',
          data: "&id=" + event.id,
          success: function (response) {
          if(parseInt(response) > 0) {
          $('#calendar').fullCalendar('removeEvents', event.id);
          displayMessage("Deleted Successfully");
          }
          }
          });
          }
          }
          });
          });
          function displayMessage(message) {
          $(".response").html("<div class='success'>"+message+"</div>");
          setInterval(function() { $(".success").fadeOut(); }, 1000);
          }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/moment@2.27.0/moment.min.js"></script>
 
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
  
  <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
{{-- <script>
  function animateValue(element, start, end, duration) {
  var range = end - start;
  var current = start;
  var increment = end > start ? 1 : -1;
  var stepTime = Math.abs(Math.floor(duration / range));
  var timer = setInterval(function () {
    current += increment;
    element.textContent = current;
    if (current == end) {
      clearInterval(timer);
    }
  }, stepTime);
}

var counterElement = document.getElementById("counter");
animateValue(counterElement, 0,#counter,300); // Example: start from 0 and animate to 100 in 3 seconds

</script>





