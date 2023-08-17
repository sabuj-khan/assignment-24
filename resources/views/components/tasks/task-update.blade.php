<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Task</h5>
                </div>
                <div class="modal-body">
                    <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">

                                <label class="form-label">Task Category</label>
                                <select type="text" class="form-control form-select" id="taskCategoryShow">
                                    <option value="">Select Category</option>
                                </select>

                                <label class="form-label">Task Name</label>
                                <input type="text" class="form-control" id="tasktUpdateName">
                                <label class="form-label">Description</label>
                                <input type="text" class="form-control" id="taskYpdateDescription">
                                <label class="form-label">Date</label>
                                <input type="date" class="form-control" id="taskUpdateDate">
                                <label class="form-label">Time</label>
                                <input type="time" class="form-control" id="taskUpdateTime">
                                <label class="form-label">Location</label>
                                <input type="text" class="form-control" id="taskLocation">

                                <input type="text" class="" id="updateID" placeholder="ID">

                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="update-modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="UpdateTask()" id="save-btn" class="btn btn-sm  btn-success" >Save</button>
                </div>
            </div>
    </div>
</div>

<script>

    fillUpCategoryDropdownTask();

    async function fillUpCategoryDropdownTask(){
        showLoader();
        let allCat = await axios.get('/event-Category-list');
        hideLoader();

        allCat.data.forEach(function(item){
            let option = `<option value="${item['id']}">${item['name']}</option>`

            $("#taskCategoryShow").append(option);
        });       
    }

    async function fillupUpdateTaskForm(id){
        document.getElementById('updateID').value=id;

        showLoader();
        let information = await axios.post('/task-by-id', {id:id});
        hideLoader();

        document.getElementById('tasktUpdateName').value = information.data['title'];
        document.getElementById('taskYpdateDescription').value = information.data['description'];
        document.getElementById('taskUpdateDate').value = information.data['date'];
        document.getElementById('taskUpdateTime').value = information.data['time'];
        document.getElementById('taskLocation').value = information.data['location'];
        document.getElementById('taskCategoryShow').value = information.data['event_category_id'];
    }


    async function UpdateTask(){
        let title = document.getElementById('tasktUpdateName').value;
        let description = document.getElementById('taskYpdateDescription').value;
        let date = document.getElementById('taskUpdateDate').value;
        let time = document.getElementById('taskUpdateTime').value;
        let location = document.getElementById('taskLocation').value;
        let event_category_id = document.getElementById('taskCategoryShow').value;
        let task_id = document.getElementById('updateID').value;


        if(title.length === 0){
            errorToast("Task name is Required !")
        }else if(description.length === 0){
            errorToast("Task description is Required !")
        }else if(date.length === 0){
            errorToast("Task date is Required !")
        }else if(time.length === 0){
            errorToast("Task time is Required !")
        }else if(location.length === 0){
            errorToast("Task location is Required !")
        }else if(event_category_id.length === 0){
            errorToast("Task category is Required !")
        }else{
            document.getElementById('update-modal-close').click();

            let taskInfoData = {
                title:title,
                description:description,
                date:date,
                time:time,
                location:location,
                event_category_id:event_category_id,
                id:task_id
            }

            showLoader();
            let response = await axios.post("/task-update", taskInfoData)
            hideLoader();

            if(response.status === 200 && response.data['status'] === 'success'){
                successToast(response.data['message']);
                document.getElementById("update-form").reset();

                await gettingAllTasks();
            }else{
                errorToast(response.data['message']);
                
            }

        }

    }


</script>
