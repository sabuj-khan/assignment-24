<div class="container">
    <div class="row">
        <div class="col-md-10 col-lg-10">
            <div class="card animated fadeIn w-100 p-3">
                <div class="card-body">
                    <h4>User Profile</h4>
                    <hr/>
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <label>Email Address</label>
                                <input readonly id="email" placeholder="User Email" class="form-control" type="email"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>First Name</label>
                                <input id="firstName" placeholder="First Name" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Last Name</label>
                                <input id="lastName" placeholder="Last Name" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Mobile Number</label>
                                <input id="phone" placeholder="Mobile" class="form-control" type="mobile"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Password</label>
                                <input id="password" placeholder="User Password" class="form-control" type="password"/>
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <button onclick="updateUserInfo()" class="btn mt-3 w-100  btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    getUserProfileDetails();

    async function getUserProfileDetails(){
        showLoader();
        let response = await axios.get('/user-profile-info');
        hideLoader();

        if(response.status === 200 && response.data['status'] === 'success'){
            $info = response.data['data'];

            document.getElementById('email').value = $info['email'];
            document.getElementById('firstName').value = $info['firstName'];
            document.getElementById('lastName').value = $info['lastName'];
            document.getElementById('phone').value = $info['phone'];
            document.getElementById('password').value = $info['password'];
        }       
    }


    async function updateUserInfo(){
            
            let firstName = document.getElementById('firstName').value;
            let lastName = document.getElementById('lastName').value;
            let phone = document.getElementById('phone').value;
            let password = document.getElementById('password').value;

            if(firstName.length === 0){
                errorToast('First Name is required');
            }else if(lastName.length === 0){
                errorToast('Last Name is required');
            }else if(phone.length === 0){
                errorToast('Phone number is required');
            }else if(password.length === 0){
                errorToast('Password is required');
            }else{
                let dataInfo = {
                    "firstName":firstName,
                    "lastName":lastName,
                    "phone":phone,
                    "password":password
                }

                showLoader();
                let response = await axios.post('/update_user', dataInfo);
                hideLoader();

                if(response.status == 200 && response.data['status'] == 'success'){
                    
                    successToast(response.data['message'] )
                    await getUserProfileDetails();

                }else{
                    errorToast(response.data['message'] );
                }
            }
        }

</script>