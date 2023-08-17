<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Event</h5>
                </div>
                <div class="modal-body">
                    <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">

                                <label class="form-label">Event Category</label>
                                <select type="text" class="form-control form-select" id="eventUpdateCategory">
                                    <option value="">Select Category</option>
                                </select>

                                <label class="form-label">Event Name</label>
                                <input type="text" class="form-control" id="eventNameUpdate">
                                <label class="form-label">Description</label>
                                <input type="text" class="form-control" id="descriptionUpdate">
                                <label class="form-label">Date</label>
                                <input type="date" class="form-control" id="eventDateUpdate">
                                <label class="form-label">Time</label>
                                <input type="time" class="form-control" id="eventTimeUpdate">
                                <label class="form-label">Location</label>
                                <input type="text" class="form-control" id="locationUpdate">

                                <input type="text" class="" id="updateID" placeholder="ID">

                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="update-modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="UpdateEvent()" id="save-btn" class="btn btn-sm  btn-success" >Save</button>
                </div>
            </div>
    </div>
</div>


<script>

    fillUpUpdateCategoryDropdown();

    async function fillUpUpdateCategoryDropdown(){
        showLoader();
        let allCat = await axios.get('/event-Category-list');
        hideLoader();

        allCat.data.forEach(function(item){
            let option = `<option value="${item['id']}">${item['name']}</option>`

            $("#eventUpdateCategory").append(option);
        });       
    }


    async function fillupUpdateEventForm(id){
        document.getElementById('updateID').value=id;

        showLoader();
        let info = await axios.post('/event-by-id', {id:id});
        hideLoader();

        document.getElementById('eventNameUpdate').value = info.data['title'];
        document.getElementById('descriptionUpdate').value = info.data['description'];
        document.getElementById('eventDateUpdate').value = info.data['date'];
        document.getElementById('eventTimeUpdate').value = info.data['time'];
        document.getElementById('locationUpdate').value = info.data['location'];
        document.getElementById('eventUpdateCategory').value = info.data['event_category_id'];
    }


    async function UpdateEvent(){
        let title = document.getElementById('eventNameUpdate').value;
        let description = document.getElementById('descriptionUpdate').value;
        let date = document.getElementById('eventDateUpdate').value;
        let time = document.getElementById('eventTimeUpdate').value;
        let location = document.getElementById('locationUpdate').value;
        let event_category_id = document.getElementById('eventUpdateCategory').value;
        let event_id = document.getElementById('updateID').value;

        if(title.length === 0){
            errorToast("Event name is Required !")
        }else if(description.length === 0){
            errorToast("Event description is Required !")
        }else if(date.length === 0){
            errorToast("Event date is Required !")
        }else if(time.length === 0){
            errorToast("Event time is Required !")
        }else if(location.length === 0){
            errorToast("Event location is Required !")
        }else if(event_category_id.length === 0){
            errorToast("Event category is Required !")
        }else{
            document.getElementById('update-modal-close').click();

            let infoData = {
                title:title,
                description:description,
                date:date,
                time:time,
                location:location,
                event_category_id:event_category_id,
                id:event_id
            }

            showLoader();
            let response = await axios.post("/event-update", infoData)
            hideLoader();


            if(response.status === 200 && response.data['status'] === 'success'){
                successToast(response.data['message']);
                document.getElementById("update-form").reset();

             await gettingEventList();
            }else{
                errorToast(response.data['message']);
                
            }


        }
    }


</script>