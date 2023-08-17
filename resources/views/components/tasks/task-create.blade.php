<div class="modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Task</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">

                                <label class="form-label">Task Category</label>
                                <select type="text" class="form-control form-select" id="taskCategory">
                                    <option value="">Select Category</option>
                                </select>

                                <label class="form-label">Task Name</label>
                                <input type="text" class="form-control" id="tasktName">
                                <label class="form-label">Description</label>
                                <input type="text" class="form-control" id="description">
                                <label class="form-label">Date</label>
                                <input type="date" class="form-control" id="taskDate">
                                <label class="form-label">Time</label>
                                <input type="time" class="form-control" id="taskTime">
                                <label class="form-label">Location</label>
                                <input type="text" class="form-control" id="location">

                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="CreateTask()" id="save-btn" class="btn btn-sm  btn-success" >Save</button>
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

            $("#taskCategory").append(option);
        });       
    }

    async function CreateTask(){
        let task_category_id = document.getElementById('taskCategory').value;
        let title = document.getElementById('tasktName').value;
        let description = document.getElementById('description').value;
        let date = document.getElementById('taskDate').value;
        let time = document.getElementById('taskTime').value;
        let location = document.getElementById('location').value;

        if(task_category_id.length === 0){
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
            document.getElementById('modal-close').click();
            let information = {
                event_category_id:task_category_id,
                title:title,
                description:description,
                date:date,
                time:time,
                location:location
            }

            showLoader();
            let  response = await axios.post('/task-create', information);
            hideLoader();

            if(response.status===200 && response.data['status'] === 'success'){
                successToast('New task has been created successfully');
                document.getElementById("save-form").reset();
                await gettingAllTasks();
            }
            else{
                errorToast("Request fail and not create the task !")
            }

        }
    }

</script>