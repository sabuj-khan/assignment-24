<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h6>Events</h6>
                </div>
                <div class="align-items-center col">
                    <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0 btn-sm bg-gradient-primary">Create </button>
                </div>
            </div>
            <hr class="bg-secondary"/>
            <div class="table-responsive">
            <table class="table  table-flush" id="tableData">
                <thead>
                <tr class="bg-light">
                    <th>No</th> 
                    <th>Name</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Location</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="tableList">

                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
</div>


<script>

    gettingEventList();

    async function gettingEventList(){
        showLoader();
        let response = await axios.get('/event-list')
        hideLoader();

        let tableList = $("#tableList");
        let tableData = $("#tableData");

        tableData.DataTable().destroy();
        tableList.empty();
        response.data.forEach(function(item, index){
            let row = `
            <tr>
               
                <td>${index+1}</td>
                <td>${item['title']}</td>
                <td>${item['description']}</td>
                <td>${item['event_category']['name']}</td>
                <td>${item['date']}</td>
                <td>${item['time']}</td>
                <td>${item['location']}</td>
                <td>
                        <button data-id="${item['id']}" class="btn editBtn btn-sm btn-success">Edit</button>
                        <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-danger">Delete</button>
                    </td>
            </tr>
            `
            tableList.append(row);
        });


        $(".editBtn").on('click', async function(){
            let id = $(this).data('id');
            await fillupUpdateEventForm(id);
            //$("#updateID").val(id);
            $("#update-modal").modal('show');
            
        })

        new DataTable('#tableData',{
            order:[[0,'desc']],
            lengthMenu:[5,10,15,20,30]
        });

        



    }
</script>