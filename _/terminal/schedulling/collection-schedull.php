<?php 
include('../scripts/authentication.php');
include('../incl/upper.php'); ?>
<style>
:root {
  --fc-event-bg-color: #007bff;
  --fc-event-border-color: #007bff;
  --fc-event-text-color: white;
}

.fc-event {
  background-color: var(--fc-event-bg-color);
  border-color: var(--fc-event-border-color);
  color: var(--fc-event-text-color);
}
.fc {
  font-family: sans-serif;
}

/* Header toolbar */
.fc-toolbar .fc-button {
  background-color: #007bff;
  border-color: #007bff;
  color: white;
  border-radius: 3px;
}

.fc-toolbar .fc-button:hover {
  background-color: #0069d9;
  border-color: #0062cc;
}

/* Day grid */
.fc-daygrid-day-top {
  text-align: center;
  padding: 5px;
}

.fc-daygrid-day-number {
    padding: 5px;
}

.fc-daygrid-day.fc-day-today {
    background-color: #e0f2f7 !important; /* Light blue for today */
}

/* Events */
.fc-event {
  border-radius: 4px;
  padding: 2px 5px;
  margin: 2px 0;
  border: none;
  box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.15);
}

.fc-event-title {
    font-size: smaller;
	word-wrap: break-word !important; /* For older browsers */
    overflow-wrap: break-word !important; /* Modern browsers */
    white-space: normal !important; /* Important: Allows wrapping */
}
.weekend {
  background-color: #f0f0f0;
}

.fc-daygrid-event {
  white-space: normal !important;
  align-items: normal !important;
}

.fc-daygrid-event{
  display: block!important;
  padding-left: 15px!important;
}
.fc-daygrid-event-dot{
  display: inline-flex;
position: absolute;
left: 0px;
top: 6px;
}
.fc-event-time,.fc-event-title{
  display: inline;
}
.fc-daygrid-day{
  overflow:hidden;
}

</style>

<?php
include('../incl/sidebar.php');
?>


        <div class="content" id="content">
<?php include('../incl/uppermenu.php'); ?>
          <div class="row g-3">
            <div class="col-xxl-9">
             <div class="card overflow-hidden">
            <div class="card-header">
              
			  
			  
            </div>
            <div class="card-body p-3 scrollbar">
              
			  <div class="calendar-outline" id="calendar"></div>
			  
            </div>
          </div>
          
			</div>
            
          </div>
          



<script>
document.addEventListener('DOMContentLoaded', function () {
  const calendarEl = document.getElementById('calendar');

  $.ajax({
    url: '_events_calendar.php?vendor_id=<?php echo $glob_vendor_id; ?>', // Replace with the actual URL of your PHP script
    dataType: 'json', // Specify data type as JSON
    success: function (data) {
      const calendar = new FullCalendar.Calendar(calendarEl, {
        dayCellClassNames: function (arg) {
          if (arg.date.getDay() === 0 || arg.date.getDay() === 6) { // Weekend
            return 'weekend';
          }
        },

        eventColor: '#378006', // Default color for all events
        eventBackgroundColor: '#378006',
        eventBorderColor: '#378006',
        eventTextColor: 'white',
        initialView: 'dayGridMonth',
        initialDate: '<?php echo date('Y-m-d'); ?>',
        headerToolbar: {
          left: 'prev,next myCustomButton,today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay',
        },
        customButtons: {
          myCustomButton: {
            text: 'Add Schedule',
            click: function () {
              $('#addEventModal').modal('show');
            },
          },
        },

        events: data,

         eventClick: function (info) {
          const eventId = info.event.id;
          const eventTitle = info.event.title;
		  const eventTitlex = info.event.street;
		  document.title = eventTitle + ' Collection form - Afia Terminal'; 
		  

          // Set the content of the modal
          $('#eventModalTitle').text(eventTitle + ' street collection form'); // Set title in modal
          $('#eventIdDisplay').val(eventId); // Set ID in modal
          // You can add more details here if needed (start time, etc.)

          // Show the modal
            $.ajax({
              url: '_print_schedule.php',
              type: 'POST', // Use POST for sending data
              data: { event_id: eventId }, // Send the event ID as data
              success: function (response) {
                // Handle the response from _print_schedule.php
                //console.log("Response from _print_schedule.php:", response);
                // Optionally update some part of the page with the response
                $('#showTable').html(response);
				//alert(response);
              },
              error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error sending data:', textStatus, errorThrown);
              }
            });
         	
$('#printForm').modal('show');			
        },
       
      });
      calendar.render();
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.error('Error fetching events:', textStatus, errorThrown);
    },
  });
});

</script>
<script>
document.addEventListener('click', (event) => {
  if (event.target.tagName === 'LI') {
    const id = event.target.dataset.id;
	const locName = event.target.innerHTML;
    document.getElementById('location_id').value = id;
	document.getElementById('searchLocation').value ='';
	document.getElementById('showAddress').innerHTML = locName;
	document.getElementById('ds_Locations').innerHTML = '';
	document.getElementById('ds_Locationsx').innerHTML = '';
  }
});

function normalForm()
{
	document.getElementById('showAddress').innerHTML = 'Location';
	document.getElementById('location_id').value ='';
	document.getElementById('ds_Locationsx').innerHTML = '';
	document.getElementById('sucSave').style.display = 'none';
	document.getElementById('errSave').style.display = 'none';
}

document.addEventListener('DOMContentLoaded', () => {
  const inputFields = [
    document.getElementById('street_amount'),
    document.getElementById('street_amount_business'),
    document.getElementById('street_amount_industry')
  ];

  inputFields.forEach(input => {
    input.addEventListener('input', (event) => {
      const inputValue = event.target.value.replace(/\D/g, '');
      const formattedValue = inputValue.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
      event.target.value = formattedValue;
    });
  });
});


function searchStreetLocation()
{
	var street = document.getElementById("searchLocation").value;
	var ds_Locations = document.getElementById("ds_Locations");
		
	if (street.length < 3) 
	{
		ds_Locations.innerHTML = 'Please enter a minimum of 3 characters to search'
		return false;
	}
	
	$.ajax({
			type: "POST",
			url: "../scripts/load_locations.php",
			data: 
			{ street: street },
			cache: false,
			success: function(data) {
			var regsuccess = data;
             ds_Locations.innerHTML = regsuccess;
			 
			}
		});
	
}

function createSchedule()
{
   const location_id = document.getElementById('location_id').value;
   const start = document.getElementById('start').value;
   const end = document.getElementById('end').value;
   const eventDescription = document.getElementById('eventDescription').value;
   
   const title = document.getElementById('title').value;
   const recurring = document.getElementById('recurring').value;

   
if(location_id == '') {
	document.getElementById('ds_Locationsx').innerHTML = 'Choose site Location';
	document.getElementById('searchLocation').focus();
	return false;}
	
if(start == '') {
	document.getElementById('start').focus();
	return false;}
	
if(end == '') {
	document.getElementById('end').focus();
	return false;}
  
	  
  $.ajax({
			type: "POST",
			url: "../scripts/schedule_CRUD.php",
			data: 
			{ 	start: start,
				end: end,
				location_id: location_id,
				eventDescription: eventDescription,
				created_by: <?php echo $glob_user_id; ?>,
				vendor_id: <?php echo $glob_vendor_id; ?>,
				title: title,
				recurring: recurring
			},
			cache: false,
			success: function(data) {
			var resp = data;
			if(resp == 1 ){
				document.getElementById('sucSave').style.display = '';
				document.getElementById('sucMsg').innerHTML = 'Schedule Successful added';
			}else if(resp == 2 ){
				document.getElementById('sucSave').style.display = '';
				document.getElementById('sucMsg').innerHTML = 'Cost Location Successful updated';
			}else{
				document.getElementById('errSave').style.display = '';
				document.getElementById('errMsg').innerHTML = resp;
			}
             			 
			}
		});

}


</script>

<div class="modal fade" id="addEventModal" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content border">
              
                <div class="modal-header px-x1 bg-body-tertiary border-bottom-0">
                  <h5 class="modal-title">Create Collection Schedule</h5><button class="btn-close me-n1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-x1">
				<div id="sucSave" style="display: none;">		  
<div class="alert alert-success border-0 d-flex align-items-center" role="alert">
  <div class="bg-success me-3 icon-item"><span class="fas fa-check-circle text-white fs-6"></span></div>
  <p class="mb-0 flex-1" id="sucMsg"></p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
</div>
<div id="errSave" style="display: none;">
<div class="alert alert-warning border-0 d-flex align-items-center" role="alert">
  <div class="bg-warning me-3 icon-item"><span class="fas fa-warning-circle text-white fs-6"></span></div>
  <p class="mb-0 flex-1" id="errMsg"></p><button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>		  
</div>		  

				
				  <div class="mb-3">
				  <label class="form-label" for="start">Schedule title (Optional)</label>
				  <input placeholder="Enter specific title" class="form-control" id="title" type="text"   />
				  </div>
				
                  <div class="mb-3">
				  <input class="form-control d-none" id="location_id" type="text" />
						<div class="form-floating mb-3">
						<input onFocus="normalForm()" onKeyup="searchStreetLocation()" class="form-control" id="searchLocation" type="text" placeholder="Search customer location" />
						
						<label id="showAddress" for="searchLocation">Location</label>
						</div>
						<div id="ds_Locations" class="text-success h6"></div>
						<div id="ds_Locationsx" class="text-danger"></div>
				  
				  
				  </div>
				  
				  
				  <div class="row mb-3">
                  <div class="col-md-6">
				  <label class="form-label" for="start">Select start date</label>
				  <input class="form-control" id="start" type="date"   />
				  </div>
				  
				  <div class="col-md-6">
				  <label class="form-label" for="end">Select end date</label>
				  <input class="form-control" id="end" type="date"   />
				  </div>
                  </div>
				  
				<div class="mb-3">
				<label class="form-label" for="end">Collection frequency</label>  
				<select class="form-select" id="recurring">
				  <option selected disabled >Select Collection frequency</option>
				  <option value="2">Weekly</option>
				  
				  <option value="1">Daily</option>
				  
				  <option value="3">Monthly</option>
				  <option value="0">Just This time</option>
				</select>
				</div>  
				  
                  
                  <div class="mb-3"><label class="fs-9" for="eventDescription">Description (Optional)</label><textarea class="form-control" rows="3" name="description" id="eventDescription"></textarea></div>
                  
                </div>
                <div class="modal-footer d-flex justify-content-end align-items-center bg-body-tertiary border-0"><button class="btn btn-primary px-4" type="submit" onClick="createSchedule();">Create Schedule</button></div>
              
            </div>
          </div>
        </div>

</div>
<div class="modal fade" id="printForm" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="eventModalTitle">Event Title</h5> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
		<input id="eventIdDisplay" type="text" class="d-none"/>
		
	
     
        
		
		<div id="showTable"></div>
		
		
      
    
        </div>
      <div class="modal-footer" id="content">
	  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="window.print()">Print</button>
        </div>
    </div>
  </div>
</div>

      
	  
	  
<script>

</script>



<?php include('../incl/footer.php'); ?>