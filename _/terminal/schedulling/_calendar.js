document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('appCalendarx');

  $.ajax({
    url: '_events_calendar.php', // Replace with the actual URL of your PHP script
    dataType: 'json', // Specify data type as JSON
    success: function(data) {
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        initialDate: '<?php echo date('Y-m-d'); ?>',
        headerToolbar: {
          left: 'prev,next myCustomButton,today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
		customButtons: {
		myCustomButton: {
    text: 'Add Schedule',
    click: function() {
      // Your add event logic here
      alert('add event');
    }
  }
    },
		
        events: data
      });
      calendar.render();
    }
	
	
	
  });
});
