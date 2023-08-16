<div class="modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Product</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">

                                <label class="form-label">Event Category</label>
                                <select type="text" class="form-control form-select" id="eventCategory">
                                    <option value="">Select Category</option>
                                </select>

                                <label class="form-label">Event Name</label>
                                <input type="text" class="form-control" id="eventName">
                                <label class="form-label">Description</label>
                                <input type="text" class="form-control" id="description">
                                <label class="form-label">Date</label>
                                <input type="date" class="form-control" id="eventDate">
                                <label class="form-label">Time</label>
                                <input type="time" class="form-control" id="eventTime">
                                <label class="form-label">Location</label>
                                <input type="text" class="form-control" id="location">

                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="CreateEvent()" id="save-btn" class="btn btn-sm  btn-success" >Save</button>
                </div>
            </div>
    </div>
</div>

<script>


    fillUpCategoryDropdown();

    async function fillUpCategoryDropdown(){
        showLoader();
        let allCat = await axios.get('/event-Category-list');
        hideLoader();

        allCat.data.forEach(function(item){
            let option = `<option value="${item['id']}">${item['name']}</option>`

            $("#eventCategory").append(option);
        });       
    }

    async function CreateEvent(){
        let event_category_id = document.getElementById('eventCategory').value;
        let title = document.getElementById('eventName').value;
        let description = document.getElementById('description').value;
        let date = document.getElementById('eventDate').value;
        let time = document.getElementById('eventTime').value;
        let location = document.getElementById('location').value;

        if(event_category_id.length === 0){
            errorToast('Event Category is required');
        }else if(title.length === 0){
            errorToast('Event Name is required');
        }else if(description.length === 0){
            errorToast('Event description is required');
        }else if(date.length === 0){
            errorToast('Event date is required');
        }else if(time.length === 0){
            errorToast('Event time is required');
        }else if(location.length === 0){
            errorToast('Event location is required');
        }else{
            let information = {
                event_category_id:event_category_id,
                title:title,
                description:description,
                date:date,
                time:time,
                location:location
            }

            showLoader();
            let  response = await axios.post('/event-create', information);
            hideLoader();

            if(response.status===200 && response.data['status'] === 'success'){
                successToast('New event has been created successfully');
                document.getElementById("save-form").reset();
                await gettingEventList();
            }
            else{
                errorToast("Request fail and not create the event !")
            }
        }
    }

</script>
