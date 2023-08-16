<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Category Name *</label>
                                <input type="text" class="form-control" id="eventCategoryNameUpdate">
                                <input class="d-none" id="updateID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="UpdateEventCategory()" id="update-btn" class="btn btn-sm  btn-success" >Update</button>
            </div>
        </div>
    </div>
</div>


<script>

    async function fillupEventCategoryUpdateForm(id){
        document.getElementById('updateID').value=id;

        showLoader();
        let response = await axios.post("/event-category-by-Id",{id:id})
        hideLoader();

        document.getElementById('eventCategoryNameUpdate').value=response.data['name'];
    }

    async function UpdateEventCategory(){
        let categoryName = document.getElementById('eventCategoryNameUpdate').value;
        let categoryId = document.getElementById('updateID').value;

        if(categoryName.length === 0){
            errorToast('Event Category name is required');
        }else{
            document.getElementById('update-modal-close').click();

            showLoader();
            let response = await axios.post("/event-category-update",{id:categoryId, name:categoryName})
            hideLoader();

            if(response.status === 200 && response.data['status'] === 'success'){
                successToast(response.data['message']);
                document.getElementById("update-form").reset();

                await  getEventCategoryList();
            }else{
                errorToast(response.data['message']);
                
            }
        }
    }
</script>